<?php

class CourseController extends Controller
{
    private $table = DB_TBCOURSE;

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
        $this->_view->listCourse = $this->_model->showCourse();
        $this->_view->render($this->table . '/index');
    }

    // Add Ajax
    public function addAction()
    {
        if (isset($this->_arrParam['form'])) {
            if (strlen($this->_arrParam['form']['link']) > 40) {
                $this->_arrParam['form']['link'] = Helper::cutCharacter($this->_arrParam['form']['link'], 'list=', 5);
            }

            $validate = new Validate($this->_arrParam['form']);

            $queryName = "SELECT * FROM `" . $this->table . "` WHERE `name`='" . $this->_arrParam['form']['name'] . "'";
            $queryLink = "SELECT * FROM `" . $this->table . "` WHERE `link`='" . $this->_arrParam['form']['link'] . "'";
            if (isset($_FILES['image'])) {
                $this->_arrParam['form']['image'] = $_FILES['image'];
                $validate = new Validate($this->_arrParam['form']);
                $validate->addRule('image', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
            }
            $validate->addRule('name', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $queryName])
                ->addRule('link', 'string-notExistRecord', ['min' => 10, 'max' => 200, 'database' => $this->_model, 'query' => $queryLink])
                ->addRule('category_id', 'status', ['deny' => [0]])
                ->addRule('author_id', 'status', ['deny' => [0]]);
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            $this->_view->infoItem = $this->_arrParam['form'];
            if ($validate->isValid() == false || !isset($_FILES['image'])) {
                if ($validate->getError() != null) {
                    if (isset($_FILES['image']))
                        $this->_view->errors = $validate->showErrors();
                    else
                        $this->_view->errors = $validate->showErrors('<b>Image</b>: Chưa chọn hình ảnh');
                } else
                    $this->_view->errors = Helper::showErrors("<b>Image</b>: Chưa chọn hình ảnh");
            } else {
                if (isset($_FILES['imageThumbnail']))
                    $this->_arrParam['form']['imageThumbnail'] = $_FILES['imageThumbnail'];
                $bl = $this->_model->insertCourse($this->_arrParam['form']);
                if ($bl == 0) {
                    $this->_view->errors = Helper::showErrors('Link không hợp lệ');
                    $query = "SELECT `id` FROM `" . $this->table . "` ORDER BY `id` DESC LIMIT 0,1";
                    $this->_model->delete($this->table, [$this->_model->execute($query, 1)[0]['id']]);
                } else {
                    $this->_view->success = Helper::success('Thêm thành công!');
                    if ($this->_arrParam['type'] == "close")
                        URL::redirect("admin", $this->table, "index");
                    elseif ($this->_arrParam['type'] == "new")
                        $this->_view->infoItem = [];
                }
            }
        }

        $this->_view->listCategory = $this->_model->showAll(DB_TBCATEGORY);
        $this->_view->listAuthor = $this->_model->showAll(DB_TBAUTHOR);
        $this->_view->listTag  =  $this->_model->getStringTag();

        $this->_view->render($this->table . '/add');
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
        URL::redirect('admin', $this->table . '', 'index');
    }

    // Edit Ajax
    public function editAction()
    {
        $this->_view->infoItem = $this->_model->select($this->table, $this->_arrParam['id'], 1);

        if (isset($this->_arrParam['form'])) {
            $form = array_diff_assoc($this->_arrParam['form'], $this->_view->infoItem);
            if (isset($form['link'])) {
                $form['link'] = Helper::cutCharacter($form['link'], 'list=', 5);
            }
            if (!empty($_FILES['image']['name'])) {
                $form['image'] = $_FILES['image'];
            }
            if (!empty($_FILES['imageThumbnail']['name'])) {
                $form['imageThumbnail'] = $_FILES['imageThumbnail'];
            }
            $validate = new Validate($form);
            foreach ($form as $key => $value) {
                switch ($key) {
                    case 'link':
                        $query = "SELECT * FROM `" . $this->table . "` WHERE `link`='" . $form['link'] . "'";
                        $validate->addRule('link', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $query]);
                        break;
                    case 'name':
                        $query = "SELECT * FROM `" . $this->table . "` WHERE `name`='" . $form['name'] . "'";
                        $validate->addRule('name', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $query]);
                        break;
                    case 'category_id':
                        $validate->addRule('category_id', 'status', ['deny' => [0]]);
                    case 'author_id':
                        $validate->addRule('author_id', 'status', ['deny' => [0]]);
                        break;
                    case 'image':
                        $validate->addRule('image', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
                        break;
                    case 'imageThumbnail':
                        $validate->addRule('imageThumbnail', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
                        break;
                }
            }
            $validate->run();
            $form = $validate->getResult();
            unset($form['image']);
            unset($form['imageThumbnail']);
            $this->_view->infoItem = array_merge($this->_view->infoItem, $form);
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $form['id'] = $this->_view->infoItem['id'];
                $form['image'] = $this->_view->infoItem['image'];
                $form['imageThumbnail'] = $this->_view->infoItem['imageThumbnail'];
                $form['name'] = $this->_view->infoItem['name'];
                $form['tag'] = $this->_view->infoItem['tag'];
                $this->_model->updateCourse($form, $_FILES);
                if (!empty($_FILES['image']['name']))
                    $this->_view->infoItem['image'] = $this->_view->infoItem['name'] . '.' . pathinfo($_FILES['image']['name'])['extension'];
                $this->_view->success = Helper::success('Edit Successfully');
            }
        }

        $this->_view->listCategory = $this->_model->showAll(DB_TBCATEGORY);
        $this->_view->listAuthor = $this->_model->showAll(DB_TBAUTHOR);
        $this->_view->listTag  =  $this->_model->getStringTag();
        $this->_view->render($this->table . '/editCourse');
    }

    // Change Status Ajax
    public function statusAction()
    {
        $this->_model->chageStatus($this->_arrParam['cid'], $this->_arrParam['type'], "change-status");
        URL::redirect('admin', $this->table . '', 'index');
    }

}
