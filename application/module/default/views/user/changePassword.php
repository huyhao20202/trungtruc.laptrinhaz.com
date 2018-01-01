
<section id="featured-request-teacher" class="featured-request-teacher section" style="color: #0b5fc6">
    <div class="awe-parallax "></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="request-featured">
                    <h1 class="big text-center">Thực hiện thay đổi Password</h1>
                    <div class="form-forget">
                        <form action="<?php echo $url['forget']?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail2" style="font-weight: bold;">New password:</label>
                                <input type="password" name="form[newPass]" class="form-control form-forget" id="exampleInputEmail2" placeholder="New password">
                                <div class="errorPass"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2" style="font-weight: bold;">Confirm new password:</label>
                                <input type="password" name="form[confirmPass]" class="form-control form-forget" id="exampleInputEmail" placeholder="Confirm new password">
                                <div class="errorConfirmPass"></div>
                            </div>
                            <button type="submit" class="btn btn-default changPass">Change</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script >
    var errorPassword = 0;
    var errorConfirmPass = 0;
    var currentPass = '';
    var currentConfirm = '';
    //xét password
    $("input[name='form[newPass]']").change(function () {
        if (currentConfirm !== '') {
            if ($(this).val() !== currentConfirm) {
                $(".errorConfirmPass").text('Các mật khẩu không khớp.thử lại?');
                errorConfirmPass = 0;
            } else {
                $(".errorConfirmPass").text('');
                errorConfirmPass = 1;
            }
        }
        if ($(this).val().length < 6) {
            $(".errorPass").text('Mật khẩu ít nhất 6 kí tự.thử lại?');
            currentPass = $(this).val();
            errorPassword = 0
        } else {
            $(".errorPass").text('')
            currentPass = $(this).val();
            errorPassword = 1;
        }

    });
    //xét confirmpassword
    $("input[name='form[confirmPass]']").change(function () {
        currentConfirm = $(this).val();
        if (currentPass !== currentConfirm) {
            $(".errorConfirmPass").text('Các mật khẩu không khớp.thử lại?');
            errorConfirmPass = 0;
        } else {
            $(".errorConfirmPass").text('');
            errorConfirmPass = 1;
        }


    });
    console.log(errorConfirmPass);
    $(".changPass").click(function (e) {
       if(errorPassword === 0 || errorConfirmPass ===   0){
            e.preventDefault();
        }
    });
</script>