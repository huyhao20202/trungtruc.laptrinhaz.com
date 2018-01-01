<?php

class CategoryController extends Controller
{
    private $table = DB_TBCATEGORY;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('admin/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    
    }

    public function indexAction()
    {
        $this->_view->listItem = $this->_model->showAll($this->table);
        $this->_view->render($this->table . '/index');
    }

    // Add Ajax
    public function addAction()
    {
        if (isset($this->_arrParam['form'])) {
            $validate = new Validate($this->_arrParam['form']);
            $queryName = "SELECT * FROM `" . $this->table . "` WHERE `name`='" . $this->_arrParam['form']['name'] . "'";
            $validate->addRule('name', 'string-notExistRecord', ['min' => 2, 'max' => 200, 'database' => $this->_model, 'query' => $queryName]);
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            $this->_view->infoItem = $this->_arrParam['form'];
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $this->_model->insertCategory($this->_arrParam['form']);
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
            $validate = new Validate($form);
            foreach ($form as $key => $value) {
                switch ($key) {
                    case 'name':
                        $query = "SELECT * FROM `" . $this->table . "` WHERE `name`='" . $form['name'] . "'";
                        $validate->addRule('name', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $query]);
                        break;
                }
            }
            $validate->run();
            $form = $validate->getResult();
            $this->_view->infoItem = array_merge($this->_view->infoItem, $form);
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                if (!empty($form)) {
                    $id = $this->_view->infoItem['id'];
                    echo $id;
                    die;
                    $this->_model->updateCategory($form, ['id' => $id]);
                    $this->_view->success = Helper::success('Sửa thành công');

                } else {
                    $this->_view->success = Helper::success('Không thay đổi');
                }
            }
        }
        $this->_view->render($this->table . '/edit');
    }


    public function ajaxStatusAction()
    {
        echo json_encode($this->_model->chageStatus($this->_arrParam));
    }

    // Status Ajax
    public function statusAction()
    {
        $this->_model->chageStatus($this->_arrParam['cid'], $this->_arrParam['type'], "change-status");
        URL::redirect('admin', $this->table, 'index');
    }

    // Delet Ajax
    public function deleteAction()
    {
        if(!empty($this->_arrParam['cid'])) {
            $this->_model->delete($this->table, $this->_arrParam['cid']);
        }
        URL::redirect('admin', $this->table, 'index');
    }
}

?>

