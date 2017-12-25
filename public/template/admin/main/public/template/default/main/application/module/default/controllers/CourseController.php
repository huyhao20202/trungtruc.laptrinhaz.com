<?php


class CourseController extends Controller
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('default/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function indexAction()
    {
        if(session::get('idCourse')){
            session::set('idCourse',$this->_arrParam['id_course']);
            if(!session::get('preIdCourse')){
                $checkSession=session::get('idCourse');
                session::set('preIdCourse',$checkSession);
            }
            else{
                if (session::get('preIdCourse')!=$this->_arrParam['id_course']){
                    session::delete('nameMenu');
                }
                $checkSession=session::get('idCourse');
                session::set('preIdCourse',$checkSession);
            }

        }
        else{
            session::set('idCourse',$this->_arrParam['id_course']);
        }


        $this->_view->video = $this->_model->videoQuery($this->_arrParam['id_course']);
        $this->_view->listVideoRelativeQuery = $this->_model->videoRelativeQuery($this->_arrParam['id_course'], $this->_view->video[0]['name_category']);

        $this->_view->course = $this->_model->getImageCourse($this->_arrParam['id_course']);
        $this->_view->render('course/index');
    }

    public function setCookieViewAction()
    {
        if (isset($this->_arrParam['videoId'])) {
            if (!isset($_COOKIE['view'])) {
                $viewed = array();
                array_unshift($viewed, $this->_arrParam['videoId']);
                setcookie('view', serialize($viewed), time() + 3600 * 24 * 30);
            } else {
                $review = unserialize($_COOKIE['view']);
                if (!in_array($this->_arrParam['videoId'], $review)) {
                    array_unshift($review, $this->_arrParam['videoId']);
                    setcookie('view', serialize($review), time() + 3600 * 24 * 30);
                }
            }
        }

        if (isset($this->_arrParam['deleteId'])) {
            $delete = unserialize($_COOKIE['view']);
            for ($i = 0; $i < count($delete); $i++) {
                if ($delete[$i] == $this->_arrParam['deleteId']) {
                    unset($delete[$i]);
                }
            }
            setcookie('view', serialize($delete), time() + 3600 * 24 * 30);
        }


    }
    public function activeMenuAction(){


        if(isset($this->_arrParam['nameMenu'])){
            session::set('nameMenu',$this->_arrParam['nameMenu']);
        }


    }
}