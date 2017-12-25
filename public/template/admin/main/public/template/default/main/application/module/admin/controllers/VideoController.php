<?php

class VideoController extends Controller
{
    private $table = DB_TBVIDEO;

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
        $course_id = isset($this->_arrParam['id']) ? (int)$this->_arrParam['id'] : 0;
        $this->_view->listItem = $this->_model->showVideo($course_id);
        $this->_view->render($this->table . '/index');
    }

    // Add Ajax
    public function addAction()
    {
        $this->_view->infoItem['course_id'] = $this->_arrParam['id'];
        if (isset($this->_arrParam['form'])) {
            if (strlen($this->_arrParam['form']['link']) > 40) {
                $this->_arrParam['form']['link'] = Helper::cutCharacter($this->_arrParam['form']['link'], 'v=', 2);
            }
            $validate = new Validate($this->_arrParam['form']);
            $queryName = "SELECT * FROM `" . $this->table . "` WHERE `title`='" . $this->_arrParam['form']['title'] . "'";
            $queryLink = "SELECT * FROM `" . $this->table . "` WHERE `link`='" . $this->_arrParam['form']['link'] . "'";

            $validate->addRule('title', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $queryName])
                ->addRule('link', 'string-notExistRecord', ['min' => 10, 'max' => 200, 'database' => $this->_model, 'query' => $queryLink])
                ->addRule('course_id', 'status', ['deny' => [0]]);
            $validate->run();
            $this->_arrParam['form'] = $validate->getResult();
            $this->_view->infoItem = $this->_arrParam['form'];
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $this->_model->insert($this->table, $this->_arrParam['form']);
                $this->_view->success = Helper::success('Add Successful');
                if ($this->_arrParam['type'] == "close")
                    URL::redirect("admin", $this->table, "index", ['id' => $this->_arrParam['id']]);
                if ($this->_arrParam['type'] == "new")
                    $this->_view->infoItem = [];
            }
        }
        $this->_view->listCourse = $this->_model->showAll(DB_TBCOURSE);
        $this->_view->render($this->table . '/add');
    }

    // Edit Ajax
    public function editAction()
    {
        $this->_view->infoItem = $this->_model->select($this->table, $this->_arrParam['id'], 1);
        if (isset($this->_arrParam['form'])) {
            $form = array_diff_assoc($this->_arrParam['form'], $this->_view->infoItem);
            if (isset($form['link']) && strlen($form['link']) > 40) {
                $form['link'] = Helper::cutCharacter($form['link'], 'list=', 5);
            }
            $validate = new Validate($form);
            foreach ($form as $key => $value) {
                switch ($key) {
                    case 'title':
                        $query = "SELECT * FROM `" . $this->table . "` WHERE `link`='" . $form['link'] . "'";
                        $validate->addRule('link', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $query]);
                        break;
                    case 'course_id':
                        $validate->addRule('course_id', 'status', ['deny' => [0]]);
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
                    $this->_model->updateVideo($form, ['id' => $id]);
                    $this->_view->success = Helper::success('Edit Successful');

                } else {
                    $this->_view->success = Helper::success('Nothing changes');
                }
            }
        }
        $this->_view->listCourse = $this->_model->showAll(DB_TBCOURSE);
        $this->_view->render($this->table . '/editVideo');
    }


    public function ajaxStatusAction()
    {
        echo json_encode($this->_model->chageStatus($this->_arrParam));
    }

    // Status Ajax
    public function statusAction()
    {
        $this->_model->chageStatus($this->_arrParam['cid'], $this->_arrParam['type'], "change-status");
        URL::redirect('admin', 'video', 'index', ['id' => $this->_arrParam['id']]);
    }

    // Delet Ajax
    public function deleteAction()
    {
        if(!empty($this->_arrParam['cid'])) {
            $this->_model->delete($this->table, $this->_arrParam['cid']);
        }
        URL::redirect('admin', 'video', 'index', ['id' => $this->_arrParam['id']]);
    }


}
