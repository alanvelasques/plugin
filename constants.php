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
 * Intermediator for managing actions executed by the Cognitiva Brasil server.
 *
 * @package   tecmides
 * @copyright 2018 - Cognitiva Brasil
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 * @author    Luis Mercado (lawmercado [at] inf [dt] ufrgs [dt] br)
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

global $CFG;

define("LOG_TABLE", "{$CFG->prefix}logstore_standard_log");
define("USER_TABLE", "{$CFG->prefix}user");
define("ACTIVITY_TABLE", "{$CFG->prefix}tecmides_activity");
define("PROFILE_TABLE", "{$CFG->prefix}tecmides_profile");

define("QUARTILE_LOW", 0);
define("QUARTILE_MEDIUM", 1);
define("QUARTILE_MEDIUMHIGH", 2);
define("QUARTILE_HIGH", 3);

define("MINDSTATE_SATISFIED", 0);
define("MINDSTATE_DISSATISFIED", 1);
define("MINDSTATE_DISCOURAGED", 2);
define("MINDSTATE_ANIMATED", 3);
define("MINDSTATE_OTHER", 4);
define("MINDSTATE_NONE", 5);

define("RECURRENCE_NEVER", 0);
define("RECURRENCE_RARELY", 1);
define("RECURRENCE_SOMETIMES", 2);
define("RECURRENCE_OFTEN", 3);
define("RECURRENCE_ALWAYS", 4);
