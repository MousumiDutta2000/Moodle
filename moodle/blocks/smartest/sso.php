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
global $DB, $OUTPUT, $SESSION;

$cid = $SESSION->moodleclass;
$course = $DB->get_record('course', array('id' => $cid), '*', MUST_EXIST);
$context = context_course::instance($cid);
require_login($course, true);

$PAGE->set_url('/blocks/smartest/sso.php', array('id' => $cid));
$PAGE->set_title(get_string('pluginname', 'block_smartest'));
$PAGE->set_heading(get_string('newsmartestblock', 'block_smartest'));
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');

echo $OUTPUT->header();
echo '<div class="embed-responsive embed-responsive-4by3">';
echo '<iframe class="embed-responsive-item" src="'
    . $SESSION->smartestclass
    . '">'. get_string('noiframe', 'block_smartest') . '</iframe>';
echo '</div>';
echo $OUTPUT->footer();
