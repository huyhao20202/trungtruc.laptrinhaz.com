<?php
$infoUser = $this->infoUser;

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
            <!--            <li>-->
            <!--                <a href="" class="changeInfo">-->
            <!--                    <i class="fa fa-cog"></i>-->
            <!--                    &nbsp;Change Info-->
            <!--                </a>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a href="" class="changePass">-->
            <!--                    <i class="fa fa-cog"></i>-->
            <!--                    &nbsp;Change Password-->
            <!--                </a>-->
            <!--            </li>-->
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
    </div>
    <div class="container changeInfo" style="display: none" >
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
    <div class="container changePass">
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
</section>
<!-- END / PROFILE -->
<script>
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


    //    $(".user li a").click(function (e) {
    //        e.preventDefault();
    //        $(".user li").removeClass('current');
    //        $(this).parent().addClass('current');
    //        $(".profile div.container").addClass('hidden');
    //        $(".profile ." + this.className).removeClass('hidden');
    //    });
    setTimeout(function () {
        $(".container .alert").hide();
    }, 10000);
    function viewAvatar(event) {
        var file=event.files[0];
        var reader= new FileReader();
        reader.onload= function (event) {

            $(".showAvatar").attr("src",event.target.result)
        };
        reader.readAsDataURL(file);
    }
</script>