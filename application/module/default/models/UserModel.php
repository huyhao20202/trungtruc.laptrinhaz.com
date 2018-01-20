<?php

class UserModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function userActiveMail($activeCode,$email)
    {
        $query = array();
        $query[] = "SELECT `u`.`id`";
        $query[] = "FROM `" . DB_TBUSER . "` AS  `u`";
        if(empty($email)) {
            $query[] = "WHERE `u`.`active_code`=" . $activeCode;
        }else{
            $query[] = "WHERE `u`.`email`= '" . $email."'";
        }

        $query = implode(" ", $query);
        $userId = $this->execute($query, true);
        return $userId;
    }
    public  function userActive($userId,$activeCode){
        $query = array();
        $query[] = "UPDATE `".DB_TBUSER."`AS `u` " ;
        $query[] = "SET `u`.`status` = 1,`u`.`active_code`= 1";
        $query[] = "WHERE `u`.`active_code`= ". $activeCode." AND `u`.`id`= ".$userId  ;
        $query = implode(" ", $query);

        $this->execute($query);
    }
    public function updatePass($userId,$newPass){
        $query = array();
        $query[] = "UPDATE `".DB_TBUSER."`AS `u` " ;
        $query[] = "SET `u`.`password` ='".$newPass."',`u`.`type`=1";
        $query[] = "WHERE `u`.`id`= ".$userId  ;
        $query = implode(" ", $query);
        $this->execute($query);

    }
    public function checkEmailExist($email)
    {
        $query = "SELECT * FROM `" . DB_TBUSER . "` WHERE `email` = '$email'";
        return $this->isExist($query);
    }
    public function checkPassExist($pass,$email)
    {
        $query = "SELECT * FROM `" . DB_TBUSER . "` WHERE `password` = '$pass' AND `email` = '$email'";

       return $this->isExist($query);

    }
    public function dataFavorite($idUser){
        $query[]="SELECT fa.id_user as`idUser`,fa.name_course as `nameCourse`, fa.url_course as `linkCourse`, fa.id_course as `idCourse`,a.id as `idAuthor`,a.name as `nameAuthor`, a.avatar as `avatar`,cs.image as `imageCourse`";
        $query[]="FROM `course` as `cs`";
        $query[]="INNER JOIN `author` as `a` ON `cs`.`author_id`=`a`.`id`";
        $query[]="INNER JOIN `favoriteCourse` as `fa` ON `cs`.`id`=`fa`.`id_course`";
        $query[]="WHERE `fa`.`id_user`= $idUser";
        $strQuery=implode("",$query);
        $data=$this->execute($strQuery,true);
        return $data;

    }
}