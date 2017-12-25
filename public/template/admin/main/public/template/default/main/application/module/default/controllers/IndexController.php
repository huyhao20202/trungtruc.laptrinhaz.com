<?php

class IndexController extends Controller
{
    private $table = "index";

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
        $this->_view->category = $this->_model->homeQuery();

        $this->_view->listFindCourse = $this->_model->getIDNameCategory();
        $this->_view->statistics = $this->_model->getStatistics();

        $this->_view->render('index/index');
    }

    public function findAction()
    {
        $this->_view->resultFind['list'] = $this->_model->getResultFind($this->_arrParam['form']);
        $this->_view->resultFind['search'] = $this->_arrParam['form']['search'];
        if ($this->_arrParam['form']['find'] == 0) {
            $this->_view->resultFind['category'] = "All Category";
        } else {
            $this->_view->resultFind['category'] = $this->_model->select(DB_TBCATEGORY, $this->_arrParam['form']['find'], 1)['name'];
        }

        $this->_view->render('find/index');
    }

    public function findTagAction()
    {
        $this->_view->resultFind['list'] = $this->_model->getResultFindTag($this->_arrParam['tag']);
        $this->_view->resultFind['search'] = $this->_arrParam['tag'];
        $this->_view->render('find/index');
    }

    public function findAuthorAction()
    {

        $this->_view->resultFind['list'] = $this->_model->getResultFindAuthor($this->_arrParam['author_id']);
        $this->_view->resultFind['search'] = $this->_model->select(DB_TBAUTHOR, $this->_arrParam['author_id'], 1)['name'];
        $this->_view->render('find/index');
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
                $this->_view->errors = "Invalid username or password.";
            } else {
                if (isset($this->_arrParam['form']['check']))
                    Session::set('user', ['login' => true, 'info' => $this->_model->execute($queryUserName, true)[0], 'time' => time() + 24 * 60 * 60]);
                else
                    Session::set('user', ['login' => true, 'info' => $this->_model->execute($queryUserName, true)[0], 'time' => time()]);
                URL::redirect('admin', DB_TBUSER, 'profile');
            }
        }
        $this->_view->render($this->table . "/login");
    }


    public function registerAction()
    {
        $this->_view->render($this->table . "/register");
    }
}