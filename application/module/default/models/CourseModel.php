<?php

class CourseModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function videoQuery($where)
    {
        $queryVideo = array();
        $queryVideo[] = "SELECT DISTINCT a.id as `author_id`,`cs`.`tag`,cs.id as `id_course`,cs.image as `course_image`,a.avatar as `author_avatar`, `c`.`name`AS `name_category`,`cs`.`name` AS `name_course`,`v`.`id` AS `video_id`,`v`.`title`,`v`.`link`,`v`.`thumbnails`,`a`.`name` AS `name_author`";
        $queryVideo[] = "FROM `course` AS `cs` INNER JOIN `video`AS`v` ON `cs`.`id`=`v`.`course_id`";
        $queryVideo[] = "JOIN `category` AS `c`ON `c`.`id`=`cs`.`category_id`";
        $queryVideo[] = "JOIN `author`   AS  `a` ON`a`.`id`=`cs`.`author_id`";
        $queryVideo[] = "WHERE `cs`.`id`=" . $where;
        $queryVideo = implode(" ", $queryVideo);
        $video = $this->execute($queryVideo, true);
        return $video;

    }

    public function videoRelativeQuery($id_course, $name_category)
    {
        $query[] = "SELECT DISTINCT a.id as `author_id`,cs.image as `course_image`,a.avatar as `author_avatar`,`c`.`id`AS `category_id`,`cs`.`id` AS `course_id`,`cs`.`name` AS  `course_name`,`a`.`name` AS `author_name`,`c`.`name`AS `category_name`";
        $query[] = "FROM `course`AS`cs` JOIN `category`AS`c` ON `c`.`id`=`cs`.`category_id`";
        $query[] = "JOIN `author` AS`a` ON `a`.id =`cs`.`author_id`";
        $query[] = "WHERE `c`.`name`=" . "'" . $name_category . "' AND `cs`.`id`!=" . $id_course;
        $query = implode(" ", $query);
        $category[$name_category] = $this->execute($query, true);
        return $category;
    }

    public function getImageCourse($id_course)
    {
        $query[] = "SELECT imageThumbnail, name, description, sourse,course";
        $query[] = "FROM `" . DB_TBCOURSE . "`";
        $query[] = "WHERE id=$id_course";
        $query = implode(" ", $query);
        return $this->execute($query, true)[0];
    }
    public function videoFavorite($table,$idUser){
        $query="SELECT * FROM `".$table."` WHERE `id_user`=".$idUser;
        $data=$this->execute($query,true);
        return $data;
    }


}
