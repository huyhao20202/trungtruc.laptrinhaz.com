<?php

class UserController extends Controller
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('admin/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }


    public function profileAction()
    {
        if (isset($this->_arrParam['form'])) {
            $validate = new Validate($this->_arrParam['form']);
            $validate->addRule('fullname', 'string', array('max' => 100, 'min' => 5))
                ->addRule('email', 'email');
            if (trim($this->_arrParam['form']['password']) != "") {
                $validate->addRule('password', 'password');
            }
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            if ($this->_arrParam['form']['password'] == null)
                unset($this->_arrParam['form']['password']);
            else {
                $this->_arrParam['form']['password'] = md5($this->_arrParam['form']['password']);
            }
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $this->_model->update(DB_TBUSER, $this->_arrParam['form'], ['id' => Session::get("user")['info']['id']]);
                $info = $this->_arrParam['form'];
                $info['id'] = Session::get("user")['info']['id'];
                Session::set('user', ['login' => true, 'info' => $info, 'time' => time()]);
                $this->_view->success = Helper::success('Cập nhật thành công');
                URL::redirect('admin', 'user', 'profile');
            }
        }

        $this->_view->userInfo = $this->_model->show(DB_TBUSER, Session::get("user")['info']['id']);
        $this->_view->render('user/profile');
    }

}
