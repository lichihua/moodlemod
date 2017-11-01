<?php
defined('MOODLE_INTERNAL') || die();

// TODO $module is deprecated for 2.7 and should be replaced with $plugin.
// However, Moodle 2.4 still requires $module and it would not make sense
// to break compatibility (yet).
$plugin->version  = 2016071202;
$plugin->requires = 2012120300;
$plugin->cron     = 0;
$plugin->component = 'mod_devvideo';
$plugin->maturity = MATURITY_STABLE;
$plugin->release  = '1.05';