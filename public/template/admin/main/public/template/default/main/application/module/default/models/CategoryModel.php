<?php

class CategoryModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCourse($id)
    {
        $query[] = "SELECT DISTINCT cs.image as `course_image`, a.avatar as `author_avatar` ,`cs`.`name`AS `name_course`,`cs`.`id`AS `id_course`,`a`.`name` AS `name_author`, a.id as `id_author`, ca.id as `id_category`, ca.name as `name_category`";
        $query[] = "FROM `course` AS `cs`";
        $query[] = "JOIN `author` AS `a` ON `a`.id =`cs`.`author_id`";
        $query[] = "JOIN `category` AS `ca` ON `ca`.id =`cs`.`category_id`";
        $query[] = "WHERE `cs`.`category_id`= $id";
        $query = implode(" ", $query);
        return $this->execute($query, 1);
    }

}