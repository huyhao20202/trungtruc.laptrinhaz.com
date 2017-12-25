
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo $dirAdminLTE ?>/index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php if (isset($this->errors)) echo $this->errors ?>

        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Email or Username" name="form[email]">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="form[password]" required>
                <input type="hidden" class="form-control" value="<?php echo time() ?>" name="form[token]" >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="#">I forgot my password</a><br>
        <a href="" class="text-center">Register a new membership</a>
    </div>
    <!-- /.login-box-body -->
</div>
