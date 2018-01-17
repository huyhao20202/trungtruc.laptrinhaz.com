<?php
$listCategory = $this->listCategory;

?>

<!-- SECTION 1 -->
<section id="mc-section-1" class="mc-section-1 section">
    <div class="container">
        <div class="row">

            <div class="col-md-5">
                <div class="mc-section-1-content-1">
                    <h2 class="big">Học lập trình miễn phí tại ZendVN</h2>
                    <p class="mc-text">
                        Bên cạnh các khóa học có phí thì ZendVN còn cung cấp cho các bạn đam mê học lập trình các khóa
                        học miễn phí với chất lượng tương đương các khóa học có phí.
                    </p>
                    <a href="https://zendvn.com/" target="_blank" class="mc-btn btn-style-1">Thông tin chúng tôi</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-offset-1">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="featured-item">
                            <i class="icon icon-featured-1"></i>
                            <h4 class="title-box text-uppercase">Dễ dàng và tiện lợi</h4>
                            <p>
                                Học online tại nhà đang là xu thế, bạn có thể ở bất cứ đâu và bất kì thời điểm nào.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="featured-item">
                            <i class="icon icon-featured-2"></i>
                            <h4 class="title-box text-uppercase">Chất lượng đảm bảo</h4>
                            <p>
                                Khóa học miễn phí nhưng chất lượng có phí.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="featured-item">
                            <i class="icon icon-featured-3"></i>
                            <h4 class="title-box text-uppercase">Hỗ trợ tận tình</h4>
                            <p>
                                Group facebook lập trình ZendVn hỗ trợ bạn 24/7 khi bạn gặp khó khăn.
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="featured-item">
                            <i class="icon icon-featured-4"></i>
                            <h4 class="title-box text-uppercase">Ủng hộ chúng tôi</h4>
                            <p>
                                Nếu các bạn muốn học sâu hơn về lập trình hãy mua những khóa học có phí của chúng tôi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- END / SECTION 1 -->


<!-- SECTION 2 -->
<section id="mc-section-2" class="mc-section-2 section">
    <div class="awe-parallax bg-section1-demo"></div>
    <div class="overlay-color-1"></div>
    <div class="container">
        <div class="section-2-content">
            <div class="row">

                <div class="col-md-5">
                    <div class="ct">
                        <h2 class="big">Vì sao tất cả chúng ta đều nên học lập trình?</h2>
                        <p class="mc-text">
                            Trong một thế giới số hóa ngày càng mạnh mẽ, sở hữu một số kỹ năng công nghệ, đặc biệt là
                            lập trình, có thể là tấm vé để bạn đến được với những cơ hội tốt hơn trong công việc.
                        </p>
                        <a href="#mc-section-3" class="mc-btn btn-style-3">Bắt đầu học</a>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="image">
                        <img src="<?php echo $urlImage ?>/image.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- END / SECTION 2 -->


<!-- SECTION 3 -->
<section id="mc-section-3" class="mc-section-3 section">
    <a name="mc-section-3"></a>
    <div class="container">
        <!-- FEATURE -->
        <?php echo Helper::cmsCategory($listCategory) ?>
        <!-- END / FEATURE -->
    </div>
</section>
<!-- END / SECTION 3 -->