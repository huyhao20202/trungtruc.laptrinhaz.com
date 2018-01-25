<?php
$url = [
    'register' => URL::createLink('default', 'index', 'register', null, "dang-ki.html"),
    'forgetPass'=> URL::createLink('default','user','forget',null,"forget-password.html")
];
?>
<!-- LOGIN -->
<section id="login-content" class="login-content">
    <div class="awe-parallax bg-login-content"></div>
    <div class="awe-overlay"></div>
    <div class="container">
        <div class="row">
            <!-- FORM -->
            <div class="col-xs-12 col-lg-4 pull-right">
                <div class="form-login">
                    <form action="#" method="post">
                        <h2 class="text-uppercase">Đăng nhập</h2>
                        <div class="item-notice"><p class="ten-notice">Bạn có thể đăng nhập bằng tài khoản trên zendvn.com</p></div>
                        <p class="text-center" style="color: #FFFFFF">
                            <?php
                            if (isset($this->errors)) echo $this->errors;
                            ?>
                        </p>
                        <div class="form-email">
                            <input type="text" placeholder="Email" name="form[email]">
                        </div>
                        <div class="form-password">
                            <input type="password" placeholder="Password" name="form[password]">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="check" name="form[check]">
                            <label for="check">
                                <i class="icon md-check-2"></i>
                                Remember me</label>
                            <a href="<?php echo $url['forgetPass']?>">Quên mật khẩu?</a>
                        </div>
                        <div class="form-submit-1">
                            <input type="submit" value="Đăng nhập" class="mc-btn btn-style-1">
                            <input type="hidden" value="<?php echo time() ?>" name="form[token]">
                        </div>
                        <div class="link custom-link">
                            <a href="<?php echo $url['register'] ?>">
                                <i class="icon md-arrow-right "></i>Bạn chưa có tài khoản ? Click để đăng ký
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END / FORM -->
            <div class="image">
                <img src="<?php echo $urlImage . "/login.png" ?>" alt="image login" >
            </div>
        </div>
    </div>
</section>
<!-- END / LOGIN -->