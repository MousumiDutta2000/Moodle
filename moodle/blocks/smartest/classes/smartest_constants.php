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
/**
 * block_smartest plugin constants
 */
class smartest_constants {
    /** @var string $smartestbaseurl Self explainable */
    public $smartestbaseurl;
    /** @var array $smartestbuttonstyleblanktarget Self explainable */
    public $smartestbuttonstyleblanktarget;
    /** @var string $smartestexternalhref Self explainable */
    public $smartestexternalhref;
    /** @var string $smartestgradesapi Self explainable */
    public $smartestgradesapi;
    /** @var string $smartestimg Self explainable */
    public $smartestimg;
    /** @var string $smartestinternalhref Self explainable */
    public $smartestinternalhref;
    /** @var string $smartestsecret Self explainable */
    public $smartestsecret;
    /** @var string $smartestimgstyle Self explainable */
    public $smartestimgstyle;
    /** @var array $smartestbuttonstyle Self explainable */
    public $smartestbuttonstyle;
    /**
     * block_smartest plugin constants init
     */
    public function init():void {
        global $CFG;
        $this->smartestbaseurl = (!empty(get_config('block_smartest', 'smartestexternalhref')) ?
            get_config('block_smartest', 'smartestexternalhref') :
            'https://app.smartest.io/');
        $this->smartestbuttonstyleblanktarget = ['style' => 'width:180px',
            'target' => '_blank',
            'title' => get_string('hintbutton', 'block_smartest')];
        $this->smartestexternalhref = $this->smartestbaseurl . '/api/moodle/token/';
        $this->smartestgradesapi = $this->smartestbaseurl . '/api/moodle/grades/';
        $this->smartestimg = '<img src="' . $this->smartestbaseurl
            . '/static/media/logo.4bd1f60a860d4b110ae5.png" alt="'
            . get_string('accessmartest', 'block_smartest')
            . '" style="width:200px;height:46px;"/>';
        $this->smartestinternalhref = $CFG->wwwroot . '/blocks/smartest/sync.php?id=';
        $this->smartestsecret = !empty(get_config('block_smartest', 'smartestsecret')) ?
            get_config('block_smartest', 'smartestsecret') :
            null;
        $this->smartestimgstyle = 'style="background-color:transparent;-webkit-box-shadow:none;box-shadow:none;height:0px;"';
        $this->smartestbuttonstyle = ['style' => 'width:180px'];
    }
}
