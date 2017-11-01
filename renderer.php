<?php 
defined('MOODLE_INTERNAL') || die();

/*
 * D:\xampp\htdocs\project\moodle\mod\devvideo\view.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\locallib.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\lib.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\classes\event\course_module_viewed.php
 * D:\xampp\htdocs\project\moodle\mod\devvideo\renderer.php
 * */

//require_once($CFG->dirroot.'/mod/devvideo/locallib.php');
class mod_devvideo_renderer extends plugin_renderer_base{


    /**
     * 接受并组装表单参数
     *
     * @param stdClass $devvideo ocallib.php里的devvideo对象
     * @return array formdata
     */
    public function get_devvideo_instance($devvideo){
     var_dump($devvideo->get_instance());
        $setting_sparams= new stdClass;

        $html_priority   =$devvideo->htmlpriority;//html5优先级
        $calling_method  =$devvideo->callingmethod;//调用方式
        $autoplay        =$devvideo->autoplay ;//默认播放设置
        $posters         =$devvideo->posters;//海报默认初始化图片
        $label_time      =$devvideo->labeltime;//提示点（标签）时间点
        $label_hint      =$devvideo->labelhint;//标签提示
        
       


    }



    /**
     * 最终页面输出方法
     *
     * @param stdClass $devvideo ocallib.php里的devvideo对象
     * @return string HTML
     */
	public function video_page($devvideo){




        echo $this->get_devvideo_instance($devvideo);
        echo $this->display_header($devvideo);//输出头和js代码
        echo $this->display_contents($devvideo);




        echo $this->output->footer();
    }


    public function display_contents($devvideo){
        //检测栏
            $contentss='该处是用来监听播放器实时返回的各种状态，可以根据这里的状态实时的控制播放器';
            $attributess = array('id'=>'statusvalue','name'=>'statusvalue','rows'=>'15','style'=>'width:200px;height:400px;');
           // echo html_writer::tag('textarea', $contentss, $attributess);
        //检测栏   

        echo html_writer::start_div('studyMain',array('id'=>'studyMain'));
        echo html_writer::start_tag('div',array('class'=>'video-con','id'=>'bgarea'));

        echo html_writer::start_div('course-video-box',array('id'=>'J_Box'));
        $complete=0;
        if($complete==1){
            /*输出视频结束的页面*/
            $completecontent='
                            <div class="next-box-inner">
                                <div class="course-tip-layer J-next-course" data-next-src="/video/4844">
                                    <h2>下一节课程： 关于编程字体选择
                                            <span class="course-duration"> (01:32)</span>
                                    </h2>
                                    <div class="J-next-auto hide next-auto"><em>3</em> 秒后播放下一节</div>
                                    <div class="J-next-btn next-auto btn btn-green">下一节</div>
                                    <a href="/video/4843/0" class="review-course">重新观看</a>                           
                                    <div id="js-ques-box"></div>                       
                                </div>
                            </div>                    
                    ';
            echo html_writer::div($completecontent,$class='next-box J_next-box',$attributes=array('id'=>'next-box J_next-box'));

        } else{
            /*输出视频*/

            echo html_writer::div($content=null,$class='a2',$attributes=array('id'=>'a1','style'=>'width:100%;height:100%;margin:0 auto '));



            echo $this->display_devvideo_javascript();


        }

        echo html_writer::end_div();/*J_Box*/

            echo html_writer::start_div('section-list',array('id'=>'section-list','style'=>'right:-360px'));

                echo $this->display_video_section_container();

            echo html_writer::end_div();/*section-list*/
        echo html_writer::end_tag('div');/*bgarea*/
        echo html_writer::end_div();/*studyMain*/
        echo $this->display_video_section_container_javascript();
    }

    public function display_devvideo_javascript(){
        global $CFG;
        $ckroot=$CFG->wwwroot.'/mod/devvideo/ckplayer6.8';
        $videoarr=array(
            'http://video.ouchn.cn/xueqianjiaoyuyuanli/v4_1_1%20%E6%95%99%E8%82%B2%E7%9B%AE%E7%9A%84%E6%A6%82%E8%BF%B0.mp4',
            'http://www.ckplayer.com/down/adv6.1_1.swf|http://www.ckplayer.com/down/adv6.1_2.swf',
            'http://img.ksbbs.com/asset/Mon_1605/0ec8cc80112a2d6.mp4',
            'http://video.ouchn.cn/xueqianjiaoyuyuanli/shipinketang/v5%E5%84%BF%E7%AB%A5%E5%8F%91%E5%B1%95%E4%B8%8E%E5%84%BF%E7%AB%A5%E8%A7%82.mp4',
        );
        $setting_sparams=array(
            'flashvars'=>array(
                'f'=> $videoarr[3],
                'c'=> 0,//是否读取文本配置,0不是，1是。0=加载ckplayer.js中的ckstyle()函数1=调用ckplayer.xml来做配置
                'p'=>2,//视频默认0是暂停，1是播放，2是不加载视频
                'i'=>'http://www.ckplayer.com/static/images/cqdw.jpg',//初始图片地址
                'my_url'=>'encodeURIComponent(window.location.href)',
                'my_title'=>'encodeURIComponent(document.title)',
                'my_pic'=>'http://www.ckplayer.com/static/images/cqdw.jpg',
                'k'=>'30|60',
                'n'=>'30秒提示功能|60秒提示功能',
                'loaded'=>'loadedHandler',//当播放器加载完成后发送该js函数loaded
            ),
            'params'=>array(
                'bgcolor'=>'#FFF',
                'allowFullScreen'=>'true',
                'allowScriptAccess'=>'always',
                'wmode','wmode'=>'transparent',
            ),
            'video'=>'http://video.ouchn.cn/xueqianjiaoyuyuanli/shipinketang/v5%E5%84%BF%E7%AB%A5%E5%8F%91%E5%B1%95%E4%B8%8E%E5%84%BF%E7%AB%A5%E8%A7%82.mp4',
            'embed'=>array(
                'url'=>$ckroot.'/ckplayer/ckplayer.swf',
                'target_id'=>'a1', //视频所在容器的ID
                'ckplayerid'=>'ckplayer_a1',//播放器的ID
                'width'=>'100%',
                'height'=>'100%',
                'priority'=>'false',//html5优先
                'init'=>'flashvars', //初始化参数
                'mobile'=>'video',//移动端所使用的地址数组
                'else'=>'params',
            ),
        );

        $js_script="
        var flashvars={
            f:'{$setting_sparams['flashvars']['f']}',
            c:{$setting_sparams['flashvars']['c']},
            p:{$setting_sparams['flashvars']['p']},
            i:'{$setting_sparams['flashvars']['i']}',
            my_url:{$setting_sparams['flashvars']['my_url']},
            my_title:{$setting_sparams['flashvars']['my_title']},
            my_pic:'{$setting_sparams['flashvars']['my_pic']}',

            k:{$setting_sparams['flashvars']['k']},
            n:'{$setting_sparams['flashvars']['n']}',
            loaded:{$setting_sparams['flashvars']['loaded']}

        };

        var params={
            bgcolor:'{$setting_sparams['params']['bgcolor']}',
            allowFullScreen:{$setting_sparams['params']['allowFullScreen']},
            allowScriptAccess:'{$setting_sparams['params']['allowScriptAccess']}',
            wmode:'{$setting_sparams['params']['wmode']}'
        };            

        var video=['{$setting_sparams['video']}'];

        CKobject.embed(
            '{$setting_sparams['embed']['url']}',
            '{$setting_sparams['embed']['target_id']}',
            '{$setting_sparams['embed']['ckplayerid']}',
            '{$setting_sparams['embed']['width']}',
            '{$setting_sparams['embed']['height']}',
            {$setting_sparams['embed']['priority']},
            flashvars,
            video,
            params
        ); 


        //如果你不需要某项设置，可以直接删除，注意var flashvars的最后一个值后面不能有逗号
        function loadedHandler(){
            if(CKobject.getObjectById('ckplayer_a1').getType()){//说明使用html5播放器返回的是真假
                console.log('播放器已加载，调用的是HTML5播放模块');
            }
            else{
                console.log('播放器已加载，调用的是Flash播放模块');
            }
            
        }

        //监听播放器实时返回的各种状态
        var _nn=0;
        function ckplayer_status(str){
            _nn+=1;
            if(_nn>100){
                _nn=0;
                document.getElementById('statusvalue').value='';
            }
            document.getElementById('statusvalue').value=str+'\\n'+document.getElementById('statusvalue').value;

        }
           
    ";
        $output='';
        $output .= html_writer::script($js_script);
        return  $output;
    }

    public function display_video_section_container_javascript(){
        $output='';

        $script='
            var sectionlist = document.getElementById("section-list");
            var chapter = document.getElementById("chapter");
             
            chapter.onclick=function(){
               
                if(sectionlist.style.right==="0px"){
                
                    sectionlist.style.right="-360px";
                }else{
                    sectionlist.style.right="0px";
                }
   
            };  
        ';
        $output .= html_writer::script($script);
        return  $output;
    }

    /**
     * 输出devvideo的章节容器侧栏html
     *
     * @param stdClass $devvideo ocallib.php里的devvideo对象
     * @return string HTML
     */
    public function display_video_section_container($devvideo=null){

        $contents='
            <div class="operator">
                <div class="op chapter light" id="chapter"><em class="icon-menu"></em>章节</div>
                <div class="op notes" id="notes"><em class="icon-note"></em>笔记</div>
                <div class="op question" id="question"><em class="icon-addques"></em>提问</div>
                <div class="op wiki" id="wiki"><em class="icon-wiki"></em>WIKI</div>
            </div>
            <div class="nano has-scrollbar">
                <div class="nano-content" tabindex="0" style="right: -17px;">
                    <h3>大话PHP设计模式</h3>
                    <ul>
                        <li class="sec-title">
                            <span>第1章 课程简介</span>
                        </li>
                        <li data-id="4840">
                            <a href="/video/4840"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>1-1 大话PHP设计模式课程简介...(01:21)</a>                        
                        </li>
                    </ul>
                    <ul>
                        <li class="sec-title">
                            <span>第2章 开发环境准备</span>
                        </li>
                        <li data-id="4843">
                            <a href="/video/4843"><i class="">正在学<em class="icon-clock"></em></i><em class="icon-video"></em>2-1 关于PHPStorm使用(03:29)</a>                        
                        </li>
                        <li data-id="4844">
                            <a href="/video/4844">
                                <i class=""><em class="icon-nolearn"></em></i>
                                <em class="icon-video"></em>2-2 关于编程字体选择(01:32)
                            </a>                        
                        </li>
                        <li data-id="4845">
                            <a href="/video/4845"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>2-3 关于运行环境搭建(01:53)</a>                        
                        </li>
                    </ul>
                    <ul>
                        <li class="sec-title">
                            <span>第3章 命名空间与Autoload</span>
                        </li>
                        <li data-id="4846">
                                                        <a href="/video/4846"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>3-1 关于命名空间(04:25)</a>                        
                        </li>
                        <li data-id="4847">
                            <a href="/video/4847"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>3-2 类自动载入(04:36)</a>                        
                        </li>
                        <li data-id="4848">
                            <a href="/video/4848"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>3-3 开发一个PSR-0 的基础框...(12:00)</a>                        
                        </li>
                    </ul>
                    <ul>
                        <li class="sec-title">
                            <span>第4章 PHP面向对象</span>
                        </li>
                        <li data-id="4849">
                            <a href="/video/4849"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>4-1 SPL标准库简介(06:06)</a>                        
                        </li>
                        <li data-id="4850">
                            <a href="/video/4850"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>4-2 PHP链式操作的实现(03:25)</a>                        
                        </li>
                        <li data-id="4851">
                            <a href="/video/4851"><i class=""><em class="icon-full"></em></i><em class="icon-video"></em>4-3 PHP魔术方法的使用(09:36)</a>                        
                        </li>
                    </ul>
                </div>
                <div class="nano-pane" style="display: block;">
                    <div class="nano-slider" style="height: 64px; transform: translate(0px, 141.313px);">
                    </div>
                </div>
            </div>
        ';

        
        return $contents;
    }


    public function display_header($devvideo){
        global$CFG;
        $name = format_string($devvideo->get_instance()->name,true, $devvideo->get_course());
        $title = $this->page->course->shortname . ': ' . $name;

        $coursemoduleid = $devvideo->get_course_module()->id;       
        $context = context_module::instance($coursemoduleid);
        //加载css
        $this->page->requires->css('/mod/devvideo/devvideo.css');
        //加载js
        $this->page->requires->js('/mod/devvideo/ckplayer6.8/ckplayer/ckplayer.js', true);
        //设置本页面的url
        $this->page->set_url(
            '/mod/devvideo/view.php',
            array(
                'id' => $coursemoduleid,
            )
        );
        $this->page->set_pagelayout('standard');//选择输出的模板
        //开始输出header.
        $output='';
        //设置此页面的网址标题
        $this->page->set_title($title);
         $this->page->navbar->add($title);
        //设置本页面的标题
        $this->page->set_heading($this->page->course->fullname);
         //输出此页面的网址标题
        $output .= $this->output->heading($name, 3);
        $output .= $this->output->header();
        if (!empty($devvideo->get_instance()->intro)) {
            $output .= $this->output->box_start('generalbox boxaligncenter', 'intro');
            $output .= format_module_intro('videofile',
                                           $devvideo->get_instance(),
                                           $coursemoduleid);
            $output .= $this->output->box_end();
        }
        return $output;
    }




}