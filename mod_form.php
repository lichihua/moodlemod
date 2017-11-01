<?php
defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot . '/course/moodleform_mod.php');
require_once(dirname(__FILE__) . '/locallib.php');
require_once($CFG->libdir . '/filelib.php');

class mod_devvideo_mod_form extends moodleform_mod {
	public function definition() {
	    global $CFG;
        //获取settings.php的默认全局参数
        $config = get_config('devvideo');
        //初始化表单
        $mform =& $this->_form;
        /* 概要*/
        $mform->addElement('header', 'general', get_string('general', 'form')); // 概要
        $mform->addElement('text', 'name', get_string('name'), array('size' => '48')); //活动名称和描述
        //清理html标签【表单的输入类型】
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
        //为给定的字段添加一个验证规则
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name',
            get_string('maximumchars', '', 255),
            'maxlength',
            255,
            'client');
        //为活动的引入字段添加一个编辑器
        $this->standard_intro_elements();


        //devvideo 设置
        $mform->addElement('header', 'video_fieldset', get_string('video_fieldset', 'devvideo'));////devvideo 设置

        // 宽(有默认值).
        $mform->addElement('text', 'width', get_string('width', 'devvideo'), array('size' => 4));//text框
        $mform->setType('width', PARAM_INT);
        $mform->addHelpButton('width', 'width', 'devvideo');
        $mform->addRule('width', null, 'required', null, 'client');
        $mform->addRule('width', null, 'numeric', null, 'client');
        $mform->addRule('width', null, 'nonzero', null, 'client');
        $mform->setDefault('width', $config->width);


        // 高(有默认值).
        $mform->addElement('text', 'height', get_string('height', 'devvideo'), array('size' => 4));
        $mform->setType('height', PARAM_INT);
        $mform->addHelpButton('height', 'height', 'devvideo');
        $mform->addRule('height', null, 'required', null, 'client');
        $mform->addRule('height', null, 'numeric', null, 'client');
        $mform->addRule('height', null, 'nonzero', null, 'client');
        $mform->setDefault('height', $config->height);

        // 响应式(有默认值).
        $mform->addElement('advcheckbox', 'responsive', get_string('responsive', 'devvideo'), get_string('responsive_label', 'devvideo'));
        $mform->setType('responsive', PARAM_INT);
        $mform->addHelpButton('responsive', 'responsive', 'devvideo');
        $mform->setDefault('responsive', $config->responsive);

        // 视频文件上传管理.
        $options = array('subdirs' => false,  //子目录
            'maxbytes' => 0,
            'maxfiles' => -1,//多文件上传？
            'accepted_types' => array('.mp4', '.webm', '.ogv','.flv'));
        $mform->addElement(
            'filemanager',
            'videos', //这个对应的是字段或者form对象的属性
            get_string('videos', 'devvideo'),
            null,
            $options);
        $mform->addHelpButton('videos', 'videos', 'devvideo');
        $mform->addRule('videos', null, 'required', null, 'client');



        // 海报图片文件管理.
        $options = array(
            'subdirs' => false,
            'maxbytes' => 0,
            'maxfiles' => 1,
            'accepted_types' => array('image'));
        $mform->addElement(
            'filemanager',
            'posters',
            get_string('posters', 'devvideo'),
            null,
            $options);
        $mform->addHelpButton('posters', 'posters', 'devvideo');

        // 字幕文件管理.
        $options = array(
            'subdirs' => false,
            'maxbytes' => 0,
            'maxfiles' => -1,
            'accepted_types' => array('.vtt'));
        $mform->addElement(
            'filemanager',
            'captions',
            get_string('captions', 'devvideo'),
            null,
            $options);
        $mform->addHelpButton('captions', 'captions', 'devvideo');

        //devvideo 设置2
        $mform->addElement('header', 'video_fieldset', get_string('video_fieldset', 'devvideo').'2');//devvideo 设置
        // 宽(有默认值).
        $options=array(0 => 'flash优先',1 => 'html5播放器优先');
        $mform->addElement('select', 'priority', get_string('htmlpriority', 'devvideo'),$options)->setSelected(1);//select框
        //$mform->setType('htmlpriority', PARAM_INT);
        $mform->addHelpButton('priority', 'htmlpriority', 'devvideo');
        $mform->addRule('priority', null, 'required', null, 'client');
        //$mform->addRule('width', null, 'numeric', null, 'client');
        //$mform->setDefault('priority', 1);//和setSelected方法一样值可以是：$config->width


		//为活动的引入字段添加一个编辑器 标准form表单，通用于所有模块。必须
		 $this->standard_coursemodule_elements();
		 //标准按钮，所有模块都通用 必须。
		 $this->add_action_buttons();
	}
}