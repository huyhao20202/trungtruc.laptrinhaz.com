<?php


class PointController extends Controller
{

    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('admin/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }

    public function indexAction(){
        $query="SELECT * FROM `user`";
        $queryHistory="SELECT * FROM `historyPoint` WHERE `status`= 0";
        $dataOne=$this->_model->execute($query,true);
        $dataTwo=$this->_model->execute($queryHistory,true);
        foreach ($dataOne as $key => $value){
            foreach ($dataTwo as $keyOne => $valueOne){
                if($value['id']==$valueOne['id_user']){
                    $dataOne[$key]['notice']=1;
                }else if(isset($dataOne[$key]['notice'])){
                    unset($dataOne[$key]['notice']);
                }
            }

        }
        $this->_view->dataUser=$dataOne;
        $this->_view->render('point/index');
    }
    //change current point
    public function changePointAction(){
        $query="SELECT `current_money` FROM `currentMoney` ORDER BY `id` DESC ";
        $this->_view->infoItemEdit=$this->_model->execute($query,true);
        if(isset($this->_arrParam['form'])){
            $validate=new Validate($this->_arrParam['form']);
            $validate->addRule('current_money','int',['min'=>0,'max'=>10000]);
            $validate->run();
            $this->_arrParam['form']=$validate->getResult();
            if($validate->isValid()==false){
                $this->_view->errors=$validate->showErrors();
            }else{
                $data['current_money']=$this->_arrParam['form']['current_money'];
                $data['created_at']=date('Y/m/d',time());
                $data['created_by']=Session::get("user")['info']['username'];
                $this->_view->success=Helper::success('Thay đổi thành công!');
                $this->_model->insert('currentMoney',$data,'single');
                $this->_view->infoItemEdit=$this->_model->execute($query,true);
                if($this->_arrParam['type']=='close'){
                    URL::redirect('admin','point','index');
                }
            }
        }
        $this->_view->render('point/edit');
    }

// history convert point of user
    public function historyAction(){
        if (isset($this->_arrParam['idUser'])){
            $query="SELECT `hp`.`id`, `hp`.`id_user`, `hp`.`point_convert`, `hp`.`current_point`, `hp`.`money`, `hp`.`date_convert`, `hp`.`time`, `hp`.`status`,`u`.`email` 
                    FROM `historyPoint` AS `hp` INNER JOIN `user` AS `u` ON `hp`.id_user=`u`.`id`
                    WHERE `hp`.`id_user`=".$this->_arrParam['idUser'];
            $this->_view->data=$this->_model->execute($query,true);

        }

        $this->_view->render('point/history');
    }
    //status convert point of user
    public function statusConvertAction(){
        if($this->_arrParam['id']){
            //compute point after convert point
            $data=$this->_model->show('historyPoint',$this->_arrParam['id']);
            $result=$data['current_point'] - $data['point_convert'];
            $this->_model->update('historyPoint',["status"=>1],["id"=>$this->_arrParam['id']]);
            $this->_model->update('user',["all_point"=>$result],["id"=>$data['id_user']]);
            echo "Completed";
        }
    }


}