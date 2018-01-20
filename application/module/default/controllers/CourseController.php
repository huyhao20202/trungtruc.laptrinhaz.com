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
        echo $this->_arrParam['checkLoad'];
        if (Session::get('idCourse')) {
            Session::set('idCourse', $this->_arrParam['id_course']);
            if (!Session::get('preIdCourse')) {
                $checkSession = Session::get('idCourse');
                Session::set('preIdCourse', $checkSession);
            } else {
                if (Session::get('preIdCourse') != $this->_arrParam['id_course']) {
                    Session::delete('nameMenu');
                }
                $checkSession = Session::get('idCourse');
                Session::set('preIdCourse', $checkSession);
            }

        } else {
            Session::set('idCourse', $this->_arrParam['id_course']);
        }

        if (Session::get('user')) {
            $this->_view->favoriteVideo = $this->_model->videoFavorite('favoriteCourse', Session::get('user')['info']['id']);
        }
        $this->_view->video = $this->_model->videoQuery($this->_arrParam['id_course']);
        $this->_view->listCourseRelative = $this->_model->videoRelativeQuery($this->_arrParam['id_course'], $this->_view->video[0]['name_category']);
        $this->_view->course = $this->_model->getImageCourse($this->_arrParam['id_course']);

        $this->_view->render('course/index');
    }

// active video viewed
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

    public function activeMenuAction()
    {
        if (isset($this->_arrParam['nameMenu'])) {
            Session::set('nameMenu', $this->_arrParam['nameMenu']);
        }
    }

    //compute point
    public function pointAction()
    {

        if (session::get('user')) {
            $flag = 0;
            $idUser = session::get('user')['info']['id'];
            $dataUser = $this->_model->show(DB_TBUSER, $idUser);
            $query = "SELECT `id` FROM " . DB_TBVIDEO;
            $allVideo = $this->_model->execute($query, true);
            $point = trim(Helper::cutCharacter($this->_arrParam['idVideo'], '-', 1));
            foreach ($allVideo as $value) {
                if ($point == $value['id']) {
                    $flag = 1;
                }
            }
            if ($flag == 1) {
                if (empty($dataUser['point'])) {
                    $arrPoint = [];
                    $arrPoint[] = $point;
                    $strArrPoint = serialize($arrPoint);
                    $query = "UPDATE `user` SET `point`='" . $strArrPoint . "' WHERE id=$idUser";
                    $this->_model->execute($query);
                    echo "yes";

                } else {
                    $arrPoint = unserialize($dataUser['point']);
                    if (!in_array($point, $arrPoint)) {
                        $arrPoint[] = $point;
                        echo "yes";
                    }
                    $strArrPoint = serialize($arrPoint);
                    $query = "UPDATE `user` SET `point`='" . $strArrPoint . "' WHERE id=$idUser";
                    $this->_model->execute($query);
                }
            }else{
                echo "no";
            }

        }
    }

    public function favoriteCourseAction()
    {

        if (isset($this->_arrParam['idUser'])) {

            $query = "SELECT * FROM `favoriteCourse` WHERE `id_user`=" . $this->_arrParam['idUser'];
            $data = $this->_model->execute($query, true);
            $flag = 0;
            if (!empty($data)) {

                foreach ($data as $value) {
                    if ($this->_arrParam['idCourse'] == $value['id_course']) {
                        $this->_model->delete('favoriteCourse', ['id' => $value['id']]);
                        $flag = 1;
                    }
                }

            }
            if ($flag == 0) {

                $dataInsert['id_user'] = $this->_arrParam['idUser'];
                $dataInsert['name_course'] = $this->_arrParam['nameCourse'];
                $dataInsert['url_course'] = $this->_arrParam['linkCourse'];
                $dataInsert['id_course'] = $this->_arrParam['idCourse'];
                $this->_model->insert('favoriteCourse', $dataInsert, 'single');
            }

        }

    }
    public function studentAction(){
        $this->_view->video = $this->_model->videoQuery($this->_arrParam['course']);
        $queryDataUser = "SELECT `avatar`,`id`,`username`,`email`,`fullname`,`point` FROM `" . DB_TBUSER . "`";
        $data = $this->_model->execute($queryDataUser, true);
        $dataStudent = [];
        foreach ($data as $key => $value) {
            $flagLearn = 0;
            if (!empty($value['point'])) {
                $arrIdVideo = unserialize($value['point']);
                foreach ($arrIdVideo as $keyOne => $valueOne) {
                    foreach ($this->_view->video as $keyTwo => $valueTwo) {
                        if ($valueOne == $valueTwo['video_id']) {
                            $flagLearn = 1;
                        }

                    }
                }
            }
            if ($flagLearn == 1) {
                $dataStudent[$key]['avatar'] = $value['avatar'];
                $dataStudent[$key]['idUser'] = $value['id'];
                $dataStudent[$key]['username'] = $value['username'];
                $dataStudent[$key]['fullname'] = $value['fullname'];
                $dataStudent[$key]['email'] = $value['email'];
            }


        }
        $this->_view->dataStudent = $dataStudent;
        $this->_view->render('course/student',false);
    }

}