<?php

class AuthorModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertAuthor($arrParam)
    {
        if (isset($arrParam['avatar'])) {
            $nameImage = trim($arrParam['name']) . "." . pathinfo($arrParam['avatar']['name'])['extension'];
            echo $pathImageAdmin = TEMPLATE_PATH . "/admin/main/images/author/" . $nameImage;
            $pathImageDefault = TEMPLATE_PATH . "/default/main/images/author/" . $nameImage;
            move_uploaded_file($arrParam['avatar']['tmp_name'], $pathImageAdmin);
            copy($pathImageAdmin, $pathImageDefault);
            $arrParam['avatar'] = $nameImage;
        }
        $arrParam['created_by'] = Session::get("user")['info']['username'];
        $arrParam['created'] = date("Y-m-d", time());
        $this->insert(DB_TBAUTHOR, $arrParam);
    }

    public function updateAuthor($arrParam, $id)
    {
        if (!empty($arrParam['avatar']['name'])) {
            $nameImage = trim($arrParam['name']) . "." . pathinfo($arrParam['avatar']['name'])['extension'];
            $pathImageAdmin = TEMPLATE_PATH . "/admin/main/images/author/" . $nameImage;
            $pathImageDefault = TEMPLATE_PATH . "/default/main/images/author/" . $nameImage;
            if (file_exists(TEMPLATE_PATH . "/admin/main/images/author/" . $arrParam['avatarOld'])) {
                unlink(TEMPLATE_PATH . "/admin/main/images/author/" . $arrParam['avatarOld']);
                unlink(TEMPLATE_PATH . "/default/main/images/author/" . $arrParam['avatarOld']);
            }
            move_uploaded_file($arrParam['avatar']['tmp_name'], $pathImageAdmin);
            copy($pathImageAdmin, $pathImageDefault);
            $arrParam['avatar'] = $nameImage;
        }
        unset($arrParam['avatarOld']);
        $arrParam['modified_by'] = Session::get("user")['info']['username'];
        $arrParam['modified'] = date("Y-m-d", time());
        $this->update(DB_TBAUTHOR, $arrParam, ['id' => $id]);
    }

    public function chageStatus($param, $type = 1, $task = '')
    {
        $modified = date('Y-m-d', time());
        $modified_by = Session::get("user")['info']['username'];
        if ($task == "change-status") {
            foreach ($param as $val) {
                $query = "UPDATE `" . DB_TBAUTHOR . "` SET `status` = '$type',`modified`='$modified',`modified_by`='$modified_by' WHERE `id` = '" . $val . "'";
                $this->execute($query);
            }
        } else {
            $status = ($param['status'] == 0) ? 1 : 0;
            $id = $param['id'];
            $query = "UPDATE `" . DB_TBAUTHOR . "` SET `status` = '$status',`modified`='$modified',`modified_by`='$modified_by' WHERE `id` = '" . $id . "'";
            $this->execute($query);
            $result = array(
                'id' => $id,
                'status' => $status,
                'link' => URL::createLink('admin', DB_TBAUTHOR, 'ajaxStatus', array('id' => $id, 'status' => $status))
            );
            return $result;
        }
    }

    public function deleteItem($param)
    {
        foreach ($param as $val) {
            $item = $this->select(DB_TBAUTHOR, $val, 1);
            $nameImageAdmin = TEMPLATE_PATH . "/admin/main/images/author/" . $item['avatar'];
            $nameImageDefault = TEMPLATE_PATH . "/default/main/images/author/" . $item['avatar'];
            if (file_exists($nameImageAdmin)) {
                unlink($nameImageAdmin);
                unlink($nameImageDefault);
            }
            $query = "DELETE FROM `" . DB_TBAUTHOR . "` WHERE `id`='$val'";
            $this->execute($query);

        }
    }
}