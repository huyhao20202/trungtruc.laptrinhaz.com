<?php

class SlideController extends Controller
{
    private $table = DB_TBSLIDE;

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
        $query = "SELECT * FROM `" . $this->table . "`";
        $this->_view->listItem = $this->_model->execute($query, true);
        $this->_view->render($this->table . '/index');
    }

    public function addAction()
    {
        if (isset($this->_arrParam['form'])) {

            if (!empty($_FILES['picture']['name'])) {
                $queryTile = "SELECT * FROM `" . DB_TBSLIDE . "` WHERE `title`= '" . $this->_arrParam['form']['title'] . "'";
                $queryContent = "SELECT * FROM `" . DB_TBSLIDE . "` WHERE `content`= '" . $this->_arrParam['form']['content'] . "'";
                $this->_arrParam['form']['picture'] = $_FILES['picture'];
                settype($this->_arrParam['form']['status'],"integer");
                $validate = new Validate($this->_arrParam['form']);

                $validate->addRule('picture', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false)
                    ->addRule('title', 'string-notExistRecord', ['min' => 1, 'max' => 200, 'database' => $this->_model, 'query' => $queryTile])
                    ->addRule('content', 'string-notExistRecord', ['min' => 1, 'max' => 1000, 'database' => $this->_model, 'query' => $queryContent])
                    ->addRule('ordering', 'int', ['min' => 1, 'max' => 20]);

                $validate->run();
                if($this->_arrParam['form']['status'] != 1 && $this->_arrParam['form']['status'] != 0 ){
                     $validate->setError('status','không hợp lệ!');
                 }
                $this->_arrParam['form'] = $validate->getResult();
                $this->_view->infoItem = $this->_arrParam['form'];
                if ($validate->isValid() == false) {

                    $this->_view->errors = $validate->showErrors();
                } else {
                    $this->_model->insertSlide($this->_arrParam['form']);
                    $this->_view->success = Helper::success('Thêm thành công!');
                    if ($this->_arrParam['type'] == 'close') {
                        URL::redirect('admin', 'slide', 'index');
                    } else if ($this->_arrParam['type'] == 'new') {
                        $this->_view->infoItem = [];
                    }
                }
            } else {
                $this->_view->infoItem = $this->_arrParam['form'];
                $this->_view->errors = Helper::showErrors('Chưa chọn slide!');
            }

        }

        $this->_view->render($this->table . '/add');
    }

    //edit slide
    public function editAction()
    {
        $this->_view->infoItemEdit = $this->_model->select($this->table, $this->_arrParam['id'], true);

        if (isset($this->_arrParam['form'])) {
            $validate = new Validate($this->_arrParam['form']);
            if (!empty($_FILES['picture']['name'])) {
                $this->_arrParam['form']['picture'] = $_FILES['picture'];
                $validate = new Validate($this->_arrParam['form']);
                $validate->addRule('picture', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
            }
            $validate->addRule('title', 'string', ['min' => 1, 'max' => 200])
                ->addRule('content', 'string', ['min' => 1, 'max' => 1000])
                ->addRule('ordering', 'int', ['min' => 1, 'max' => '20']);
            $validate->run();
            if($this->_arrParam['form']['status'] != 1 && $this->_arrParam['form']['status'] != 0 ){
                $validate->setError('status','không hợp lệ!');
            }
            $this->_arrParam['form'] = $validate->getResult();
            $this->_view->infoItem = $this->_arrParam['form'];
            if ($validate->isValid() == false) {
                $this->_view->errors = $validate->showErrors();
            } else {
                $dataOld=$this->_view->infoItemEdit;
                $id = $dataOld['id'];
                if (!empty($_FILES['picture']['name'])){
                    $this->_model->updateSlide($this->_arrParam['form'], ['id' => $id], $dataOld);
                }else{
                    $this->_arrParam['form']['picture']['name']=$dataOld['picture'];
                    $this->_model->updateSlide($this->_arrParam['form'], ['id' => $id]);
                }

                $this->_view->success = Helper::success('Cập nhật thành công!');
                if ($this->_arrParam['type'] == 'close') {
                    URL::redirect('admin', 'slide', 'index');
                } elseif ($this->_arrParam['type'] == 'new') {
                    $this->_view->infoItem = [];
                }
            }
        }

        $this->_view->render($this->table . '/edit');
    }

    //ajax status for slide
    public function ajaxStatusAction()
    {
        echo json_encode($this->_model->changeStatus($this->_arrParam));
    }

    //check box status
    public function statusAction()
    {

        $this->_model->changeStatus($this->_arrParam['cid'], $this->_arrParam['type'], "change-status");
        URL::redirect('admin', $this->table, 'index');
    }

    //delete slide
    public function deleteAction()
    {
        $arrCid=$this->_arrParam['cid'];
        if (!empty($arrCid)) {
            foreach ($arrCid as $value){
                $query="SELECT `picture` FROM `slide` WHERE `id`=".$value;
                $picture=TEMPLATE_PATH."/default/main/images/homeslider/".$this->_model->execute($query,true)[0]['picture'];
                if(file_exists($picture)){
                    unlink($picture);
                }
            }
            $this->_model->delete($this->table, $this->_arrParam['cid']);
        }
        URL::redirect('admin', $this->table, 'index');
    }


}