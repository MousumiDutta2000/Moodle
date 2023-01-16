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

namespace block_smartest\privacy;
use core_privacy\local\metadata\collection;
    /**
     * block_smartest
     */
class provider implements
    // This plugin export data to an external location
    // Ref: https://docs.moodle.org/dev/Privacy_API#Indicating_that_you_export_data_to_an_external_location.

\core_privacy\local\metadata\provider,
\core_privacy\local\request\data_provider {
    /**
     * block_smartest
     * @param collection $collection
     * @return collection
     */
    public static function get_metadata(collection $collection) : collection {

        $collection->add_external_location_link('smartest_gdpr', [
                'userid' => 'privacy:metadata:smartest_gdpr:userid',
                'fullname' => 'privacy:metadata:smartest_gdpr:fullname',
                'email' => 'privacy:metadata:smartest_gdpr:email',
                'roles' => 'privacy:metadata:smartest_gdpr:roles',
                'classdetails' => 'privacy:metadata:smartest_gdpr:classdetails',
                'schooldetails' => 'privacy:metadata:smartest_gdpr:schooldetails',
            ], 'privacy:metadata:smartest_gdpr');

        return $collection;
    }
}
