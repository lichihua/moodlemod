<?php
/**
 * devvideo活动模块全局默认值
 *  设置的值在config_plugins表格式如下plugin name value : devvideo width 800
 * @package    mod_devvideo
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    require_once($CFG->libdir . '/resourcelib.php');

    $displayoptions = resourcelib_get_displayoptions(
        array(RESOURCELIB_DISPLAY_OPEN, RESOURCELIB_DISPLAY_POPUP));
    $defaultdisplayoptions = array(RESOURCELIB_DISPLAY_OPEN);

    // 头部.
    $settings->add(
        new admin_setting_heading('devvideo_defaults',
            get_string('devvideo_defaults_heading', 'devvideo'),
            get_string('devvideo_defaults_text', 'devvideo')));

    // 默认宽度.
    $settings->add(
        new admin_setting_configtext('devvideo/width',
            get_string('width', 'devvideo'),
            get_string('width_explain', 'devvideo'),
            800,
            PARAM_INT,
            7));

    // 默认高度.
    $settings->add(
        new admin_setting_configtext('devvideo/height',
            get_string('height', 'devvideo'),
            get_string('height_explain', 'devvideo'),
            500,
            PARAM_INT,
            7));

    // 默认响应式自动布局.
    $settings->add(
        new admin_setting_configcheckbox('devvideo/responsive',
            get_string('responsive', 'devvideo'),
            get_string('responsive_explain', 'devvideo'),
            0));

    // 默认情况下，在响应模式标志中使用 宽度/高度 为 最大宽度/最大高度 。
    $settings->add(
        new admin_setting_configcheckbox('devvideo/limitdimensions',
            get_string('limitdimensions', 'devvideo'),
            get_string('limitdimensions_explain', 'devvideo'),
            0));
}
