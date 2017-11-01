<?php
defined('MOODLE_INTERNAL') || die();

$string['modulename'] = 'devvideo';
$string['modulenameplural'] = 'devvideos';
$string['modulename_help'] = '使用devvideo模块来添加html5视频和flash。这个模块还允许多语言字幕。';

$string['devvideo:addinstance'] = '添加一个新的devvideo';
$string['devvideo:view'] = '浏览devvideo';

$string['pluginadministration'] = 'devvideo视频管理';
$string['pluginname'] = 'devvideo';

$string['devvideo_defaults_heading'] = 'devvideo的默认值设置';
$string['devvideo_defaults_text'] = '您在这里定义了的值会在创建新的devvideo时使用的devvideo设置中用作默认值';
$string['width_explain'] = '指定视频播放器的默认宽度';
$string['height_explain'] = '指定视频播放器的默认高度。';
$string['responsive_explain'] = '指定响应模式是否应该设置为默认值。';
$string['limitdimensions_explain'] = '指定在响应模式下，宽度和高度应被用作最大尺寸。';

$string['filearea_captions'] = '字幕';
$string['filearea_posters'] = '海报';
$string['filearea_videos'] = 'Videos';

$string['video_fieldset'] = 'devvideo设置';

$string['width'] = '像素宽度(单位：px)';
$string['width_help'] = '在这里输入视频的宽度(例如:800 表示800像素)';
$string['height'] = '像素高度(单位：px)';
$string['height_help'] = '在这里输入视频的高度(例如:800 表示800像素)';
$string['responsive'] = '响应式?';
$string['responsive_help'] = "检查以浏览器窗口大小自动调整视频大小。\n\n使用宽度和高度字段来定义视频比例(例如:16/9或800/450)";
$string['responsive_label'] = '';
$string['limitdimensions'] = '在响应模式下限制大小?';

$string['videos'] = '视频文件';
$string['videos_help'] = "在这里添加视频文件。\n\n您可以添加其他格式，以确保它可以播放，而不管使用的是哪个浏览器(通常是.mp4,.ogv和覆盖它)";
$string['posters'] = '海报图片';
$string['posters_help'] = '在这里添加一个图像,用在在视频开始播放之前显示';
$string['captions'] = '字幕';
$string['captions_help'] = "在WebVTT格式中添加对话框.\n\n你可以添加几个文件来提供多种语言说明.没有扩展名的文件名称将用于视频标题、选项标题. 如果这些文件是根据ISO 6392(比如eng。vtt和swe.vtt)选项将根据用户的语言首选项显示为相应的完整语言名称(如英语和瑞典语，假定用户的首选语言设置为英语).";

$string['err_positive'] = '你必须在这里输入一个正数.';

$string['video_not_playing'] = '视频不能播放? 尝试 {$a}.';
$string['htmlpriority'] = '播放器优先级.';
$string['htmlpriority_help'] = '播放器优先级可以设置默认的播放器对于ie8以下不支持html5,<br /> flash播放器目的是兼容旧版浏览器，需要flash插件,html5适用于新版本的浏览器无需安装flash插件.';
