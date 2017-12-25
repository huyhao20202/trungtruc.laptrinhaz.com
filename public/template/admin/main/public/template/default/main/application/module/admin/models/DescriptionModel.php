<?php

class DescriptionModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getItem()
    {
        $query[] = "SELECT name, description, imageThumbnail, id";
        $query[] = "FROM `" . DB_TBCOURSE . "`";
        $query[] = "ORDER BY `name`";
        $query = implode(" ", $query);
        return $this->execute($query, 1);
    }

    public function updateItem($arrParam, $arrID)
    {
        $arrParam['description'] = trim($arrParam['description']);
        $arrParam['modified'] = date('Y-m-d');
        $arrParam['modified_by'] = Session::get("user")['info']['username'];
        if (isset($arrParam['imageThumbnail'])) {
            $arrParam['imageThumbnailOld'] = $arrParam['imageThumbnailOld'] == null ? "1.png" : $arrParam['imageThumbnailOld'];
            $imageThumbnailOld = URL::filterURL($arrParam['name'] . "." . pathinfo($arrParam['imageThumbnail']['name'])['extension']);
            $pathThumbnailOld = TEMPLATE_PATH . "/default/main/images/thumbnail/" . $arrParam['imageThumbnailOld'];
            $pathThumbnailNew = TEMPLATE_PATH . "/default/main/images/thumbnail/" . $imageThumbnailOld;
            if (file_exists($pathThumbnailOld)) {
                unlink($pathThumbnailOld);
            }
            move_uploaded_file($arrParam['imageThumbnail']['tmp_name'], $pathThumbnailNew);
            $arrParam['imageThumbnail'] = $imageThumbnailOld;
            unset($arrParam['imageThumbnailOld']);
        }

        $this->update(DB_TBCOURSE, $arrParam, $arrID);
    }

    public function insertItem($arrParam)
    {
        $arrParam['description'] = trim($arrParam['description']);
        $arrParam['created'] = date('Y-m-d');
        $arrParam['created_by'] = Session::get("user")['info']['username'];
        $this->insert(DB_TBDESCRIPTION, $arrParam);
    }


}