<?php
$total=$this->total;
$money=$this->money;
$infoUser = $this->infoUser;
$history=$this->historyPoint;
$videoViewed=$this->videoViewed;
$point=$this->point;
$url=["convert"=>URL::createLink('default','user','convertPoint',null,'convert-point.html')];
?>

<section class="profile-feature">
    <div class="awe-parallax bg-section1-demo"></div>
    <div class="awe-overlay overlay-color-1"></div>
    <div class="container">
        <div class="info-author">

            <div>
                <h2 class="text-center" style="color: #fff">Profile</h2>
            </div>
        </div>
    </div>
</section>

<!-- CONTEN BAR -->
<section class="content-bar">
    <div class="container">
        <ul class="user">
            <li class="current">
                <a href="" class="user">
                    <i class="icon md-user-minus"></i>
                    &nbsp;Profile
                </a>
            </li>
            <li>
                <a href="" class="assignment">
                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                    &nbsp;Statistical
                </a>
            </li>
            <li>
                <a href="" class="history">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    &nbsp;History
                </a>
            </li>

        </ul>
    </div>
</section>
<!-- END / CONTENT BAR -->

<!-- PROFILE -->
<section class="profile">
    <div class="container user">
        <h3 class="md black">Profile</h3>
        <div class="row">
            <div class="col-md-12">
                <?php
                if (isset($this->success)) echo $this->success;
                if (isset($this->error)) echo $this->error
                ?>
                <div class="avatar-acount">
                    <div class="changes-avatar">
                        <div class="img-acount">

                            <?php if(!empty($infoUser['avatar'])){

                                ?>
                                <img src="<?php echo $urlImage.'/avatar/'.$infoUser['avatar']; ?>"  alt="">
                            <?php }else{
                                ?>
                                <img src="<?php echo $urlImage.'/avatar/no-avatar.png'; ?>"  alt="">
                            <?php }?>
                        </div>
                    </div>
                    <div class="info-acount">
                        <a href="" class="editInfo"><i class="fa fa-pencil-square-o pull-right" aria-hidden="true"></i></a>
                        <h3 class="md black">Full name</h3>
                        <p><?php echo $infoUser['fullname'] ?></p>
                        <div class="profile-email-address">
                            <div class="profile-email">
                                <h5>Sex</h5>
                                <p><?php if($infoUser['sex']== "male"){
                                    echo 'Male';
                                    }else if($infoUser['sex']== "female") {
                                        echo 'Female';
                                    }
                                    ?></p>
                            </div>
                        </div>
                        <div class="profile-email-address">
                            <div class="profile-email">
                                <h5>Email</h5>
                                <p><?php echo $infoUser['email'] ?></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="changeInfo" style="display: none" >
                    <h3 class="md black">Change Info</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!--                --><?php //if (isset($this->success)) echo $this->success ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="avatar-acount">
                                    <div class="changes-avatar">
                                        <div class="img-acount">
                                            <?php if(!empty($infoUser['avatar'])){

                                                ?>
                                                <img src="<?php echo $urlImage.'/avatar/'.$infoUser['avatar']; ?>" class="showAvatar" alt="">
                                            <?php }else{
                                                ?>
                                                <img src="<?php echo $urlImage.'/avatar/no-avatar.png'; ?>" class="showAvatar" alt="">
                                            <?php }?>
                                        </div>
                                        <label for="file-avatar" class="custom-button-file">Change avatar</label>
                                        <input type="file" name="avatar-user" id="file-avatar" onchange="viewAvatar(this)">
                                    </div>


                                    <div class="info-acount">
                                        <h3 class="md black">Nhập thông tin cần thay đổi</h3>
                                        <div class="security">
                                            <div class="tittle-security">
                                                <h5>Fullname</h5>
                                                <input type="text" name="form[fullname]"
                                                       value="<?php echo $infoUser['fullname'] ?>">
                                                <h5>Sex</h5>
                                                <span>
                                             <input type="radio" name="form[sex]" class="radio-sex" value="male" <?php if($infoUser['sex']=="male") echo "checked"?>><p
                                                            class="sex-p">Male</p>
                                            <input type="radio" name="form[sex]" class="radio-sex" value="female" <?php if($infoUser['sex']=="female") echo "checked"?>><p
                                                            class="sex-p">Female</p>
                                        </span>
                                                <h5>Birthday</h5>
                                                <input type="date" name="form[birthday]" max="<?php echo date("Y-m-d") ?>"
                                                       value="<?php echo $infoUser['birthday'] ?>">
                                                <input type="hidden" value="<?php echo time() ?>" name="form[token]">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-save">
                                        <input type="submit" value="Save changes" class="mc-btn btn-style-1">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="changePass">
                <h3 class="md black">Change password</h3>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <div class="avatar-acount">
                                <div class="info-acount">
                                    <div class="security">
                                        <div class="tittle-security">
                                            <h5>Password</h5>
                                            <input type="password" placeholder="Current password" name="pass[current]" required">
                                            <div class="error-current-pass"></div>
                                            <input type="password" placeholder="New password" name="pass[new]">
                                            <div class="password" style="color: red"></div>
                                            <input type="password" placeholder="Confirm password" class="confirm">
                                            <div class="confirmPassword" style="color: red"></div>
                                            <input type="hidden" value="<?php echo time() ?>" name="token">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-save">
                                    <input type="submit" value="Save changes" class="mc-btn btn-style-1 submitRegister">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>


    <div class="container assignment hidden">

        <div class="table-asignment">
            <div class="row">
                <div class="col-md-4 box-point">
                    <ul class="nav-tabsOne" role="tablist">
                        <li class="point active"><a href="#" role="tab" data-toggle="tab">
                                Tổng điểm<br/> <?php echo $total?> <i class="fa fa-star" aria-hidden="true"></i> </a></li>

                    </ul>
                </div>
                <div class="col-md-4 box-point">
                    <ul class="nav-tabsOne" role="tablist">
                        <li class="point active"><a href="#" role="tab" data-toggle="tab">
                                Điểm hiện tại<br/> <?php echo $point?> <i class="fa fa-star" aria-hidden="true"></i> </a></li>

                    </ul>
                </div>
                <div class="col-md-4 box-point">
                    <ul class="nav-tabsOne" role="tablist">
                        <li class="point active"><a href="#" role="tab" data-toggle="tab">
                             Giá trị điểm<br/> <?php echo 1?> <i class="fa fa-star" aria-hidden="true"></i>  <?php echo "= ".number_format($money[0]['current_money'],0,'.','.')." VNĐ";?> </a></li>

                    </ul>
                </div>
            </div>
             <a class="convert-point" target="_blank" href="<?php echo $url['convert'];?>">Đổi điểm</a>
            <ul class="nav-tabs" role="tablist">
                <li class="statistical" ><a href="#" role="tab" data-toggle="tab">My statistical</a></li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <!-- MY SUBMISSIONS -->
                <div class="tab-pane fade in active" id="mysubmissions">
                    <div class="table-wrap">
                        <!-- TABLE HEAD -->
                        <div class="table-head">
                            <div class="submissions"></div>
                            <div class="tb-icon"></div>
                        </div>
                        <!-- END / TABLE HEAD -->

                        <!-- TABLE BODY -->
                        <div class="table-body">


                            <!-- TABLE ITEM -->
                            <?php foreach ($videoViewed as $key => $value){
                                ?>
                            <div class="table-item new">
                                <div class="thead">
                                    <div class="submissions"><a href="#"><?php echo $value['name_course']?></a></div>
                                    <div class="total-subm"><?php echo $value['numVideo'].'/'.$value['totalVideo'] ?></div>
                                    <div class="replied"></div>
                                    <div class="latest-reply"></div>
                                    <div class="toggle tb-icon">
                                        <a href="#"><i class="fa fa-angle-down"></i></a>
                                    </div>
                                </div>

                                <div class="tbody">
                                    <!-- ITEM -->
                                    <?php foreach ($value['title_video'] as $keyOne => $valueShow){ //code show title vs attachment link
                                        $name_course=URL::filterURL($value['name_course']);
                                        $name_category=URL::filterURL($value['name_category']);
                                        $id_course =$value['id_course'];
                                        $id_category=$value['id_category'];
                                        $link=URL::createLink('default', 'course', 'index', array('id_course' => $id_course, 'id_category' => $id_category), "$name_category/$name_course-$id_category-$id_course-$keyOne.html");
                                        ?>
                                    <div class="item">
                                        <div class="submissions"><a target="_blank" href="<?php echo $link?>"><?php echo $valueShow?></a></div>
                                        <div class="total-subm">Viewed</div>
                                    </div>
                                    <?php }?>
                                    <!-- END / ITEM -->
                                </div>
                            </div>
                            <?php }?>
                            <!-- END / TABLE ITEM -->


                        </div>
                        <!-- END / TABLE BODY -->
                    </div>

                </div>
                <!-- END / MY SUBMISSIONS -->

            </div>
        </div>
    </div>
 <div class="container history hidden">
     <ul class="nav-tabs" role="tablist">
         <li class="statistical" ><a href="#" role="tab" data-toggle="tab">My History</a></li>

     </ul>

         <!-- Main content -->
         <section class="content">
             <div class="row">
                 <div class="col-xs-12">
                     <div class="box">
                         <!-- /.box-header -->
                             <div class="box-body">
                                 <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                     <div class="row">
                                         <div class="col-sm-12">
                                             <table id="example1" class="table table-bordered table-striped dataTable"
                                                    role="grid" aria-describedby="example1_info">
                                                 <thead>
                                                 <tr role="row">
                                                     <th>Current Point</th>
                                                     <th>Point convert</th>
                                                     <th>Money</th>
                                                     <th>date</th>
                                                     <th>time</th>
                                                     <th>status</th>
                                                 </tr>
                                                 </thead>
                                                 <tbody>
                                                 <?php
                                                 foreach ($history as $key => $value) { ?>
                                                     <tr role="row" class="odd">
                                                         <td><?php echo $value['current_point'] ?></td>
                                                         <td><?php echo $value['point_convert'] ?></td>
                                                         <td><?php echo number_format($value['money'],0,'.','.')." VNĐ" ?></td>
                                                         <td><?php echo $value['date_convert'] ?></td>
                                                         <td><?php echo $value['time'] ?></td>
                                                         <td ><?php if($value['status']==0)
                                                                 echo "Processing ...";
                                                             else
                                                                 echo "Completed";
                                                             ?></td>

                                                     </tr>

                                                     <?php
                                                 } ?>
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         <!-- /.box-body -->
                     </div>
                     <!--            </form>-->
                     <!-- /.box -->
                 </div>
                 <!-- /.col -->
             </div>
             <!-- /.row -->
         </section>

         <!-- /.content -->

 </div>

</section>
<!-- END / PROFILE -->
<script>

</script>
<script>
    //script table admin
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
    //end table admin
    var email = "<?php echo $infoUser['email'] ?>";
    var password = 0;
    var passwordConfirm = 0;
    var currentPass = 0;
    $('.submitRegister').attr('disabled', 'disabled');
    $('.submitRegister').attr('style', 'background:#808080');
    // check new password
    $("input[name='pass[new]']").change(function () {
        if ($("input[name='pass[new]']").val().length < 6) {
            password = 0;
        } else {
            password = 1;
        }
        if ($("input[name='pass[new]']") != $("input.confirm").val()) {
            passwordConfirm = 0;
        } else {
            passwordConfirm = 1;
        }
        checkForm(password, passwordConfirm, '');
        checkAgain(currentPass, password, passwordConfirm);
    });
    // check confirm password
    $("input.confirm").change(function () {
        if ($("input[name='pass[new]']").val() != $("input.confirm").val()) {
            passwordConfirm = 0;
        } else {
            passwordConfirm = 1;
        }
        checkForm(password, passwordConfirm, '');
        checkAgain(currentPass, password, passwordConfirm);
    });
    //check current password
    $("input[name='pass[current]']").change(function () {
        var value = $(this).val();

        $.ajax({
            url: ROOT_URL + 'index.php?module=default&controller=user&action=checkPassword',
            dataType: "text",
            data: {
                pass: value,
                email: email
            },
            success: function (data) {

                if (data == 'no') {

                    $(".error-current-pass").text('Mật khẩu không chính xác!');
                    currentPass = 0;
                }
                else if (data == 'yes') {

                    $(".error-current-pass").text('');
                    currentPass = 1;
                }
                checkAgain(currentPass, password, passwordConfirm);

            }
        })

    })

    function checkForm(password, passwordConfirm, currentPass) {
        if (password == 1) {
            $(".password").text('');
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
        } else {
            $(".password").text(' Mật khẩu ít nhất 6 ký tự.thử lại?');
            $('.submitRegister').attr('disabled', 'disabled');
            $('.submitRegister').attr('style', 'background:#808080');
        }
        if (passwordConfirm == 1) {
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
            $(".confirmPassword").text('');
        } else {
            $(".confirmPassword").text('Mật khẩu không khớp.thử lại?');
            $('.submitRegister').attr('disabled', 'disabled');
            $('.submitRegister').attr('style', 'background:#808080');
        }

    }

    function checkAgain(currentPass, password, passwordConfirm) {
        if (currentPass == 0 || password == 0 || passwordConfirm == 0) {
            $('.submitRegister').attr('disabled', 'disabled');
            $('.submitRegister').attr('style', 'background:#808080');
        } else if (currentPass == 1 && password == 1 && passwordConfirm == 1) {
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
        }
    }

    $(".editInfo").click(function (e) {
        e.preventDefault();
        $(".changeInfo").toggleClass('appear');
        $("html,body").animate({scrollTop: $(".changeInfo").offset().top}, 400);
    })

//chuyển tab qua lại
        $(".user li a").click(function (e) {
            e.preventDefault();
            $(".user li").removeClass('current');
            $(this).parent().addClass('current');
            $(".profile div.container").addClass('hidden');
            $(".profile ." + this.className).removeClass('hidden');
        });
//thời gian tắt thông báo
    setTimeout(function () {
        $(".container .alert").hide();
    }, 10000);
    //show hình khi chọn
    function viewAvatar(event) {
        var file=event.files[0];
        var reader= new FileReader();
        reader.onload= function (event) {

            $(".showAvatar").attr("src",event.target.result)
        };
        reader.readAsDataURL(file);
    }
    //script of assignment
    $.each($('.table-wrap'), function() {
        $(this)
            .find('.table-item')
            .children('.thead:not(.active)')
            .next('.tbody').hide();
        $(this)
            .find('.table-item')
            .delegate('.thead', 'click', function(evt) {
                evt.preventDefault();
                if ($(this).hasClass('active')==false) {
                    $('.table-item')
                        .find('.thead')
                        .removeClass('active')
                        .siblings('.tbody')
                        .slideUp(200);
                }
                $(this)
                    .toggleClass('active')
                    .siblings('.tbody')
                    .slideToggle(200);
            });
    });

</script>