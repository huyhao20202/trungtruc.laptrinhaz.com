<?php
$listCourse = $this->listCourse;
$infoCategory = $this->infoCategory;
$url = [
    'home' => URL::createLink("default", 'index', 'index', null, 'trang-chu.html')
]
?>
<!-- SUB BANNER -->
<section class="sub-banner sub-banner-search">
    <div class="awe-parallax bg-section1-demo"></div>
    <div class="awe-overlay overlay-color-1"></div>
    <div class="container text-center">
        <div class="sub-banner-content-result">
            <h2><?php echo $infoCategory['name'] ?></h2>
        </div>
    </div>
</section>
<!-- END / SUB BANNER -->


<!-- PAGE CONTROL -->
<section class="page-control">
    <div class="container">
        <div class="page-info">
            <a href="<?php echo $url['home'] ?>"><i class="icon md-arrow-left"></i>Back to home</a>
        </div>
        <div class="page-view">
            View
            <span class="page-view-info view-grid active" title="View grid"><i class="icon md-ico-2"></i></span>
            <span class="page-view-info view-list" title="View list"><i class="icon md-ico-1"></i></span>
        </div>
    </div>
</section>
<!-- END / PAGE CONTROL -->


<!-- CATEGORIES CONTENT -->
<section id="categories-content" class="categories-content">
    <div class="container">
        <div class="content grid">
            <div class="row">
                <?php foreach ($listCourse as $value) {
                    $name_category = URL::filterURL($value['name_category']);
                    $id_category = $value['id_category'];
                    $name_course = URL::filterURL($value['name_course']);
                    $id_course = $value['id_course'];
                    $urlCourse = URL::createLink('default', 'course', 'index', array('id_course' => $id_course, 'id_category' => $id_category), "$name_category/$name_course-$id_category-$id_course.html");
                    ?>
                    <!-- ITEM -->
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="mc-item mc-item-2">
                            <div class="image-heading">
                                <img src="<?php echo $urlImage . "/course/" . $value['course_image'] ?>"
                                     alt="image course">
                            </div>
                            <div class="meta-categories"><a href="#">Web design</a></div>
                            <div class="content-item">
                                <div class="image-author">
                                    <img src="<?php echo $urlImage . "/author/" . $value['author_avatar'] ?>"
                                         alt="author avatar">
                                </div>
                                <h4>
                                    <a href="<?php echo $urlCourse ?>">
                                        <?php echo $value['name_course'] ?>
                                    </a>
                                </h4>
                                <div class="name-author">
                                    By <a href="#"><?php echo $value['name_author'] ?></a>
                                </div>
                            </div>
                            <div class="ft-item">
                                <div class="rating">
                                    <a href="#" class="active"></a>
                                    <a href="#" class="active"></a>
                                    <a href="#" class="active"></a>
                                    <a href="#"></a>
                                    <a href="#"></a>
                                </div>
                                <div class="view-info">
                                    <i class="icon md-users"></i>
                                    2568
                                </div>
                                <div class="comment-info">
                                    <i class="icon md-comment"></i>
                                    25
                                </div>
                                <div class="price">
                                    Free
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END / ITEM -->
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- END / CATEGORIES CONTENT -->