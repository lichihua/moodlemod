<?php
/*
function certificate_add_instance($certificate);
function certificate_update_instance($certificate);
function certificate_delete_instance($id);
*/

/*
 * D:\xampp\htdocs\project\moodle\mod\devvideo\view.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\locallib.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\lib.php
 * 这个页面没有加载renderer
 *
 * */
//$data= new stdClass();
//$data = new stdClass();
//$data->name = $formdata->name;
//$data->timemodified = time();
//$data->timecreated = time();
//$data->course = $formdata->course;
//$data->courseid = $formdata->course;
//$data->intro = $formdata->intro;
//$data->introformat = $formdata->introformat;
//$data->width = $formdata->width;
//$data->height = $formdata->height;
//$data->responsive = $formdata->responsive;

/**
 * 添加 devvideo活动实例
 *
 * @param stdClass $data     表单提交过来的数据和其他的数据(参数在那定义的没找到我们只需在这三个必须的函数里追加这个插件数据表的值就行)
 * @param mod_videofile_mod_form $form
 * @return int The instance id of the new videofile instance
 */
function devvideo_add_instance(stdClass $data){

    //global $DB;
    //return $DB->insert_record("devvideo", $data);

    //在函数外存在 devvideo类的在函数内必须重新加载这个类文件
    //require_once(dirname(__FILE__) .'/locallib.php');
    $context = context_module::instance($data->coursemodule);
    $devvideo = new devvideo($context,null,null);
    return $devvideo->add_instance($data);
}
function devvideo_update_instance($data) {
    //global $DB;
    //return $DB->update_record("devvideo", $data);

    //在函数外存在 devvideo类的在函数内必须重新加载这个类文件
    //require_once(dirname(__FILE__) .'/locallib.php');
    $context = context_module::instance($data->coursemodule);
    $devvideo = new devvideo($context, null, null);
    return $devvideo->update_instance($data);

}
function devvideo_delete_instance($id) {
//    global $DB;
//
//    if (! $data = $DB->get_record("devvideo", array("id"=>$id))) {
//        return false;
//    }
//
//    $result = true;
//
//    if (! $DB->delete_records("devvideo", array("id"=>$data->id))) {
//        $result = false;
//    }return $result;
    require_once(dirname(__FILE__) . '/locallib.php');

    $cm = get_coursemodule_from_instance('devvideo', $id, 0, false, MUST_EXIST);
    $context = context_module::instance($cm->id);
    $devvideo = new devvideo($context, null, null);
    return $devvideo->delete_instance();

}




/*废弃的方法*/
function get_devvideo_name($devvideo) {
    $name = strip_tags(format_string($devvideo->name,true));//从字符串中去掉HTML和PHP标签
    if (core_text::strlen($name) >5) {
        $name = core_text::substr($name, 0, 5)."...";
    }

    if (empty($name)) {
        // arbitrary name
        $name = get_string('modulename','devvideo');
    }

    return $name;
}

