<?php

defined('MOODLE_INTERNAL') || die();

class devvideo{
	/**@var stdClass 活动模块上下文环境*/
	private $context;
	/*course_moudle实例*/
	private $coursemodule;
	/*课程实例*/
	private $course;
     /*活动实例用于缓存被其他方法调用如删除，避免再次请求数据库*/
    private $instance;

	public function __construct($context,$cm=null,$course=null){


		$this->context = $context;
		$this->coursemodule = $cm;
		$this->course = $course;
	}
    /**
     * 添加这个视频 文件
     * @param stdClass $newformdata   在./lib.php处理过的表单数据
     * @return void  $returnid
     */
    public function  add_instance($newformdata){
        global $DB;
        //处理从lib传过来的表单值主要是新增两个时间函数
        $addformdata = new stdClass();
        $addformdata->name = $newformdata->name;
        $addformdata->course = $newformdata->course;
        $addformdata->intro = $newformdata->intro;
        $addformdata->introformat = $newformdata->introformat;
        $addformdata->width = $newformdata->width;
        $addformdata->height = $newformdata->height;
        $addformdata->responsive = $newformdata->responsive;
        $addformdata->timecreated = time();
        $addformdata->timemodified =time();
        //插入数据库并返回结果
        $returnid = $DB->insert_record('devvideo',$addformdata);
        //触发事件
        //...想法在写个触发事件的方法
        //获取这个插件的实例并将他放进instance属性 作用？
        $this->instance = $DB->get_record('devvideo', array('id' => $returnid), '*', MUST_EXIST);
        //缓存课程记录？
        $this->course = $DB->get_record('course', array('id' => $newformdata->course), '*', MUST_EXIST);
        return $returnid;
    }

    /**
     * 修改这个视频 文件
     * @param stdClass $newformdata   在./lib.php处理过的表单数据
     * @return void  $result
     */
    public function update_instance($newformdata){
        global $DB;
        //处理从lib传过来的表单值主要是新增两个时间函数
        $updateformdata = new stdClass();
        $updateformdata->id = $newformdata->instance;
        $updateformdata->name = $newformdata->name;
        $updateformdata->intro = $newformdata->intro;
        $updateformdata->introformat = $newformdata->introformat;
        $updateformdata->width = $newformdata->width;
        $updateformdata->height = $newformdata->height;
        $updateformdata->responsive = $newformdata->responsive;
        $updateformdata->timecreated = time();
        $updateformdata->timemodified =time();

        //修改数据库
        $result = $DB->update_record('devvideo', $updateformdata);
        //获取这个插件的实例并将他放进instance属性 作用？
        $this->instance = $DB->get_record('devvideo', array('id' => $updateformdata->id), '*', MUST_EXIST);

        //储存上传的文件
        $this->save_files($newformdata);//注意这里的参数不是$updateformdata

        return $result;
    }

    /**
     * 储存上传的（草稿）文件？
     *
     * @param stdClass $formdata
     * @return void
     */
    public function save_files($formdata){
        global $DB;
        
        // 从编辑时filemanager(视频)中存储的文件
        $draftitemid = $formdata->videos;
        if ($draftitemid) {
            file_save_draft_area_files(
                $draftitemid,
                $this->context->id,
                'mod_devvideo',
                'videos',
                0
            );
        }

        // 从辑时filemanager(字幕)中存储的文件
        $draftitemid = $formdata->captions;
        if ($draftitemid) {
            file_save_draft_area_files(
                $draftitemid,
                $this->context->id,
                'mod_devvideo',
                'captions',
                0
            );
        }

        // 从编辑时filemanager(海报)中存储的文件.
        $draftitemid = $formdata->posters;
        if ($draftitemid) {
            file_save_draft_area_files(
                $draftitemid,
                $this->context->id,
                'mod_devvideo',
                'posters',
                0
            );
        }
    }

    /**
     * 删除这个视频 文件活动
     *
     * @return void  $result
     */
    public function delete_instance(){
        global $DB;
        $result = true;

        // 删除与此视频文件相关联的文件.
        $fs = get_file_storage();
        if (! $fs->delete_area_files($this->context->id) ) {
            $result = false;
        }
        //删除实例.
        // 注意: 所有上下文文件都被自动删除.
        $DB->delete_records('devvideo', array('id' => $this->get_instance()->id));

        return $result;
    }

    /**
     *获取该视频活动的当前实例的设置
     *
     * @return stdClass The settings
     */
    public function get_instance() {
        global $DB;
        if ($this->instance) {
            return $this->instance;
        }
        if ($this->get_course_module()) {
            $params = array('id' => $this->get_course_module()->instance);
            $this->instance = $DB->get_record('devvideo', $params, '*', MUST_EXIST);
        }
        if (!$this->instance) {
            throw new coding_exception('Improper use of the videofile class. ' .
                'Cannot load the videofile record.');
        }
        return $this->instance;
    }
    /**
     * 获取当前课程活动.
     *
     * @return mixed stdClass|null 课程活动
     */
    public function get_course_module() {
        if ($this->coursemodule) { //已被初始化设置
            return $this->coursemodule;
        }
        if (!$this->context) { //已被初始化设置
            return null;
        }

        if ($this->context->contextlevel == CONTEXT_MODULE) {
            $this->coursemodule = get_coursemodule_from_id('devvideo', $this->context->instanceid, 0, false, MUST_EXIST);
            return $this->coursemodule;
        }
        return null;
    }



    /**
     * 获取当前课程对象.
     *
     * @return mixed stdClass|null 课程对象
     */
    public function get_course() {
        global $DB;

        if ($this->course) {
            return $this->course;
        }

        if (!$this->context) {
            return null;
        }
        $params = array('id' => $this->get_course_context()->instanceid);
        $this->course = $DB->get_record('course', $params, '*', MUST_EXIST);

        return $this->course;
    }

    /**
     * 获取当前课程的上下文.
     *
     * @return mixed context|null 课程上下文
     */
    public function get_course_context() {
        if (!$this->context && !$this->course) {
            throw new coding_exception('Improper use of the videofile class. ' .
                                       'Cannot load the course context.');
        }
        if ($this->context) {
            return $this->context->get_course_context();
        } else {
            return context_course::instance($this->course->id);
        }
    }


}