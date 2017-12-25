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
                <div class="form-login">
                    <form action="<?php echo $url['register'] ?>" method="post">
                        <h2 class="text-uppercase">sign up</h2>
                        <div class="form-email">
                            <input type="text" placeholder="Full Name" name="form[fullname]">
                        </div>
                        <div class="form-datebirth">
                            <input type="date" placeholder="Date of Birth" name="form[birthday]"
                                   max="<?php echo date("Y-m-d", time()) ?>">
                        </div>
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
<!--                            <div class="g-recaptcha" data-sitekey="6Leoaz0UAAAAANTNcjesQY-4nn9i773rO2ttN0aH"></div>-->
                            <div id="recapcha"></div>
                            <?php echo $this->errorCapcha;?>
                        </div>
                        <div class="form-submit-1">
                            <input type="submit" value="Become a member" class="mc-btn btn-style-1 submitRegister">
                            <input type="hidden" value="<?php echo time()?>" name="form[token]">
                        </div>
                        <div class="link">
                            <a href="<?php echo $url['login'] ?>">
                                <i class="icon md-arrow-right"></i>Already have account ? Log in
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
    //callback capcha
    var verifyCallback = function(response) {

            errCapcha=1;
        checkFormAgain(password,passwordConfirm,errCapcha,errMail);
    };
    var onloadCallback=function () {
        grecaptcha.render('recapcha',{
            'sitekey' :'6Leoaz0UAAAAANTNcjesQY-4nn9i773rO2ttN0aH',
//           'size':'compact',
            'theme':'dark',
            'callback': verifyCallback
        });
    };

    //check form

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
                    $(".email").text('No an invalid email');
                    $('.submitRegister').attr('disabled', 'disabled');
                    $('.submitRegister').attr('style', 'background:#808080');
                    errMail=0;
                } else if (data == 'false') {
                    $(".email").text('The email has been used. Try to other email');
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
        })
    });


    function checkForm(password, passwordConfirm) {
        if (password == 1) {
            $(".password").text('');
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
        } else {

            $(".password").text(' Try a password with at least 6 characters.');
            $('.submitRegister').attr('disabled', 'disabled');
            $('.submitRegister').attr('style', 'background:#808080');
        }
        if (passwordConfirm == 1) {
            $('.submitRegister').prop("disabled", false);
            $('.submitRegister').attr('style', 'background:#1DA1F1');
            $(".confirmPassword").text('');
        } else {
            $(".confirmPassword").text('These passwords do not match. Retry?');
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

<!--<script>-->
<!--    var errorPass = 0;-->
<!--    var errorConfirm = 0;-->
<!--    var errorEmail=0;-->
<!--    var currentPass = '';-->
<!--    var currentConfirm = '';-->
<!--    //xét password-->
<!--    $("input[name='form[password]']").change(function () {-->
<!--        if (currentConfirm !== '') {-->
<!--            if ($(this).val() !== currentConfirm) {-->
<!--                $(".confirmPassword").text('Các mật khẩu không khớp.thử lại?');-->
<!--            } else {-->
<!--                $(".confirmPassword").text('');-->
<!--            }-->
<!--        }-->
<!--        if ($(this).val().length < 6) {-->
<!--            $(".password").text('Mật khẩu ít nhất 6 kí tự.thử lại?');-->
<!--            currentPass = $(this).val();-->
<!--            errorPass = 0-->
<!--        } else {-->
<!--            $(".password").text('')-->
<!--            currentPass = $(this).val();-->
<!--            errorPass = 1;-->
<!--        }-->
<!---->
<!--    });-->
<!--    //xét confirmpassword-->
<!--    $("input[name='form[confirmPassword]']").change(function () {-->
<!--        currentConfirm = $(this).val();-->
<!--        if (currentPass !== currentConfirm) {-->
<!--            $(".confirmPassword").text('Các mật khẩu không khớp.thử lại?');-->
<!--            errorConfirm = 0;-->
<!--        } else {-->
<!--            $(".confirmPassword").text('');-->
<!--            errorConfirm = 1;-->
<!--        }-->
<!--    });-->
<!--    //xét email-->
<!--    $("input[name='form[email]']").change(function () {-->
<!--        var value=$(this).val();-->
<!--        $.ajax({-->
<!--            url:ROOT_URL+'index.php?module=default&controller=index&action=checkEmailAjax',-->
<!--            type:'GET',-->
<!--            dataType:"json",-->
<!--            data:{email:value},-->
<!--            success:function (data) {-->
<!--                if(data =='no'){-->
<!--                    $(".email").text('Email không hợp lệ!');-->
<!--                    errorEmail=0;-->
<!--                }-->
<!--                else if(data=='false'){-->
<!--                    $(".email").text('Email đã tồn tại!');-->
<!--                    errorEmail=0;-->
<!--                }-->
<!--                else{-->
<!--                    $(".email").text('');-->
<!--                    errorEmail=1;-->
<!--                }-->
<!--            }-->
<!---->
<!--        })-->
<!--    })-->
<!--    //xét input rỗng-->
<!--    $(".submitRegister").click(function (e) {-->
<!--        if (errorConfirm === 0 || errorPass === 0 || errorEmail===0) {-->
<!--            e.preventDefault();-->
<!--//            $(".password").text('Bạn không được để trống trường này.');-->
<!--//            $(".confirmPassword").text('Bạn không được để trống trường này.');-->
<!---->
<!--        }-->
<!--    })-->
<!--    $("input[type=checkbox]").click(function () {-->
<!--        console.log("hi");-->
<!--        console.log($("input:checked").val());-->
<!--    })-->
<!---->
<!---->
<!---->
<!--</script>-->