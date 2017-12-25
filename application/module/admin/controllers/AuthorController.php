<?php

class AuthorController extends Controller
{
    private $table = DB_TBAUTHOR;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('admin/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    // Index
    public function indexAction()
    {
        $this->_view->listItem = $this->_model->showAll($this->table);
        $this->_view->render($this->table . '/index');
    }

    // Add Ajax
//    public function addAjaxAction()
    public function addAction()
    {
        if (isset($this->_arrParam['form'])) {
            $validate = new Validate($this->_arrParam['form']);
            $queryName = "SELECT * FROM `" . $this->table . "` WHERE `name`='" . $this->_arrParam['form']['name'] . "'";
            if (!empty($_FILES['avatar']['name'])) {
                $this->_arrParam['form']['avatar'] = $_FILES['avatar'];
                $validate = new Validate($this->_arrParam['form']);
                $validate->addRule('avatar', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
            }
            $validate->addRule('name', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $queryName]);
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            $this->_view->infoItem = $this->_arrParam['form'];
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                if (isset($_FILES['avatar'])) {
                    $this->_arrParam['form']['avatar'] = $_FILES['avatar'];
                }
                $this->_model->insertAuthor($this->_arrParam['form']);
                $this->_view->success = Helper::success('Thêm thành công');
                if ($this->_arrParam['type'] == "close")
                    URL::redirect("admin", $this->table, "index");
                if ($this->_arrParam['type'] == "new")
                    $this->_view->infoItem = [];
            }
        }
        $this->_view->render($this->table . '/add');
    }

    // Edit Ajax
    public function editAction()
    {
        $this->_view->infoItem = $this->_model->select($this->table, $this->_arrParam['id'], 1);
        if (isset($this->_arrParam['form'])) {
            $form = array_diff_assoc($this->_arrParam['form'], $this->_view->infoItem);
            if (!empty($_FILES['avatar']['name'])) {
                $form['avatar'] = $_FILES['avatar'];
            }
            $validate = new Validate($form);
            foreach ($form as $key => $value) {
                switch ($key) {
                    case 'name':
                        $queryName = "SELECT * FROM `" . $this->table . "` WHERE `name`='" . $this->_arrParam['form']['name'] . "'";
                        $validate->addRule('name', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $queryName]);
                        break;
                    case 'avatar':
                        $validate->addRule('avatar', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
                        break;
                }
            }
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();

            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                if (!empty($_FILES['avatar']['name'])) {
                    $this->_arrParam['form']['avatar'] = $_FILES['avatar'];
                }
                $this->_arrParam['form']['avatarOld'] = $this->_view->infoItem['avatar'];
                $this->_arrParam['form']['name'] = $this->_view->infoItem['name'];
                $this->_model->updateAuthor($this->_arrParam['form'], $this->_arrParam['id']);
                $this->_view->success = Helper::success('Edit successful');
                $this->_view->infoItem = array_merge($this->_view->infoItem, $this->_arrParam['form']);
                $this->_view->infoItem['avatar'] =  $this->_view->infoItem['name'] . "." . pathinfo($this->_view->infoItem['avatar']['name'])['extension'];

            }
        }
        $this->_view->render($this->table . '/edit');
    }

    // Click change Status
    public function ajaxStatusAction()
    {
        echo json_encode($this->_model->chageStatus($this->_arrParam));
    }

    // Delete Ajax
    public function deleteAction()
    {
        if (isset($this->_arrParam['cid'])) {
            $this->_model->deleteItem($this->_arrParam['cid']);
        }
        URL::redirect('admin', $this->table, 'index');
    }

    // Change Status Ajax
    public function statusAction()
    {
        if (isset($this->_arrParam['cid']))
            $this->_model->chageStatus($this->_arrParam['cid'], $this->_arrParam['type'], "change-status");
        URL::redirect('admin', $this->table, 'index');
    }

}