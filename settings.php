<?php
/**
 * Settings for BigBlueButtonBN
 *
 * @package   mod_bigbluebuttonbn
 * @author    Jesus Federico  (jesus [at] blindsidenetworks [dt] com)
 * @copyright 2010-2014 Blindside Networks Inc.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 */
defined('MOODLE_INTERNAL') || die;
if ($ADMIN->fulltree) {
    $settings->add( new admin_setting_configcheckbox( 'TecmidesSendTrainingData', get_string( 'tecmidesSendTreiningData', 'report_tecmides' ), get_string( 'senddata', 'report_tecmides' ), 1) );
    $settings->add( new admin_setting_configtext( 'TecmidesWebserviceURL', get_string( 'tecmidesURL', 'report_tecmides' ), get_string( 'tecmidesurl', 'report_tecmides' ), 'http://test-tecmides.url/' ) );
    $settings->add( new admin_setting_configtext( 'TecmidesAlgorithmModel', get_string( 'tecmidesAlgorithmModel', 'report_tecmides' ), get_string( 'algorithmmodel', 'report_tecmides' ), 'Regras' ) );
}
?>