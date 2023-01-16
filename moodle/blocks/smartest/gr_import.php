<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    block_smartest
 * @copyright  2022 Smartest Learning AG
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @link       Ref https://docs.moodle.org/dev/Blocks
 */
require_once(__DIR__.'/../../config.php');
global $CFG, $USER, $DB, $OUTPUT;

require_once($CFG->libdir . '/accesslib.php');

$cid = required_param('id', PARAM_INT);
$feedback  = 0;

$smartest = new \block_smartest\smartest_constants;
$smartest->init();

if (!$course = $DB->get_record('course', array('id' => $cid))) {
    print_error('invalidcourseid');
}

$context = context_course::instance($cid);
require_login($course, true);
require_capability('moodle/grade:import', $context);

// Large files are likely to take their time and memory. Let PHP know
// that we'll take longer, and that the process should be recycled soon
// to free up memory.
core_php_time_limit::raise();
raise_memory_limit(MEMORY_EXTRA);

$PAGE->set_url('/blocks/smartest/gr_import.php', array('id' => $cid));
$PAGE->set_title(get_string('pluginname', 'block_smartest'));
$PAGE->set_heading(get_string('newsmartestgrimp', 'block_smartest'));
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');

echo $OUTPUT->header();
$continueurl = $CFG->wwwroot.'/course/view.php?id='.$cid;

if (!is_null($smartest->smartestexternalhref) and !is_null($smartest->smartestsecret)) {
    // Smartest auth OK
    // Is the user a teacher ?
    $isteacher = has_capability('block/smartest:teacher', $context, $USER->id);
    $isstudent = has_capability('block/smartest:student', $context, $USER->id);
    if ($isteacher) {
        $roles = [];
        if ($isteacher) {
            $roles[] = 'teacher';
        }
        if ($isstudent) {
            $roles[] = 'student';
        }
        // User is a teacher and we proceed.
        // +School.
        $school = array('siteidentifier' => $CFG->siteidentifier, 'fullname' => $SITE->fullname, 'shortname' => $SITE->shortname);

        // User.
        $user = array('id' => $USER->id,
            'username' => $USER->username,
            'firstname' => $USER->firstname,
            'lastname' => $USER->lastname,
            'email' => $USER->email,
            'roles' => $roles);

        // Class.
        $class = array('id' => $course->id, 'fullname' => $course->fullname, 'shortname' => $course->shortname);

        $myarray = array('School' => $school, 'Class' => $class, 'User' => $user);
        $myjsonarray = json_encode($myarray,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_IGNORE);
        $moodlejwt = \block_smartest\smartest_moodle_jwt::generate_token($myjsonarray);
        $tempresult = \block_smartest\smartest_moodle_jwt::get_smartest_grades($moodlejwt);
        $smartestresponse = json_decode($tempresult, true);

        // Is you signed or not?.
        if (array_key_exists('signed_response', $smartestresponse)) {

            // Is you good signed or not?.
            if (block_smartest\smartest_moodle_jwt::verify_smartest_signature($smartestresponse['signed_response'])) {

                $tempresult = block_smartest\smartest_moodle_jwt::get_smartest_payload($smartestresponse['signed_response']);
                $smartestresponse = json_decode($tempresult, true);

                if (array_key_exists('results', $smartestresponse)) {
                    // Results imported from Smartest.
                    echo html_writer::tag('h5', get_string('importing', 'block_smartest')); echo html_writer::start_tag('br');
                    $resultsimported = $smartestresponse['results'];

                    if (!count($resultsimported)) {
                        // We got nothing to do.
                        echo $OUTPUT->notification(get_string('nogradesreturned', 'grades'), 'notifysuccess');
                        echo $OUTPUT->continue_button($CFG->wwwroot.'/grade/report/grader/index.php?id='.$cid);
                    } else {
                        // Let's parse the results.
                        $error = '';
                        $importcode = block_smartest\smartest_grades::parse_smartest_grades($resultsimported, $course, $error);

                        if ($importcode !== false) {
                            // Commit the code if we are up this far.
                            grade_import_commit($cid, $importcode, $feedback, true);
                        } else {
                            print_error('importfailed', 'grades', $CFG->wwwroot.'/grade/report/grader/index.php?id='.$cid, $error);
                        }
                    }
                } else {
                    // Error in response.
                    echo html_writer::tag('h4', get_string('notallowed', 'block_smartest'));
                    echo html_writer::start_tag('br');
                    echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
                }

            } else {
                // ..."error": "Signature verification failed"
                echo html_writer::tag('h4', get_string('notallowed', 'block_smartest'));
                echo html_writer::start_tag('br');
                echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
            }

        } else {
            // ..."error": "Signature verification failed"
            echo html_writer::tag('h4', get_string('notallowed', 'block_smartest'));
            echo html_writer::start_tag('br');
            echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
        }

    } else {
        // User is not a teacher.
        echo html_writer::tag('h4', get_string('notallowed', 'block_smartest'));
        echo html_writer::start_tag('br');
        echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
    }
} else {
    // Smartest auth does not exist.
    echo html_writer::tag('h4', get_string('noaccess', 'block_smartest'));
    echo html_writer::start_tag('br');
    echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
}
echo $OUTPUT->footer();
die;
