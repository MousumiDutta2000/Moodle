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

/* Ref https://docs.moodle.org/dev/Admin_settings#Individual_settings */
/* Ref https://docs.moodle.org/dev/Blocks */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_configtext(
        'block_smartest/smartestsecret',
        new lang_string('smartestsecret', 'block_smartest'),
        new lang_string('smartestsecret_desc', 'block_smartest'),
        new lang_string('contactsmartest', 'block_smartest'),
        PARAM_TEXT
    ));
    $settings->add(new admin_setting_configtext(
        'block_smartest/smartestexternalhref',
        new lang_string('smartestexternalhref', 'block_smartest'),
        new lang_string('smartestexternalhref_desc', 'block_smartest'),
        new lang_string('contactsmartest', 'block_smartest'),
        PARAM_TEXT
    ));
}
