<?php
defined('MOODLE_INTERNAL') || die();

$string['modulename'] = 'devvideo';
$string['modulenameplural'] = 'devvideos';
$string['modulename_help'] = 'Use the devvideo module for adding html5 videos with flash fallback (using video.js). This module also allows for multi-language captions.';

$string['devvideo:addinstance'] = 'Add a new devvideo';
$string['devvideo:view'] = 'View devvideo';

$string['pluginadministration'] = 'devvideo administration';
$string['pluginname'] = 'devvideo';

$string['devvideo_defaults_heading'] = 'Default values for devvideo settings';
$string['devvideo_defaults_text'] = 'The values you set here define the default values that are used in the devvideo settings form when you create a new devvideo.';
$string['width_explain'] = 'Specifies the default width of the video player.';
$string['height_explain'] = 'Specifies the default height of the video player.';
$string['responsive_explain'] = 'Specifies if responsive mode should be set as default or not.';
$string['limitdimensions_explain'] = 'Specifies if width and height should be used as maximum size during responsive mode.';

$string['filearea_captions'] = 'Captions';
$string['filearea_posters'] = 'Posters';
$string['filearea_videos'] = 'Videos';

$string['video_fieldset'] = 'Video';

$string['width'] = 'Width';
$string['width_help'] = 'Enter the width of the video here (e.g. 800 for a width of 800 pixels).';
$string['height'] = 'Height';
$string['height_help'] = 'Enter the height of the video here (e.g. 500 for a height of 500 pixels).';
$string['responsive'] = 'Responsive?';
$string['responsive_help'] = "Check to make the video automatically resize with the browser window size.\n\nUse the width and height fields to define the video proportions (e.g. 16/9 or 800/450).";
$string['responsive_label'] = '';
$string['limitdimensions'] = 'Limit size in responsive mode?';

$string['videos'] = 'Videos';
$string['videos_help'] = "Add the video file here.\n\nYou can add alternative formats in order to be sure it can play regardless of which browser is being used (usually .mp4, .ogv and .webm covers it.)";
$string['posters'] = 'Poster Image';
$string['posters_help'] = 'Add an image here that will be displayed before the video begins playing.';
$string['captions'] = 'Captions';
$string['captions_help'] = "Add transcriptions of the dialogue in WebVTT format here.\n\nYou can add several files in order to provide multilingual captions. The file names, without extensions, will be used for the video caption option titles. If the files are named according to ISO 6392 (e.g. eng.vtt and swe.vtt) the options will be shown as the corresponding full language names according to the user's language preferences (e.g. English and Swedish, assuming the user's preferred language is set to English).";

$string['err_positive'] = 'You must enter a positive number here.';

$string['video_not_playing'] = 'Video not playing? Try {$a}.';
$string['htmlpriority'] = 'video priority.';
$string['htmlpriority_help'] = '播放器优先级可以设置默认的播放器对于ie8以下不支持html5,<br /> flash播放器目的是兼容旧版浏览器，需要flash插件,html5适用于新版本的浏览器无需安装flash插件.';