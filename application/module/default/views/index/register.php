<?php
$url = [
    'login' => URL::createLink('default', 'index', 'login', null, "dang-nhap.html"),
    'register' => URL::createLink('default', 'index', 'register', null, "dang-ki.html"),
];

?>

<section id="login-content" class="login-content">
    <div class="awe-parallax bg-login-content"></div>
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="row">
            <!-- FORM -->
            <div class="col-lg-4 pull-right">
                <div class="form-login custom-form-login">

                    <form action="<?php echo $url['register'] ?>" method="post">
                        <h2 class="text-uppercase">Đăng ký</h2>
                        <?php echo  $this->errors;?>
                        <div class="form-email">
                            <input type="email" placeholder="Email (*)" name="form[email]" autofocus required>
                            <div class="email" style="color: #fff"></div>
                        </div>
                        <div class="form-password">
                            <input type="password" placeholder="Password (*)" name="form[password]" required>
                            <div class="password" style="color: #fff"></div>
                        </div>
                        <div class="form-password">
                            <input type="password" placeholder="Confirm Password (*)" name="form[confirmPassword]"
                                   required>
                            <div class="confirmPassword" style="color: #fff"></div>
                        </div>
                        <div class="form-password" id="cap" style="padding-top: 20px;overflow: hidden;">

                        </div>
                        <div id="recapcha"></div>
                        <?php echo $this->errorCapcha;?>
                        <div class="form-submit-1">
                            <input type="submit" value="Đăng ký" class="mc-btn btn-style-1 submitRegister">
                            <input type="hidden" value="<?php echo time()?>" name="form[token]">
                        </div>
                        <div class="link custom-link">
                            <a href="<?php echo $url['login'] ?>">
                                <i class="icon md-arrow-right"></i>Bạn đã có tài khoản? Click để đăng nhập
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END / FORM -->

            <div class="image">
                <img src="<?php echo $urlImage . "/login.png" ?>" alt="image register">
            </div>

        </div>
    </div>
</section>


<script>
    var password = 0;
    var passwordConfirm = 0;
    var errCapcha= 0;
    var errMail=0;
    /*callback capcha*/
    var verifyCallback = function(response) {

            errCapcha=1;
        checkFormAgain(password,passwordConfirm,errCapcha,errMail);
    };
    var onloadCallback=function () {
        grecaptcha.render('recapcha',{
            'sitekey' :'6Leoaz0UAAAAANTNcjesQY-4nn9i773rO2ttN0aH',
            'theme':'dark',
            'callback': verifyCallback
        });
    };

    /*check form*/

    $('.submitRegister').attr('disabled', 'disabled');
    $('.submitRegister').attr('style', 'background:#808080');

    $("input[name='form[password]']").change(function () {
        if ($("input[name='form[password]']").val().length < 6) {
            password = 0;
        } else {
            password = 1;
        }
        if ($("input[name='form[password]']").val() != $("input[name='form[confirmPassword]']").val()) {
            passwordConfirm = 0;
        } else {
            passwordConfirm = 1;
        }
        checkForm(password, passwordConfirm);
        checkFormAgain(password,passwordConfirm,errCapcha);
    });
    $("input[name='form[confirmPassword]']").change(function () {
        if ($("input[name='form[password]']").val() != $("input[name='form[confirmPassword]']").val()) {
            passwordConfirm = 0;
        } else {
            passwordConfirm = 1;
        }
        checkForm(password, passwordConfirm);
        checkFormAgain(password,passwordConfirm,errCapcha);
    });
    $("input[type=\"email\"]").change(function () {
        $.ajax({
            url: ROOT_URL + 'index.php?module=default&controller=index&action=checkEmailAjax',
            type: "GET",
            data: {email: $("input[type=\"email\"]").val()},
            dataType: "json",
            success: function (data, status) {
                if (data == 'no') {
                    $(".email").text('Email không hợp lệ!');
                    $('.submitRegister').attr('disabled', 'disabled');
                    $('.submitRegister').attr('style', 'background:#808080');
                    errMail=0;
                } else if (data == 'false') {
                    $(".email").text('Email đã tồn tại.Vui lòng thử email khác!');
                    $('.submitRegister').attr('disabled', 'disabled');
                    $('.submitRegister').attr('style', 'background:#808080');
                    errMail=0;
                } else {
                    $(".email").text('');
                    $('.submitRegister').prop("disabled", false);
                    $('.submitRegister').attr('style', 'background:#1DA1F1');
                    errMail=1
                }
                checkFormAgain(password,passwordConfirm,errCapcha,errMail);
            }
        });
    });


    function checkForm(password, passwordConfirm) {
        if (password == 1) {
            $(".password").text('');
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
        } else {

            $(".password").text(' Mật khẩu ít nhất 6 ký tự!');
            $('.submitRegister').attr('disabled', 'disabled');
            $('.submitRegister').attr('style', 'background:#808080');
        }
        if (passwordConfirm == 1) {
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
            $(".confirmPassword").text('');
        } else {
            $(".confirmPassword").text('Mật khẩu không khớp.Vui lòng thử lại?');
            $('.submitRegister').attr('disabled', 'disabled');
            $('.submitRegister').attr('style', 'background:#808080');
        }
    }
    function checkFormAgain(password,passwordConfirm,errCapcha,errMail) {
        if(password==0||passwordConfirm==0||errCapcha==0||errMail==0){
            $('.submitRegister').attr('disabled', 'disabled');
            $('.submitRegister').attr('style', 'background:#808080');
        }else if(password==1 && passwordConfirm==1 && errCapcha==1 && errMail==1){
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
        }
    }






</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
</script>

