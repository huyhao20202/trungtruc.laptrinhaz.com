<?php

class TagModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function chageStatus($param, $type = 1, $task = '')
    {
        if ($task == "change-status") {
            foreach ($param as $val) {
                $query = "UPDATE `" . DB_TBTAG . "` SET `status` = '$type' WHERE `id` = '" . $val . "'";
                $this->execute($query);
            }
        } else {
            $status = ($param['status'] == 0) ? 1 : 0;
            $id = $param['id'];
            $query = "UPDATE `" . DB_TBTAG . "` SET `status` = '$status' WHERE `id` = '" . $id . "'";
            $this->execute($query);
            $result = array(
                'id' => $id,
                'status' => $status,
                'link' => URL::createLink('admin', DB_TBTAG, 'ajaxStatus', array('id' => $id, 'status' => $status))
            );
            return $result;
        }
    }

    public function updateItem($arrParam, $arrID)
    {
        $arrParam['modified'] = date('Y-m-d');
        $arrParam['modified_by'] = Session::get("user")['info']['username'];
        $this->update(DB_TBTAG, $arrParam, $arrID);
    }

    public function insertItem($arrParam)
    {
        $arrParam['created'] = date('Y-m-d');
        $arrParam['created_by'] = Session::get("user")['info']['username'];
        $this->insert(DB_TBTAG, $arrParam);
    }


}