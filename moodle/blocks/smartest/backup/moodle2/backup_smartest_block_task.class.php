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
/**
 * Backup classes for block_smartest
 */
class backup_smartest_block_task extends backup_block_task {
    /**
     * block_smartest
     */
    protected function define_my_settings() {
    }
    /**
     * block_smartest
     */
    protected function define_my_steps() {
    }
    /**
     * block_smartest
     */
    public function get_fileareas() {
        return array('content');
    }
    /**
     * block_smartest
     */
    public function get_configdata_encoded_attributes() {
        return array('text'); // We need to encode some attrs in configdata.
    }
    /**
     * block_smartest
     * @param mixed $content input
     * @return mixed output
     */
    public static function encode_content_links($content) {
        return $content; // No special encoding of links.
    }
}
