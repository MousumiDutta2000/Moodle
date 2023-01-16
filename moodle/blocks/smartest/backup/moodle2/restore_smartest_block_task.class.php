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
 * Restore class for block_smartest
 */
class restore_smartest_block_task extends restore_block_task {
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
     */
    public static function define_decode_contents() {
        $contents = array();
        $contents[] = new restore_smartest_block_decode_content('block_instances', 'configdata', 'block_instance');
        return $contents;
    }
    /**
     * block_smartest
     */
    public static function define_decode_rules() {
        return array();
    }
}

/**
 * Specialised restore_decode_content provider that unserializes the configdata
 * field, to serve the configdata->text content to the restore_decode_processor
 * packaging it back to its serialized form after process
 */
/**
 * block_smartest
 */
class restore_smartest_block_decode_content extends restore_decode_content {
    /**
     * block_smartest
     * @var $configdata Temp storage for unserialized configdata
     */
    protected $configdata;
    /**
     * block_smartest
     */
    protected function get_iterator() {
        global $DB;

        // Build the SQL dynamically here.
        $fieldslist = 't.' . implode(', t.', $this->fields);
        $sql = "SELECT t.id, $fieldslist
                  FROM {" . $this->tablename . "} t
                  JOIN {backup_ids_temp} b ON b.newitemid = t.id
                 WHERE b.backupid = ?
                   AND b.itemname = ?
                   AND t.blockname = 'html'";
        $params = array($this->restoreid, $this->mapping);
        return ($DB->get_recordset_sql($sql, $params));
    }
    /**
     * block_smartest
     * @param mixed $field input
     * @return mixed output
     */
    protected function preprocess_field($field) {
        $this->configdata = unserialize_object(base64_decode($field));
        return isset($this->configdata->text) ? $this->configdata->text : '';
    }
    /**
     * block_smartest
     * @param mixed $field input
     * @return mixed output
     */
    protected function postprocess_field($field) {
        $this->configdata->text = $field;
        return base64_encode(serialize($this->configdata));
    }
}
