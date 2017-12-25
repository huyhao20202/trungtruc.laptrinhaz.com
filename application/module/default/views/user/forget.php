<?php
$url=[
  'forget'=> URL::createLink('default','index','forget',null,'forget-password.html')
];
?>

<section id="featured-request-teacher" class="featured-request-teacher section" style="color: #0b5fc6">
    <div class="awe-parallax "></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="request-featured">
                    <h1 class="big text-center">Xác nhận Email để khôi phục Password</h1>
                    <div class="form-forget">
                        <form action="<?php echo $url['forget']?>" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail2" style="font-weight: bold;">Email xác nhận:</label>
                                <input type="email" name="form[forget]" class="form-control form-forget" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                                <div class="errEmail"><?php echo $this->emailExist?></div>
                            </div>
                            <button type="submit" class="btn btn-default">Send</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
