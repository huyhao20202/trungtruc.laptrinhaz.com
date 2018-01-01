<?php
class SlideModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insertSlide($data){
        $customData=[];
        foreach ($data as $key => $value){
            $customData[$key]=$value;
        }
        $customData['picture']=trim($data['picture']['name']);
        $picture=$data['picture'];
        $customData['title'] = trim($data['title']);
        $customData['content']=trim($data['content']);
        $customData['created'] = date("Y-m-d H:i:s");
        $customData['created_by'] = Session::get("user")['info']['username'];
        $this->insert(DB_TBSLIDE,$customData);
        $link=TEMPLATE_PATH."/default/main/images/homeslider/".$picture['name'];
        move_uploaded_file($picture['tmp_name'],$link);
    }
    public function changeStatus($param, $type = 1, $task = '')
    {
        $modified = date('Y-m-d', time());
        $modified_by = Session::get("user")['info']['username'];

        if ($task == "change-status") {
            foreach ($param as $val) {
                $query = "UPDATE `" . DB_TBSLIDE . "` SET `status` = '$type',`modified`='$modified',`modified_by`='$modified_by' WHERE `id` = '" . $val . "'";
                $this->execute($query);
            }
        } else {
            $status = ($param['status'] == 0) ? 1 : 0;
            $id = $param['id'];
            $query = "UPDATE `" . DB_TBSLIDE . "` SET `status` = '$status',`modified`='$modified',`modified_by`='$modified_by' WHERE `id` = '" . $id . "'";
            $this->execute($query);
            $result = array(
                'id' => $id,
                'status' => $status,
                'link' => URL::createLink('admin', DB_TBSLIDE, 'ajaxStatus', array('id' => $id, 'status' => $status))
            );
            return $result;
        }
    }
    public function updateSlide($dataUpdate,$where,$dataOld){

        $oldNamePicture=$dataOld['picture'];
        $customData=[];
        foreach ($dataUpdate as $key => $value){
            $customData[$key]=$value;
        }
        $picture=$dataUpdate['picture'];
        $customData['picture']=trim($dataUpdate['picture']['name']);
        $customData['modified'] = date('Y-m-d');
        $customData['modified_by'] = Session::get("user")['info']['username'];
        $this->update(DB_TBSLIDE, $customData, $where);
        $linkPictureOld=TEMPLATE_PATH."/default/main/images/homeslider/".$oldNamePicture;
        $link=TEMPLATE_PATH."/default/main/images/homeslider/".$picture['name'];
        if (file_exists($linkPictureOld)){
            unlink($linkPictureOld);
        }
        move_uploaded_file($picture['tmp_name'],$link);
    }




}
