<?php

class UserController extends Controller
{
    private $table = DB_TBUSER;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('default/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function profileAction()
    {

//change info
        if (isset($this->_arrParam['form'])) {
            if (Session::get('token') != $this->_arrParam['form']['token']) {
                Session::set('token', $this->_arrParam['form']['token']);
                $form = [];
                unset($this->_arrParam['form']['token']);
                foreach ($this->_arrParam['form'] as $key => $value) {
                    if (!empty($value)) {
                        $form[$key] = $value;
                    }
                }
                if ($form['sex'] == "male" || $form['sex'] == "female") {
                    $form['avatar'] = $_FILES['avatar-user'];
                    if (!empty($form['avatar']['name'])) {

                        $nameAvatar = URL::filterURL($form['avatar']['name']);
                        $stringRandom = URL::generateRandomString(10);
                        $form['avatar']['name'] = $stringRandom . $nameAvatar;
                        $validate = new Validate($form);
                        $validate->addRule('avatar', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
                        $validate->run();
                        if ($validate->isValid() == false) {
                            $this->_view->error = $validate->showErrors();

                        } else {
                            $removeAvatar = $this->_model->select(DB_TBUSER, Session::get('user')['info']['id'], 1);
                            $removeLink = TEMPLATE_PATH . "/default/main/images/avatar/" . $removeAvatar['avatar'];
                            $form['avatar'] = $form['avatar']['name'];
                            $form['modified'] = date("Y-m-d", time());
                            $form['modified_by'] = session::get('user')['info']['id'];
                            $this->_model->update(DB_TBUSER, $form, ['id' => Session::get('user')['info']['id']]);
                            $folderUpload = TEMPLATE_PATH . "/default/main/images/avatar/" . $form['avatar'];
                            if (file_exists($removeLink)) {
                                unlink($removeLink);
                            }
                            move_uploaded_file($_FILES['avatar-user']['tmp_name'], $folderUpload);

                            $this->_view->success = Helper::success('Cập nhật tài khoản thành công');
                        }
                    } else {
                        $this->_arrParam['form']['modified'] = date("Y-m-d", time());
                        $this->_arrParam['form']['modified_by'] = session::get('user')['info']['id'];
                        $this->_model->update(DB_TBUSER, $this->_arrParam['form'], ['id' => Session::get('user')['info']['id']]);

                        $this->_view->success = Helper::success('Cập nhật tài khoản thành công');
                    }
                } else {
                    $this->_view->error = Helper::showErrors('Giá trị sex không hợp lệ!');
                }
            }
        }
//        change Password
        if (isset($this->_arrParam['pass'])) {
            if (Session::get('token') != $this->_arrParam['token']) {
                Session::set('token', $this->_arrParam['token']);
                $id = Session::get('user')['info']['id'];
                $query = "SELECT * FROM `" . DB_TBUSER . "` WHERE `password` = '" . md5($this->_arrParam['pass']['current']) . "' AND id = $id";
                if (!empty($this->_model->execute($query, 1))) {
                    $this->_model->update(DB_TBUSER, ['password' => md5($this->_arrParam['pass']['new'])], ['id' => $id]);
                    $this->_view->success = Helper::success('Cập nhật tài khoản thành công');
                } else {
                    $this->_view->error = Helper::showErrors('Mật khẩu không chính xác');
                }
            }
        }
        // statistical vs point
        $idUser = session::get('user')['info']['id'];
        $dataUser = $this->_model->show('user', $idUser);
        $arrPoint = unserialize($dataUser['point']);
        $dataVideo = [];
        $data = [];
        $queryVideo = $queryVideo = "SELECT `cs`.`id` AS `id_course`,`c`.`id` AS `id_category`,`cs`.`name` AS `name_course`,`c`.`name` AS `name_category`
                                                                                                          FROM `course`AS `cs` INNER JOIN `category` AS `c`
                                                                                                            ON `cs`.`category_id`=`c`.`id` ";
        $listVideo = $this->_model->execute($queryVideo, true);

        $queryAllVideo="SELECT COUNT(`id`) AS `allVideo`FROM `" . DB_TBVIDEO . "`";
        $allVideo=$this->_model->execute($queryAllVideo, true);
        foreach ($listVideo as $key => $value1) {
            $queryTotalVideo = "SELECT COUNT(`id`) AS `totalVideo`,`course_id` FROM `" . DB_TBVIDEO . "`WHERE `course_id`=" . $value1['id_course'];
            $listVideo[$key]['totalVideo'] = $this->_model->execute($queryTotalVideo, true)[0]['totalVideo'];
        }

        foreach ($arrPoint as $value) {
            $dataVideo[] = $this->_model->show('video', $value);
        }

        foreach ($listVideo as $key => $value) {
            $number = 0;
            foreach ($dataVideo as $valueId) {
                if ($value['id_course'] == $valueId['course_id']) {
                    $data[$value['id_course']]['name_course'] = $value['name_course'];
                    $data[$value['id_course']]['name_category'] = $value['name_category'];
                    $data[$value['id_course']]['title_video'][$valueId['id']] = $valueId['title'];
                    $data[$value['id_course']]['numVideo'] = ++$number;
                    $data[$value['id_course']]['totalVideo'] = $value['totalVideo'];
                    $data[$value['id_course']]['id_course'] = $valueId['course_id'];
                    $data[$value['id_course']]['id_category'] = $value['id_category'];
                }
            }
        }
        //start code compute point
        if(!empty($arrPoint) && count($arrPoint)< $allVideo[0]['allVideo'] ){
            $this->_view->point= count($arrPoint);
        }
        elseif (count($arrPoint)> $allVideo[0]['allVideo']){
            $this->_view->point= $allVideo[0]['allVideo'];
        }
        else{
            $this->_view->point= 0;
        }
        //end code compute point
        $this->_view->videoViewed = $data;
        $this->_view->infoUser = $this->_model->select(DB_TBUSER, Session::get('user')['info']['id'], 1);
        $this->_view->render($this->table . "/profile");
    }
//end profileAction-------

//check password in section profile ajax
    public
    function checkPasswordAction()
    {

        if (isset($this->_arrParam['pass']) && isset($this->_arrParam['email'])) {
            $pass = md5($this->_arrParam['pass']);
            $email = $this->_arrParam['email'];
            if ($this->_model->checkPassExist($pass, $email) == false) {
                echo "no";
            } else {
                echo "yes";
            }
        }
    }

// send mail
    public
    function becomeMemberAction()
    {
        if (session::get('user')) {
            session::delete('user');
        }

        if (isset($this->_arrParam['email']) && session::get('email') != $this->_arrParam['email']) {
            session::set('email', $this->_arrParam['email']);
            $userId = $this->_model->userActiveMail($this->_arrParam['active_code'], null)[0]['id'];//get user id
            $this->_view->toMail = $this->_arrParam['email'];
            require_once MODULE_PATH . '/default/views/email/email.php';
            mailer($this->_arrParam['email'], $userId, $this->_arrParam['active_code']);
            $this->_view->render($this->table . "/becomeMember");
        } else {
            $this->_view->render($this->table . "/becomeMember");
        }
    }

    public
    function activeRegisterAction()
    {
        $this->_model->userActive($this->_arrParam['userId'], $this->_arrParam['active_code']);
        $this->_view->render($this->table . "/becomeMember");
    }

    public
    function logoutAction()
    {
        Session::delete('user');
        URL::redirect('default', 'index', 'index', null, "trang-chu.html");
    }

//forget password
    public
    function forgetAction()
    {
        if (session::get('user')) {
            session::delete('user');
        }

        if (isset($this->_arrParam['form'])) {

            if ($this->_model->checkEmailExist($this->_arrParam['form']['forget'])) {

                $userId = $this->_model->userActiveMail(null, $this->_arrParam['form']['forget'])[0]['id'];
                require_once MODULE_PATH . '/default/views/email/email.php';
                mailForgetPass($this->_arrParam['form']['forget'], $userId);
                $this->_view->emailExist = 'Mail đã được gửi.Vui lòng vào mail để xác nhận! ';
            } else {
                $this->_view->emailExist = 'Email không tồn tại.thử lại?';
            }

        }
        $this->_view->render($this->table . '/forget');
    }

//change Password for function forgetPassword
    public
    function changePassAction()
    {
        if (session::get('user')) {
            session::delete('user');
        }
        if (isset($this->_arrParam['form'])) {
            $newPass = md5($this->_arrParam['form']['newPass']);
            $this->_model->updatePass($this->_arrParam['userId'], $newPass);
            URL::redirect('default', 'index', 'login', null, 'dang-nhap.html');
        }
        $this->_view->render($this->table . '/changePassword');
    }

}
