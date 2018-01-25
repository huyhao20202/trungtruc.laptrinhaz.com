<?php


class ProfileModel extends Model
{
    public function __construct()
    {
        parent::__construct();
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