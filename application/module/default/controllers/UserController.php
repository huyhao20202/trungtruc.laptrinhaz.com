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
                if (!empty($form)) {
                    $this->_model->update(DB_TBUSER, $form, ['id' => Session::get('user')['info']['id']]);
                }
                $this->_view->success = Helper::success('Cập nhật tài khoản thành công');

            }
        }
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
        $this->_view->infoUser = $this->_model->select(DB_TBUSER, Session::get('user')['info']['id'], 1);
        $this->_view->render($this->table . "/profile");
    }

//check password in section profile
    public function checkPasswordAction()
    {

        if (isset($this->_arrParam['pass']) && isset($this->_arrParam['email']) ) {
            $pass = md5($this->_arrParam['pass']);
            $email = $this->_arrParam['email'];
            if ($this->_model->checkPassExist($pass,$email) == false) {
                echo "no";
            } else {
                echo "yes";
            }
        }
    }

// send mail
    public function becomeMemberAction()
    {

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

    public function activeRegisterAction()
    {
        $this->_model->userActive($this->_arrParam['userId'], $this->_arrParam['active_code']);
        $this->_view->render($this->table . "/becomeMember");
    }

    public function logoutAction()
    {
        Session::delete('user');
        URL::redirect('default', 'index', 'index', null, "trang-chu.html");
    }

    //forget password
    public function forgetAction()
    {

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
    public function changePassAction()
    {

        if (isset($this->_arrParam['form'])) {
            $newPass = md5($this->_arrParam['form']['newPass']);
            $this->_model->updatePass($this->_arrParam['userId'], $newPass);
            URL::redirect('default', 'index', 'login', null, 'dang-nhap.html');
        }
        $this->_view->render($this->table . '/changePassword');
    }

}
