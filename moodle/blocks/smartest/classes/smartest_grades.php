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

/* Ref https://docs.moodle.org/dev/Blocks */
namespace block_smartest;

require_once(__DIR__.'/../../../config.php');
global $CFG;

require_once($CFG->dirroot.'/grade/import/lib.php');
/**
 * A class for importing Smartest grades to Moodle
 */
class smartest_grades {
    /**
     * Parses the grades from Smartest into the grading report
     * @param mixed $text
     * @param mixed $course
     * @param mixed $error
     */
    public static function parse_smartest_grades($text, $course, &$error) {
        global $USER, $DB;
        $status = true;
        $importcode = get_new_importcode();

        $cat  = $DB->get_records_sql('SELECT (id) FROM {grade_categories} where courseid=?', array('courseid' => $course->id));
        foreach ($cat as $cata) {
            // We need only the first.
            break;
        }
        foreach ($text as $result) {
            // ...array(7).
            $gradeidnumber = $result['exercise_id'];
            if (!$gradeitems = \grade_item::fetch_all(array('idnumber' => $gradeidnumber, 'courseid' => $course->id))) {
                // ...gradeitem does not exist and so we want to insert

                $gradeitem = new \grade_item(array('courseid' => $course->id,
                    'itemtype' => 'manual',
                    'itemname' => $result['exercise_name'],
                    'categoryid' => $cata->id,
                    'idnumber' => $result['exercise_id'],
                    'needsupdate' => 0,
                    'timecreated' => $importcode,
                    'timemodified' => $importcode),
                    false);
                $DB->insert_record('grade_items', $gradeitem);
                $gradeitems = \grade_item::fetch_all(array('idnumber' => $gradeidnumber, 'courseid' => $course->id));
            }

            $gradeitem = reset($gradeitems);

            // Grade item locked, abort.
            if ($gradeitem->is_locked()) {
                $status = false;
                $error  = get_string('gradeitemlocked', 'grades');
                break;
            }

            // Check if user exist and convert user_email to user id.
            $useremail = $result['user_email'];
            if (!$user = $DB->get_record('user', array('email'  => $useremail))) {
                // No user found, abort.
                $status = false;
                $error = get_string('errincorrectuseridnumber', 'gradeimport_xml', $useremail);
                break;
            }

            // Check if grade_grade is locked and if so, abort.
            if ($gradegrade = new \grade_grade(array('itemid' => $gradeitem->id, 'userid' => $user->id))) {
                $gradegrade->grade_item =& $gradeitem;
                if ($gradegrade->is_locked()) {
                    // Individual grade locked, abort.
                    $status = false;
                    $error  = get_string('gradelocked', 'grades');
                    break;
                }
            }
            $newgrade = new \stdClass();
            $newgrade->itemid     = $gradeitem->id;
            $newgrade->userid     = $user->id;
            $newgrade->importcode = $importcode;
            $newgrade->importer   = $USER->id;

            // Check grade value exists and is a numeric grade.
            if ($result['best_score'] !== null) {
                if (is_numeric($result['best_score'])) {
                    $newgrade->finalgrade = $result['best_score'] * 100;
                } else {
                    $status = false;
                    $error = get_string('badgrade', 'grades');
                    break;
                }
            } else {
                $newgrade->finalgrade = null;
            }

            $newgrade->feedback = null;

            // Insert this grade into a temp table.
            $DB->insert_record('grade_import_values', $newgrade);

        }
        if ($status) {
            return $importcode;

        } else {
            import_cleanup($importcode);
            return false;
        }
    }

}
