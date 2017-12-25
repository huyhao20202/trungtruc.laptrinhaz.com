<?php

class VideoModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function showVideo($course_id)
    {
        $query[] = "SELECT v.id, v.link, v.title,v.status,v.ordering , v.thumbnails, c.name as courseName";
        $query[] = "FROM `video` v LEFT JOIN `course` c ON c.id = v.course_id";
        $query[] = "WHERE v.course_id=$course_id";
        $query[] = "ORDER BY v.title";
        return $this->execute(implode(" ", $query), 1);
    }

    public function chageStatus($param, $type = 1, $task = '')
    {
        if ($task == "change-status") {
            foreach ($param as $val) {
                $query = "UPDATE `" . DB_TBVIDEO . "` SET `status` = '$type' WHERE `id` = '" . $val . "'";
                $this->execute($query);
            }
        } else {
            $status = ($param['status'] == 0) ? 1 : 0;
            $id = $param['id'];
            $query = "UPDATE `" . DB_TBVIDEO . "` SET `status` = '$status' WHERE `id` = '" . $id . "'";
            $this->execute($query);
            $result = array(
                'id' => $id,
                'status' => $status,
                'link' => URL::createLink('admin', 'course', 'ajaxStatus', array('id' => $id, 'status' => $status))
            );
            return $result;
        }
    }

    public function updateVideo($arrParam, $arrID)
    {
        $arrParam['modified'] = date('Y-m-d');
        $arrParam['modified_by'] = Session::get("user")['info']['username'];
        $this->update(DB_TBVIDEO, $arrParam, $arrID);
    }
}
