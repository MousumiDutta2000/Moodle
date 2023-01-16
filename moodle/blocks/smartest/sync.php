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
 */

/* Ref https://docs.moodle.org/dev/Page_API */
require_once(__DIR__.'/../../config.php');
global $CFG, $USER, $DB, $OUTPUT, $SESSION;

require_once($CFG->libdir . '/accesslib.php');

$cid = required_param('id', PARAM_INT);
$course = $DB->get_record('course', array('id' => $cid), '*', MUST_EXIST);
$context = context_course::instance($cid);
require_login($course, true);

$smartest = new \block_smartest\smartest_constants;
$smartest->init();

$PAGE->set_url('/blocks/smartest/sync.php', array('id' => $cid));
$PAGE->set_title(get_string('pluginname', 'block_smartest'));
$PAGE->set_heading(get_string('newsmartestblock', 'block_smartest'));
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');

echo $OUTPUT->header();
echo $smartest->smartestimg;
$isteacher = has_capability('block/smartest:teacher', $context, $USER->id);
$isstudent = has_capability('block/smartest:student', $context, $USER->id);
$continueurl = $CFG->wwwroot.'/course/view.php?id='.$cid;

if (!is_null($smartest->smartestexternalhref) and !is_null($smartest->smartestsecret)) {
    // Smartest auth OK.

    // Is user either a teacher or a student?.
    if ($isteacher or $isstudent) {
        // Fill roles for the user.

        $roles = [];
        if ($isteacher) {
            $roles[] = 'teacher';
        }
        if ($isstudent) {
            $roles[] = 'student';
        }

        // Smartest auth exists : We proceed to sso at minima.
        // School.
        $school = array('siteidentifier' => $CFG->siteidentifier,
            'fullname' => $SITE->fullname,
            'shortname' => $SITE->shortname);

        // User.
        $user = array('id' => $USER->id,
            'username' => $USER->username,
            'firstname' => $USER->firstname,
            'lastname' => $USER->lastname,
            'email' => $USER->email,
            'roles' => $roles);

        // Class.
        $class = array('id' => $course->id, 'fullname' => $course->fullname, 'shortname' => $course->shortname);

        if ($isteacher) {
            // Class structure for the synchronization.

            $users = get_enrolled_users($context);
            ksort($users);
            foreach ($users as $myuser) {
                // Each user capability is checked for the sync.
                $isuserteacher = has_capability('block/smartest:teacher', $context, $myuser->id);
                $isuserstudent = has_capability('block/smartest:student', $context, $myuser->id);

                if ($isuserteacher || $isuserstudent) {
                    $roles = [];
                    if ($isuserteacher) {
                        $roles[] = 'teacher';
                    }
                    if ($isuserstudent) {
                        $roles[] = 'student';
                    }
                    $temp = array('id' => $myuser->id,
                        'username' => $myuser->username,
                        'firstname' => $myuser->firstname,
                        'lastname' => $myuser->lastname,
                        'email' => $myuser->email,
                        'roles' => $roles);
                    $members[] = $temp;
                }
            }
            $myarray = array('School' => $school, 'Class' => $class, 'User' => $user, 'Members' => $members);
        } else {
            $myarray = array('School' => $school, 'Class' => $class, 'User' => $user);
        }
        // Finally.
        $myjsonarray = json_encode($myarray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_IGNORE);
        $moodlejwt = block_smartest\smartest_moodle_jwt::generate_token($myjsonarray);

        // Mais ce n est pas touuuuuuuuuuuut. Issue resolution : We now get a jwt (status 200 signed_response) or not (status 400 error)
        $tempresult = block_smartest\smartest_moodle_jwt::get_smartest_access($moodlejwt);

        // TODO prevent Smartest nginx server to crash (error 500) with big jwt 10000+ users.
        $smartestresponse = json_decode($tempresult, true);

        // Is you signed or not?.
        if (array_key_exists('signed_response', $smartestresponse)) {

            // Is you good signed or not?.
            if (block_smartest\smartest_moodle_jwt::verify_smartest_signature($smartestresponse['signed_response'])) {

                $tempresult = block_smartest\smartest_moodle_jwt::get_smartest_payload($smartestresponse['signed_response']);
                $smartestresponse = json_decode($tempresult, true);

                if (array_key_exists('url', $smartestresponse)) {
                    $SESSION->smartestclass = $smartestresponse['url'];
                    $SESSION->moodleclass = $cid;

                    echo html_writer::tag('h5', get_string('disclaimer', 'block_smartest'));
                    echo html_writer::start_tag('br');
                    // ... privacy api
                    $collection = new \core_privacy\local\metadata\collection('block_smartest');
                    $classname = \core_privacy\manager::get_provider_classname_for_component('block_smartest');
                    $classname::get_metadata($collection);
                    $smartestprivacytext = "";
                    foreach ($collection->get_collection()[0]->get_privacy_fields() as $smartestprivacy) {
                        $smartestprivacytext = $smartestprivacytext . get_string($smartestprivacy, 'block_smartest') . '<br>';
                    }
                    $smartestprivacytext = $smartestprivacytext
                        . '<a href=\'https://smartest.io/data-privacy/\' target=\'_blank\'>'. get_string('privacy_clickhere', 'block_smartest') . '</a>';
                    echo $OUTPUT->notification($smartestprivacytext, 'success');
                    // ...
                    echo html_writer::start_tag('br');
                    echo $OUTPUT->single_button('sso.php', get_string('accessmartest', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
                    echo $OUTPUT->single_button($smartestresponse['url'], get_string('newaccessmartest', 'block_smartest'), 'get', $smartest->smartestbuttonstyleblanktarget);

                    echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);

                    if ($isteacher) {
                        // We give the teacher the option to import grades for this class.
                        echo html_writer::empty_tag('hr');echo html_writer::start_tag('br');
                        echo html_writer::tag('h5', get_string('asateacher', 'block_smartest')); echo html_writer::start_tag('br');
                        echo $OUTPUT->single_button('gr_import.php?id=' . $cid, get_string('importsmartestgrades', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
                    }
                } else {
                    // ..."error": "ExternalPlatformOrganization matching query does not exist.".
                    echo html_writer::tag('h4', get_string('notallowed', 'block_smartest')); echo html_writer::start_tag('br');
                    echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
                }
            } else {
                // ..."error": "Signature verification failed"
                echo html_writer::tag('h4', get_string('notallowed', 'block_smartest')); echo html_writer::start_tag('br');
                echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
            }
        } else {
            // ..."error": "Signature verification failed"
            echo html_writer::tag('h4', get_string('notallowed', 'block_smartest')); echo html_writer::start_tag('br');
            echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
        }
    } else {
        echo html_writer::tag('h4', get_string('notallowed', 'block_smartest')); echo html_writer::start_tag('br');
        echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
    }
} else {
    // Smartest auth does not exist or user is neither a Smartest teacher nor a student.
    echo html_writer::tag('h4', get_string('noaccess', 'block_smartest')); echo html_writer::start_tag('br');
    echo $OUTPUT->single_button($continueurl, get_string('returntocourse', 'block_smartest'), 'get', $smartest->smartestbuttonstyle);
}
echo $OUTPUT->footer();
