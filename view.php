<?php
require_once(dirname(__FILE__) . '/../../config.php');
require_once(dirname(__FILE__) . '/locallib.php');
/*
 * "D:\xampp\htdocs\project\moodle\mod\devvideo\view.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\locallib.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\lib.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\classes\event\course_module_viewed.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\renderer.php ????没有renderer了
 * */

//cmid
$id = required_param('id', PARAM_INT);
////给定一个课程活动的id 返回活动的实例course_modules 最好有第一个参数不然要在此函数内部在查一遍数据库得到他
$cm = get_coursemodule_from_id('devvideo',$id,0,false,MUST_EXIST);

$whereparams=array('id'=>$cm->course);
$course=$DB->get_record('course',$whereparams,'*',MUST_EXIST);
//上下文
$context = context_module::instance($cm->id);

//实例化locallib.php里的devvideo类
$devvideo = new devvideo($context,$cm,$course);

//验证登陆
require_login($course,true,$cm);

//验证权限
require_capability('mod/devvideo:view',$context);
//print_r(has_capability('mod/devvideo:view',$context));

//设置渲染模板
$PAGE->set_pagelayout('incourse');

//设置url
//$url = new moodle_url('/mod/devvideo/view.php',array('id'=>$id));
$PAGE->set_url('/mod/devvideo/view.php',array('id'=>$cm->id));

//如果该活动需要完成状态，修改‘viewed’状态
$completion = new completion_info($course);
$completion->set_module_viewed($cm);


//触发查看的日志事件
if(class_exists('\core\event\course_module_viewed')){

	$event= \mod_devvideo\event\course_module_viewed::create(
		array(
			'objectid'=>$cm->instance,
			//'context'=>$PAGE->context,
			'context'=>$context,
		)

	);

	//添加将最可能用于事件观察者的缓存数据 提高性能
	$event->add_record_snapshot('course', $course);

	//触发事件
	$event->trigger();
}else{

	//旧版本的遗留日志在2.7弃用
    add_to_log($course->id,
               'devvideo',
               'view',
               'view.php?id=' . $cm->id,
               $devvideo->get_instance()->id, $cm->id);
}


//渲染devvideo的renderer类
$renderer = $PAGE->get_renderer('mod_devvideo');

//输出页面
echo $renderer->video_page($devvideo);


