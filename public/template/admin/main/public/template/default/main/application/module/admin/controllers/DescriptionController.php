<?php

class DescriptionController extends Controller
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

    public function indexAction()
    {
        $this->_view->listItem = $this->_model->getItem();
        $this->_view->render('description/index');
    }

    // Edit Ajax
    public function editAction()
    {
        $this->_view->infoItem = $this->_model->select($this->table, $this->_arrParam['id'], 1);
        if (isset($this->_arrParam['form'])) {
            if (!empty($_FILES['imageThumbnail']['name'])) {
                $validate = new Validate(['imageThumbnail' => $_FILES['imageThumbnail']]);
                $validate->addRule('imageThumbnail', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
                $validate->run();
                if ($validate->isValid() == false) {
                    $this->_view->errors = $validate->showErrors();
                } else {
                    $id = $this->_arrParam['id'];
                    $data['imageThumbnail'] = $_FILES['imageThumbnail'];
                    $data['description'] = $this->_arrParam['form']['description'];
                    $data['name'] = $this->_view->infoItem['name'];
                    $data['imageThumbnailOld'] = $this->_view->infoItem['imageThumbnail'];
                    $this->_model->updateItem($data, ['id' => $id]);
                    $this->_view->success = Helper::success('Edit Successful');
                }
            }else{
                $this->_arrParam['form']['name'] =  $this->_view->infoItem['name'];
                $this->_model->updateItem($this->_arrParam['form'], ['id' => $this->_arrParam['id']]);
                $this->_view->success = Helper::success('Edit Successful');
            }
        }
        $this->_view->render('description/edit');
    }


    // Delet Ajax
    public function deleteAction()
    {
        $this->_model->delete($this->table, $this->_arrParam['cid']);
        URL::redirect('admin', $this->table, 'index');
    }
}

?>

