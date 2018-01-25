<?php
$total = $this->total;
$money = $this->money;
$infoUser = $this->infoUser;
$history = $this->historyPoint;
$videoViewed = $this->videoViewed;

$point = $this->point;
$listFavorite = $this->listFavorite;
$url = ["convert" => URL::createLink('default', 'user', 'convertPoint', null, 'convert-point.html')];
?>

<section class="profile-feature">
    <div class="awe-parallax bg-section1-demo"></div>
    <div class="awe-overlay overlay-color-1"></div>
    <div class="container">
        <div class="info-author">

            <div>
                <h2 class="text-center" style="color: #fff">Thông tin</h2>
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
                    &nbsp;Thông tin
                </a>
            </li>
            <li>
                <a href="" class="assignment">
                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                    &nbsp;Thống kê
                </a>
            </li>
            <!--            <li>-->
            <!--                <a href="" class="history">-->
            <!--                    <i class="fa fa-history" aria-hidden="true"></i>-->
            <!--                    &nbsp;Lịch sử-->
            <!--                </a>-->
            <!--            </li>-->
            <li>
                <a href="" class="learning">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    &nbsp;Đang học
                </a>
            </li>
            <li>
                <a href="" class="favorite">
                    <i class="fa fa-heart custom-heart" aria-hidden="true"></i>
                    &nbsp;Yêu thích
                </a>
            </li>

        </ul>
    </div>
</section>
<!-- END / CONTENT BAR -->

<!-- PROFILE -->
<section class="profile">
    <!--    // thông tin-->

    <div class="container user">
        <?php echo $this->error; ?>
        <?php echo $this->success; ?>
        <section id="create-course-section" class="create-course-section">
            <div class="row">
                <div class="col-md-3">
                    <div class="create-course-sidebar">
                        <ul class="list-bar custom-list-bar">
                            <li class="active" id="create-course-content"><span class="count">1</span>Thông tin cá nhân
                            </li>
                            <li id="changePass"><span class="count">2</span>Thay đổi mật khẩu</li>
                        </ul>

                    </div>
                </div>

                <div class="col-md-9 all-profile">
                    <div class="create-course-content active-profile">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- COURSE BANNER -->
                            <div class="course-banner create-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Avatar</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="image-info">
                                            <?php
                                            $avatar = TEMPLATE_PATH . "/default/main/images/avatar/" . $infoUser['avatar'];
                                            if (!empty($infoUser['avatar']) && file_exists($avatar)) {

                                                ?>
                                                <img src="<?php echo $urlImage . '/avatar/' . $infoUser['avatar']; ?>"
                                                     class="showAvatar" alt="" style="width: 100px;height: 100px; ">
                                            <?php } else {
                                                ?>
                                                <img src="<?php echo $urlImage . '/avatar/no-avatar.png'; ?>"
                                                     class="showAvatar" alt="" style="width: 100px;height: 100px; ">
                                            <?php } ?>
                                        </div>
                                        <label for="file-avatar" class="custom-button-file"><i
                                                    class="fa fa-cloud-upload" aria-hidden="true"></i></label>
                                        <input type="file" name="avatar-user" id="file-avatar"
                                               onchange="viewAvatar(this)">
                                    </div>

                                </div>
                            </div>
                            <!-- END / COURSE BANNER -->

                            <!-- User name -->
                            <div class="promo-video create-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Username</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-item">
                                            <p><?php echo $infoUser['username'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END / Username -->

                            <!-- Fullname -->
                            <div class="promo-video create-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Fullname</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-item">
                                            <input type="text" name="form[fullname]"
                                                   value="<?php echo $infoUser['fullname'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END / Fullname -->

                            <!-- Email -->
                            <div class="promo-video create-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Email</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-item">
                                            <p><?php echo $infoUser['email'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END / Email -->

                            <!-- Giới Tính -->
                            <div class="promo-video create-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Giới tính</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-item">
                                            <span style="display: inline">
                                            <input type="radio" name="form[sex]" class="radio-sex"
                                                   value="male" <?php if ($infoUser['sex'] == "male") echo "checked" ?>>
                                            <p
                                                    class="sex-p">Male</p>
                                            <input type="radio" name="form[sex]" class="radio-sex"
                                                   value="female" <?php if ($infoUser['sex'] == "female") echo "checked" ?>>
                                            <p
                                                    class="sex-p">Female</p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END / Giới Tính -->

                            <!-- Birthday -->
                            <div class="promo-video create-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>Sinh nhật</h4>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="input-group date" id="datetimepicker">
                                            <div class="form-item">
                                                <input type="date" name="form[birthday] " class="custom-birthday"
                                                       max="<?php echo date("Y-m-d") ?>"
                                                       value="<?php echo $infoUser['birthday'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo time() ?>" name="form[token]">
                            <!-- END / birthday -->

                            <div class="form-action custom-form-action">
                                <input type="submit" value="Lưu thay đổi" class="mc-btn btn-style-1">
                            </div>
                        </form>
                    </div>
                    <!--changePassword-->
                    <div class="changePass hidden">
                        <div class="col-md-12 ">
                            <div class="custom-create-course-content">
                                <form action="" method="post">
                                    <!--current pass-->
                                    <div class="promo-video create-item">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>Mật khẩu hiện tại</h4>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-item">
                                                    <input type="password" placeholder="Current password"
                                                           name="pass[current]" required">
                                                    <div class="error-current-pass"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end current pass-->
                                    <!--current pass-->
                                    <div class="promo-video create-item">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>Mật khẩu mới</h4>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-item">
                                                    <input type="password" placeholder="New password" name="pass[new]">
                                                    <div class="password" style="color: red"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end current pass-->
                                    <!--current pass-->
                                    <div class="promo-video create-item">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>Nhập lại mật khẩu</h4>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-item">
                                                    <input type="password" placeholder="Confirm password"
                                                           class="confirm">
                                                    <div class="confirmPassword" style="color: red"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo time() ?>" name="token">
                                    <!--end current pass-->
                                    <div class="form-action custom-form-action">
                                        <input type="submit" value="Lưu thay đổi"
                                               class="mc-btn btn-style-1 submitRegister">
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </div>

    <!--//thống kê-->

    <div class="container assignment hidden">
        <div class="question-content-wrap">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="video-viewed">Video đã xem</h2>
                    <div class="question-content custom-question-content">
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
                                        <?php foreach ($videoViewed as $key => $value) {
                                            ?>
                                            <div class="table-item new custom-table-item">
                                                <div class="thead">
                                                    <div class="submissions custom-submission"><a href="#"><?php echo $value['name_course'] ?></a>
                                                    </div>

                                                    <div class="replied"><?php echo $value['numVideo'] . '/' . $value['totalVideo'] ?></div>

                                                    <div class="toggle tb-icon">
                                                        <a href="#"><i class="fa fa-angle-down"></i></a>
                                                    </div>
                                                </div>

                                                <div class="tbody">
                                                    <!-- ITEM -->
                                                    <?php foreach ($value['title_video'] as $keyOne => $valueShow) { //code show title vs attachment link
                                                        $name_course = URL::filterURL($value['name_course']);
                                                        $name_category = URL::filterURL($value['name_category']);
                                                        $id_course = $value['id_course'];
                                                        $id_category = $value['id_category'];
                                                        $link = URL::createLink('default', 'course', 'index', array('id_course' => $id_course, 'id_category' => $id_category), "$name_category/$name_course-$id_category-$id_course-$keyOne.html");
                                                        ?>
                                                        <div class="item">
                                                            <div class="submissions custom-submission"><a target="_blank"
                                                                                        href="<?php echo $link ?>"><?php echo $valueShow ?></a>
                                                            </div>

                                                            <div class="replied">Đã xem</div>
                                                        </div>
                                                    <?php } ?>
                                                    <!-- END / ITEM -->
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <!-- END / TABLE ITEM -->


                                    </div>
                                    <!-- END / TABLE BODY -->
                                </div>

                            </div>
                            <!-- END / MY SUBMISSIONS -->

                        </div>
                    </div>

                </div>


                <div class="col-md-4">
                    <aside class="question-sidebar custom-question-sidebar">
                        <div class="download-file-learn">
                            <p class="info-point"> Thông tin điểm</p>
                        </div>
                        <div class="score-sb custom-score-sb">
                            <h4 class="title-sb">Tổng điểm đạt được:<span><?php echo $total ?> <i class="fa fa-star" aria-hidden="true"></i></span></h4>
                            <h4 class="title-sb">Điểm hiện tại:<span><?php echo $point ?> <i class="fa fa-star" aria-hidden="true"></i></span></h4>
                        </div>
                    </aside>
                </div>
            </div>
        </div>

    </div>

    <!--đang học-->
    <div class="container learning hidden">
        <div class="table-asignment">
            <ul class="nav-tabsOne custom-nav-tabsOne" role="tablist">
                <li class="statistical"><a href="#" role="tab" data-toggle="tab">Khóa học</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content custom-tab-content">
                <!-- MY SUBMISSIONS -->
                <div class="tab-pane fade in active" id="mysubmissions">
                    <div class="table-wrap">
                        <div class="row">
                            <?php foreach ($videoViewed as $key => $value) {
                                $name_course = URL::filterURL($value['name_course']);
                                $name_category = URL::filterURL($value['name_category']);
                                $id_course = $value['id_course'];
                                $id_category = $value['id_category'];
                                $link = URL::createLink('default', 'course', 'index', array('id_course' => $id_course, 'id_category' => $id_category), "$name_category/$name_course-$id_category-$id_course.html");
                                $percent = $value['numVideo'] / $value['totalVideo'];
                                ?>
                                <div class="col-xs-6 col-sm-4 col-md-3 custom-col">
                                    <!-- MC ITEM -->
                                    <div class="mc-learning-item mc-item mc-item-2">
                                        <div class="image-heading">
                                            <img src="<?php echo TEMPLATE_URL . '/default/main/images/course/' . $value['imgCourse'] ?>"
                                                 alt="">
                                        </div>
                                        <div class="meta-categories"><a href="#">Web design</a></div>
                                        <div class="content-item">
                                            <div class="image-author">
                                                <img src="<?php echo TEMPLATE_URL . '/default/main/images/author/' . $value['avatar'] ?>"
                                                     alt="">
                                            </div>
                                            <h4><a href="<?php echo $link ?>"
                                                   target="_blank"><?php echo $value['name_course'] ?></a></h4>
                                            <div class="name-author custom-name">
                                                By
                                                <a href="/tac-gia-<?php echo URL::filterURL($value['nameAuthor']) . '/' . $value['idAuthor'] . '.html' ?>"><?php echo $value['nameAuthor'] ?></a>
                                            </div>
                                        </div>
                                        <div class="ft-item">
                                            <div class="percent-learn-bar">
                                                <div class="percent-learn-run"></div>
                                            </div>
                                            <div class="percent-learn"><?php echo round($percent * 100, 0) ?>%<i
                                                        class="fa fa-trophy"></i></div>
                                            <a target="_blank" href="<?php echo $link ?>" class="learnnow">Đang học<i
                                                        class="fa fa-play-circle-o"></i></a>
                                        </div>
                                    </div>
                                    <!-- END / MC ITEM -->
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
                <!-- END / MY SUBMISSIONS -->

            </div>
        </div>
    </div>
    <!--    yêu thích-->
    <div class="container favorite hidden">
        <div class="table-asignment">
            <ul class="nav-tabsOne custom-nav-tabsOne" role="tablist">
                <li class="statistical"><a href="#" role="tab" data-toggle="tab">Khóa học yêu thích</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content custom-tab-content">
                <!-- MY SUBMISSIONS -->
                <div class="tab-pane fade in active" id="mysubmissions">
                    <div class="table-wrap">
                        <div class="row">
                            <?php foreach ($listFavorite as $value) { ?>
                                <div class="col-xs-6 col-sm-4 col-md-3 custom-col">
                                    <!-- MC ITEM -->
                                    <div class="mc-learning-item mc-item mc-item-2">
                                        <div class="image-heading">
                                            <img src="<?php echo TEMPLATE_URL . '/default/main/images/course/' . $value['imageCourse'] ?>"
                                                 alt="">
                                        </div>
                                        <div class="meta-categories"><a href="#">Web design</a></div>
                                        <div class="content-item">
                                            <div class="image-author">
                                                <img src="<?php echo TEMPLATE_URL . '/default/main/images/author/' . $value['avatar'] ?>"
                                                     alt="">
                                            </div>
                                            <h4><a href="<?php echo $value['linkCourse'] ?>"
                                                   target="_blank"><?php echo $value['nameCourse'] ?></a></h4>
                                            <div class="name-author custom-name">
                                                By
                                                <a href="/tac-gia-<?php echo URL::filterURL($value['nameAuthor']) . '/' . $value['idAuthor'] . '.html' ?>"><?php echo $value['nameAuthor'] ?></a>
                                            </div>
                                        </div>
                                        <div class="ft-item">

                                            <div class="percent-learn not-favorite"
                                                 id="<?php echo $value['idCourse'] ?>"><i class="fa fa-heart-o"
                                                                                          aria-hidden="true"></i> Bỏ yêu
                                                thích
                                            </div>

                                        </div>
                                    </div>
                                    <!-- END / MC ITEM -->
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
                <!-- END / MY SUBMISSIONS -->

            </div>
        </div>
    </div>

</section>
<!-- END / PROFILE -->

<script>
    /*not favorite in profile*/
    $(".not-favorite").click(function () {
        $(this).parents(".custom-col").remove();
        var idUserP = '<?php echo Session::get('user')['info']['id'] ?>';
        var idCourse1 = $(this).attr('id');
        $.ajax({
            url: ROOT_URL + 'index.php?module=default&controller=course&action=favoriteCourse',
            dataType: 'text',
            data: {
                idCourse: idCourse1,
                idUser: idUserP
            },
            success: function (data) {
                noticeUser(NOTICE_USER_REMOVE_FAVORITE_COURSE);
            }

        });
    });
    /*end*/

    /*  active profile */
    $(".list-bar li").click(function () {
        $(".list-bar *").removeClass("active");
        $(this).addClass("active");

        var nameClass = "." + $(this).attr('id');
        if ($(nameClass).hasClass("active-profile") == false) {
            $(nameClass).removeClass("hidden");
            $(".all-profile ").find(".active-profile").removeClass("active-profile").addClass("hidden");
            $(nameClass).addClass("active-profile");
        }

    });

    /*end active profile*/
    /*script table admin*/
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
    });
    /*end table admin*/

    var email = "<?php echo $infoUser['email'] ?>";
    var password = 0;
    var passwordConfirm = 0;
    var currentPass = 0;
    $('.submitRegister').attr('disabled', 'disabled');
    $('.submitRegister').attr('style', 'background:#37abf2');
    /* check new password*/
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
    /* check confirm password*/
    $("input.confirm").change(function () {
        if ($("input[name='pass[new]']").val() != $("input.confirm").val()) {
            passwordConfirm = 0;
        } else {
            passwordConfirm = 1;
        }
        checkForm(password, passwordConfirm, '');
        checkAgain(currentPass, password, passwordConfirm);
    });
    /*check current password*/
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
        });

    });

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
    });

    /*chuyển tab qua lại*/
    $(".user li a").click(function (e) {
        e.preventDefault();
        $(".user li").removeClass('current');
        $(this).parent().addClass('current');
        $(".profile div.container").addClass('hidden');
        $(".profile ." + this.className).removeClass('hidden');
    });
    /*thời gian tắt thông báo*/
    setTimeout(function () {
        $(".container .alert").hide();
    }, 10000);

    /*show hình khi chọn*/
    function viewAvatar(event) {
        var file = event.files[0];
        var reader = new FileReader();
        reader.onload = function (event) {

            $(".showAvatar").attr("src", event.target.result)
        };
        reader.readAsDataURL(file);
    }

    /*script of assignment*/
    $.each($('.table-wrap'), function () {
        $(this)
            .find('.table-item')
            .children('.thead:not(.active)')
            .next('.tbody').hide();
        $(this)
            .find('.table-item')
            .delegate('.thead', 'click', function (evt) {
                evt.preventDefault();
                if ($(this).hasClass('active') == false) {
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