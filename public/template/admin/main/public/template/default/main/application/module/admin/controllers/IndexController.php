<?php

class IndexController extends Controller
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('admin/main');
        $this->_templateObj->setFileTemplate('login.php');
        $this->_templateObj->setFileConfig('login.ini');
        $this->_templateObj->load();
    }

    public function loginAction()
    {
        $userInfo = Session::get('user');
        if ($userInfo['login'] == true && $userInfo['time'] + TIME_LOGIN >= time()) {
            URL::redirect('admin', 'user', 'profile');
        }
        if (isset($this->_arrParam['form'])) {
            $validate = new Validate($this->_arrParam['form']);
            $queryUserName = "SELECT id,username,fullname,email FROM `user` WHERE username = '" . $this->_arrParam['form']['email'] . "' AND password='" . md5($this->_arrParam['form']['password']) . "'";
            $validate->addRule('email', 'existRecord', array('database' => $this->_model, 'query' => $queryUserName, 'min' => 3, 'max' => 25))
                ->addRule('password', 'password');
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();

            } else {
                Session::set('user', ['login' => true, 'info' => $this->_model->execute($queryUserName, true)[0], 'time' => time()]);
                URL::redirect('admin', DB_TBUSER, 'profile');
            }
        }
        $this->_view->render('index/login');
    }


    public function logoutAction()
    {
        Session::delete('user');
        URL::redirect('admin', 'index', 'login', null, "dang-nhap.html");
    }


}
