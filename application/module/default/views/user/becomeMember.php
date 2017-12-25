
<section id="featured-request-teacher" class="featured-request-teacher section" style="color: #0b5fc6">
    <div class="awe-parallax "></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="request-featured">
                    <h1 class="big text-center">Hoàn tất việc đăng kí tài khoản</h1>
                    <div class="create-course-info-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="create-course-info">
                                    <span class="count">1</span>
                                    <p>Đăng kí tài khoản</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="create-course-info">
                                    <span class="count">2</span>
                                    <p>Xác nhận qua email</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="create-course-info">
                                    <?php if(isset($this->arrParam['userId'])) {
                                        echo '<span class="count">3</span>';
                                    }else{
                                        echo '<span class="count class3">3</span>';
                                    }
                                    ?>
                                    <p>Hoàn tất đăng kí</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>