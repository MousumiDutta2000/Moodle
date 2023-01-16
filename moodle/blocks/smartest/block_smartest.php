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
require_once(__DIR__.'/../../config.php');
global $CFG;
/**
 * Class initiating the block block_smartest
 */
class block_smartest extends block_base {
    /**
     * block_smartest
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_smartest');
    }
    /**
     * block_smartest
     */
    public function has_config() {
        return true;
    }
    /**
     * block_smartest
     */
    public function hide_header() {
        return true;
    }
    /**
     * block_smartest
     */
    public function applicable_formats() {
        return array('course-view' => true);
    }
    /**
     * block_smartest
     */
    public function instance_allow_multiple() {
        return false;
    }
    /**
     * block_smartest
     */
    public function get_content() {

        global $CFG;
        $smartest = new \block_smartest\smartest_constants;
        $smartest->init();

        require_once($CFG->libdir . '/filelib.php');

        if ($this->content !== null) {
            return $this->content;
        }
        $filteropt = new stdClass;
        $filteropt->overflowdiv = true;
        $filteropt->noclean = true;
        $this->content = new stdClass;
        $this->content->footer = '';
        $format = FORMAT_HTML;
        $this->content->text = format_text(get_string('contenthtml', 'block_smartest', array(
            'href' => $smartest->smartestinternalhref.$this->page->course->id,
            'img' => $smartest->smartestimg,
            'style' => $smartest->smartestimgstyle)
            ), $format, $filteropt);
        unset($filteropt); // Memory footprint.
        return $this->content;
    }
    /**
     * Serialize and store config data
     * @param mixed $data
     * @param mixed $nolongerused
     */
    public function instance_config_save($data, $nolongerused = false) {
        global $DB;

        $config = clone($data);
        parent::instance_config_save($config, $nolongerused);
    }
    /**
     * block_smartest
     */
    public function instance_delete() {
        global $DB;
        $fs = get_file_storage();
        $fs->delete_area_files($this->context->id, 'block_smartest');
        return true;
    }
    /**
     * Copy any block-specific data when copying to a new block instance.
     * @param int $fromid the id number of the block instance to copy from
     * @return boolean
     */
    public function instance_copy($fromid) {
        $fromcontext = context_block::instance($fromid);
        $fs = get_file_storage();
        // This extra check if file area is empty adds one query if it is not empty but saves several if it is.
        if (!$fs->is_area_empty($fromcontext->id, 'block_smartest', 'content', 0, false)) {
            $draftitemid = 0;
            file_prepare_draft_area($draftitemid, $fromcontext->id, 'block_smartest', 'content', 0, array('subdirs' => true));
            file_save_draft_area_files($draftitemid, $this->context->id, 'block_smartest', 'content', 0, array('subdirs' => true));
        }
        return true;
    }
    /**
     * The block should only be dockable when the title of the block is not empty
     * and when parent allows docking.
     *
     * @return bool
     */
    public function instance_can_be_docked() {
        return (!empty($this->config->title) && parent::instance_can_be_docked());
    }
}
