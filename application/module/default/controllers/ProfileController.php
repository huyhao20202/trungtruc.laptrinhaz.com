<?php
/**
 * Created by PhpStorm.
 * User: HAOHAO100
 * Date: 1/22/2018
 * Time: 1:59 AM
 */

class ProfileController extends Controller
{
    public function __construct($params)
    {
        parent::__construct($params);
        $this->_templateObj->setFolderTemplate('default/main');
        $this->_templateObj->setFileTemplate('index.php');
        $this->_templateObj->setFileConfig('template.ini');
        $this->_templateObj->load();
    }
    public function profileAction()
    {

//change info===============================================================================================================
        if (isset($this->_arrParam['form'])) {
            if (Session::get('token') != $this->_arrParam['form']['token']) {
                Session::set('token', $this->_arrParam['form']['token']);
                $form = [];
                unset($this->_arrParam['form']['token']);
                foreach ($this->_arrParam['form'] as $key => $value) {
                    if (!empty($value)) {
                        $form[$key] = $value;
                    }
                }
                if ($form['sex'] == "male" || $form['sex'] == "female") {
                    $form['avatar'] = $_FILES['avatar-user'];
                    if (!empty($form['avatar']['name'])) {

                        $nameAvatar = URL::filterURL($form['avatar']['name']);
                        $stringRandom = URL::generateRandomString(10);
                        $form['avatar']['name'] = $stringRandom . $nameAvatar;
                        $validate = new Validate($form);
                        $validate->addRule('avatar', 'file', ['min' => 1000, 'max' => 2097152, 'extension' => ['jpg', 'png', 'jpeg']], false);
                        $validate->run();
                        if ($validate->isValid() == false) {
                            $this->_view->error = $validate->showErrors();

                        } else {
                            $removeAvatar = $this->_model->select(DB_TBUSER, Session::get('user')['info']['id'], 1);
                            $removeLink = TEMPLATE_PATH . "/default/main/images/avatar/" . $removeAvatar['avatar'];
                            $form['avatar'] = $form['avatar']['name'];
                            $form['modified'] = date("Y-m-d", time());
                            $form['modified_by'] = session::get('user')['info']['id'];
                            $this->_model->update(DB_TBUSER, $form, ['id' => Session::get('user')['info']['id']]);
                            $folderUpload = TEMPLATE_PATH . "/default/main/images/avatar/" . $form['avatar'];
                            if (file_exists($removeLink)) {
                                unlink($removeLink);
                            }
                            move_uploaded_file($_FILES['avatar-user']['tmp_name'], $folderUpload);

                            $this->_view->success = Helper::success('Cập nhật tài khoản thành công');
                        }
                    } else {
                        $this->_arrParam['form']['modified'] = date("Y-m-d", time());
                        $this->_arrParam['form']['modified_by'] = session::get('user')['info']['id'];
                        $this->_model->update(DB_TBUSER, $this->_arrParam['form'], ['id' => Session::get('user')['info']['id']]);

                        $this->_view->success = Helper::success('Cập nhật tài khoản thành công');
                    }
                } else {
                    $this->_view->error = Helper::showErrors('Giá trị sex không hợp lệ!');
                }
            }
        }
//change Password===========================================================================================================
        if (isset($this->_arrParam['pass'])) {
            if (Session::get('token') != $this->_arrParam['token']) {
                Session::set('token', $this->_arrParam['token']);
                $id = Session::get('user')['info']['id'];
                $query = "SELECT * FROM `" . DB_TBUSER . "` WHERE `password` = '" . md5($this->_arrParam['pass']['current']) . "' AND id = $id";
                if (!empty($this->_model->execute($query, 1))) {
                    $this->_model->update(DB_TBUSER, ['password' => md5($this->_arrParam['pass']['new']),'type'=>1], ['id' => $id]);
                    $this->_view->success = Helper::success('Cập nhật tài khoản thành công');
                } else {
                    $this->_view->error = Helper::showErrors('Mật khẩu không chính xác');
                }
            }
        }
        // statistical vs point
        $idUser = session::get('user')['info']['id'];
        $dataUser = $this->_model->show('user', $idUser);
        $arrPoint = unserialize($dataUser['point']);
        $dataVideo = [];
        $data = [];
        $queryVideo = $queryVideo = "SELECT `cs`.`id` AS `id_course`,`c`.`id` AS `id_category`,`cs`.`name` AS `name_course`,`cs`.`image` AS `imgCourse`,`c`.`name` AS `name_category`,`a`.`name` AS `nameAuthor`,`a`.`id` AS `idAuthor`,`a`.`avatar` AS `avatar`
                                                                                                          FROM `course`AS `cs` INNER JOIN `category` AS `c`
                                                                                                            ON `cs`.`category_id`=`c`.`id` 
                                                                                                            INNER JOIN `author` AS `a` ON `a`.`id`=`cs`.`author_id`";
        $listVideo = $this->_model->execute($queryVideo, true);

        $queryAllVideo="SELECT COUNT(`id`) AS `allVideo`FROM `" . DB_TBVIDEO . "`";
        $allVideo=$this->_model->execute($queryAllVideo, true);
        foreach ($listVideo as $key => $value1) {
            $queryTotalVideo = "SELECT COUNT(`id`) AS `totalVideo`,`course_id` FROM `" . DB_TBVIDEO . "`WHERE `course_id`=" . $value1['id_course'];
            $listVideo[$key]['totalVideo'] = $this->_model->execute($queryTotalVideo, true)[0]['totalVideo'];
        }

        foreach ($arrPoint as $value) {
            $dataVideo[] = $this->_model->show('video', $value);
        }

        foreach ($listVideo as $key => $value) {
            $number = 0;
            foreach ($dataVideo as $valueId) {
                if ($value['id_course'] == $valueId['course_id']) {
                    $data[$value['id_course']]['name_course'] = $value['name_course'];
                    $data[$value['id_course']]['name_category'] = $value['name_category'];
                    $data[$value['id_course']]['title_video'][$valueId['id']] = $valueId['title'];
                    $data[$value['id_course']]['numVideo'] = ++$number;
                    $data[$value['id_course']]['totalVideo'] = $value['totalVideo'];
                    $data[$value['id_course']]['id_course'] = $valueId['course_id'];
                    $data[$value['id_course']]['id_category'] = $value['id_category'];
                    $data[$value['id_course']]['idAuthor'] = $value['idAuthor'];
                    $data[$value['id_course']]['nameAuthor'] = $value['nameAuthor'];
                    $data[$value['id_course']]['avatar'] = $value['avatar'];
                    $data[$value['id_course']]['imgCourse'] = $value['imgCourse'];

                }
            }
        }
        //start code compute point======================================================================
        if(!empty($arrPoint)){
            $num=count($arrPoint);
            $this->_view->total=$num;
            $compute=$num-Session::get('compute');
            if($compute<$allVideo[0]['allVideo']){
                $computePoint=  $dataUser['all_point']+$compute;
            }
            $this->_model->update('user',['all_point'=>$computePoint],['id'=>$idUser]);
            Session::set('compute',$num);
            $dataUser = $this->_model->show('user', $idUser);
            $this->_view->point=$dataUser['all_point'];
        }else{
            $this->_view->point=0;
            $this->_view->total=0;
        }
        //end code compute point========================================================================

        //list favorite course

        $this->_view->listFavorite=$this->_model->dataFavorite(Session::get('user')['info']['id']);
        //end list favorite course

        //info point convert money
        $queryTwo="SELECT * FROM `currentMoney` ORDER BY `id` DESC ";
        $this->_view->money=$this->_model->execute($queryTwo,true);
        //end info

        //history point convert
        $queryHistory="SELECT * FROM `historyPoint` WHERE `id_user`=".Session::get('user')['info']['id'];
        $this->_view->historyPoint=$this->_model->execute($queryHistory,true);
        //end history
        $this->_view->videoViewed = $data;
        $this->_view->infoUser = $this->_model->select(DB_TBUSER, Session::get('user')['info']['id'], 1);
        $this->_view->render("profile/profile");
    }
//end profileAction-------

//convert point
    public function convertPointAction(){

        $queryTwo="SELECT * FROM `currentMoney` ORDER BY `id` DESC ";
        $this->_view->money=$this->_model->execute($queryTwo,true);
        if(isset($this->_arrParam['form'])) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $idUser = Session::get('user')['info']['id'];
            $history = $this->_model->show('user', $idUser);
            $queryOne="SELECT * FROM `historyPoint` WHERE `id_user`= ".$idUser." AND `status`= 0";
            $historyPoint = $this->_model->execute($queryOne,true);
            if (!empty($historyPoint)) {
                $this->_view->errors = Helper::showErrors('Yêu cầu đổi điểm lần trước chưa được xác nhận!');
            } else {
                if (0 < $this->_arrParam['form']['convert'] && $this->_arrParam['form']['convert'] <= $history['all_point'] && gettype($this->_arrParam['form']['convert'] == 'integer')) {
                    $convert = [];
                    $convert['id_user'] = $idUser;
                    $convert['current_point'] = $history['all_point'];
                    $convert['point_convert'] = $this->_arrParam['form']['convert'];
                    $convert['date_convert'] = date('Y-m-d', time());
                    $convert['money'] = $this->_arrParam['form']['convert'] * $this->_view->money[0]['current_money'];
                    $convert['time']=date('H:i:s', time());
                    $convert['status'] = 0;
                    $this->_model->insert('historyPoint', $convert);
                    $this->_view->success=Helper::success('Vui lòng chờ quản trị viên xác nhận!');
                }else{
                    $this->_view->errors = Helper::showErrors('Số điểm phải nhỏ hơn hoặc bằng số điểm hiện tại!');
                }
            }
        }

        $this->_view->render('profile/convertPoint');
    }
}