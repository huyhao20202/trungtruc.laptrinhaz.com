<?php

$listVideo = $this->video;
$listFavorite = $this->favoriteVideo;
$listCourseRelative = $this->listCourseRelative;
$infoCourse = $this->course;
//handle link course
$course[] = explode("https:", $infoCourse['course']);
unset($course[0][0]);
//end link course

$url = $_SERVER['REQUEST_URI'];
$nameAuthor = URL::filterURL($listVideo[0]['name_author']);
$authorID = URL::filterURL($listVideo[0]['author_id']);
$urlFindAuthor = URL::createLink('default', 'index', 'findAuthor', ['author' => $nameAuthor, 'author_id' => $authorID], "tac-gia-$nameAuthor/$authorID.html");
$flagFavorite = 0;
if (isset($listFavorite)) {
    foreach ($listFavorite as $value) {
        if ($value['id_course'] == $listVideo[0]['id_course']) {
            $flagFavorite = 1;
        }
    }
}

?>
<!-- COURSE -->
<section class="course-top">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="sidebar-course-intro">
                    <!-- CURRENT PROGRESS -->
                    <div class="current-progress">
                        <h4 class="sm black">Quá trình</h4>
                        <?php
                        $cookie = Cookie::get('view');
                        $countProcess = 0;
                        foreach ($cookie as $value) {
                            foreach ($this->video as $valueVideo) {
                                if ($value == "video-" . $valueVideo['video_id']) {
                                    $countProcess++;
                                }
                            }
                        }
                        $percent = $countProcess / count($this->video) * 100;
                        ?>

                        <div class="percent">Hoàn thành <span class="count"><?php echo round($percent, 0) ?>%</span>
                        </div>
                        <div class="progressbar">
                            <div class="progress-run"></div>
                        </div>
                        <ul class="current-outline">
                            <li><span><?php echo $countProcess . "/" . count($this->video) ?></span>Video</li>

                            <li class="favorite-course"><i
                                        class="fa <?php echo ($flagFavorite == 1) ? 'fa-heart' : 'fa-heart-o' ?>"
                                        aria-hidden="true"></i> Khóa học yêu thích
                            </li>
                        </ul>

                    </div>
                    <!-- END / CURRENT PROGRESS -->

                    <div class="video-course-intro">
                        <div class="video embed-responsive embed-responsive-16by9">
                            <iframe src="https://www.youtube.com/embed/<?php
                            if (isset($this->arrParam['id_video'])) {
                                foreach ($listVideo as $value) {
                                    if ($this->arrParam['id_video'] == $value['video_id']) {
                                        echo $value['link'];
                                    }
                                }
                            } else {
                                echo $listVideo[0]['link'];
                            } ?>"
                                    frameborder="0" allowfullscreen class="embed-responsive-item">
                            </iframe>
                        </div>
                    </div>
                    <div class="about-instructor">
                        <h4 class="xsm black bold">Tác giả</h4>
                        <ul>
                            <li>
                                <div class="image-instructor text-center">
                                    <img src="<?php echo $urlImage ?>/author/<?php echo $this->video[0]['author_avatar'] ?>"
                                         alt="">
                                </div>
                                <div class="info-instructor">
                                    <cite class="sm black">
                                        <a href="<?php echo $urlFindAuthor ?>">
                                            <?php echo $listVideo[0]['name_author'] ?>
                                        </a>
                                    </cite>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <hr class="line">
                    <div class="widget widget_tags">
                        <i class="icon md-download-2"></i>
                        <h4 class="xsm black bold">Tag</h4>
                        <div class="tagCould">
                            <form action="#" method="post" id="appFormTag">
                                <?php
                                $tag = explode(",", $this->video[0]['tag']);
                                foreach ($tag as $key => $valueTag) {
                                    $text = "tim-kiem-tag";
                                    $urlTag = URL::createLink('default', 'index', 'findTag', ['tag' => $valueTag], "$text-$valueTag.html");
                                    ?>
                                    <a href="<?php echo $urlTag ?>" class="bold" style="color: #37ABF2">
                                        <?php
                                        if ($key == count($tag) - 1)
                                            echo ucfirst($valueTag);
                                        else {
                                            echo ucfirst($valueTag) . ", ";
                                        }
                                        ?>
                                    </a>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                    <div class="widget widget_share">
                        <i class="icon md-forward"></i>
                        <h4 class="xsm black bold">Share course</h4>
                        <div class="share-body">
                            <div class="fb-save" data-uri="<?php echo DOMAIN . $url ?>" data-size="small"></div>
                            <div class="fb-like" data-href="<?php echo DOMAIN . $url ?>"
                                 data-layout="button_count" data-action="like" data-size="small"
                                 data-show-faces="true"
                                 data-share="true">
                            </div>
                            <span style="position: absolute; margin-left: 3px">
                                    <g:plusone size="medium"></g:plusone>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="tabs-page">
                    <ul class="nav-tabs" role="tablist">
                        <li class="active"><a href="#outline" role="tab" data-toggle="tab">Danh mục</a></li>
                        <li><a href="#announcement" role="tab" data-toggle="tab">Tài liệu</a></li>
                        <li class="itemnew"><a href="#discussion" role="tab" data-toggle="tab">Bình luận</a></li>
                        <li class="tab-student"><a href="#student" role="tab" data-toggle="tab">Học viên</a>
                        </li> <?php if (!empty($infoCourse['course'])) { ?>
                            <li class="course"><a href="#relate-course" role="tab" data-toggle="tab">Khóa học liên
                                    quan</a></li>
                        <?php } ?>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- OUTLINE -->
                        <div class="tab-pane fade in active" id="outline">

                            <!-- SECTION OUTLINE -->
                            <div class="section-outline">

                                <ul class="section-list">
                                    <?php
                                    foreach ($listVideo as $key => $infoVideo) {
                                        if (in_array("video-" . $infoVideo['video_id'], Cookie::get('view'))) {
                                            $active = "active";
                                            $check = ' md-check-2';

                                        } else {
                                            $active = "";
                                            $check = '';
                                        }
                                        ?>
                                        <li class="o-view <?php echo $active ?>">
                                            <div class="count <?php echo $active ?>"><span><?php echo $key + 1 ?></span>
                                            </div>
                                            <div class="list-body">
                                                <i class="icon md-camera"></i>
                                                <p><a href="#" class="name-video"
                                                      id="video-<?php echo $infoVideo['video_id'] ?>"
                                                      link="<?php echo $infoVideo['link'] ?>" data-toggle="modal"
                                                      data-target="#myModal"><?php echo $infoVideo['title'] ?></a>
                                                </p>
                                                <div class="download">
                                                    <div class="download-ct">
                                                        <span>Reference 12 mb</span>
                                                    </div>
                                                </div>
                                                <div class="div-x"><i class="icon<?php echo $check ?>"></i></div>
                                                <div class="line"></div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <!-- END / SECTION OUTLINE -->
                        </div>
                        <!-- END / OUTLINE -->

                        <!-- ANNOUNCEMENT -->
                        <div class="tab-pane fade" id="announcement">
                            <h4 class="sm black bold">Link Github:</h4>
                            <p><?php echo $infoCourse['sourse'] ?></p>
                        </div>
                        <!-- END / ANNOUNCEMENT -->

                        <!-- STUDENT -->
                        <div class="tab-pane fade" id="student">

                        </div>
                        <!-- END / STUDENT -->

                        <!-- DISCUSSION -->
                        <div class="tab-pane fade" id="discussion">
                            <div class="fb-comments"
                                 data-href="<?php echo DOMAIN . $url ?>"
                                 data-width="500" data-numposts="5">

                            </div>
                        </div>
                        <!-- END / DISCUSSION -->

                        <!-- Relate course -->
                        <div class="tab-pane fade" id="relate-course">
                            <ul class="list-announcement">
                                <li>
                                    <div class="list-body">
                                        <div class="list-content custom-list-content">
                                            <h4 class="sm black bold">
                                                <a href="#">Để nâng cao khả năng lập trình, bạn có thể tham khảo
                                                    khóa học nâng cao của Zendvn bên dưới.</a>
                                            </h4>
                                            <div class="author">Link Course: <?php foreach ($course as $value) {
                                                    foreach ($value as $valueOne) {
                                                        echo "<a target='_blank' href='https:" . $valueOne . "'>https:" . $valueOne . "</a><br/>";
                                                    }
                                                } ?></div>

                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                        <!-- END / Relate course -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #000000"></h4>
                </div>
                <div class="modal-body">
                    <div class="video-course-intro">
                        <div class="video embed-responsive embed-responsive-16by9">
                            <iframe src="https://www.youtube.com/embed/<?php echo $listVideo[0]['link']; ?>"

                                    frameborder="0" allowfullscreen class="embed-responsive-item">
                            </iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</section>
<!-- END / COURSE TOP -->

<!-- COURSE CONCERN -->
<?php echo Helper::cmsCategory($listCourseRelative) ?>
<!-- END / COURSE CONCERN-->

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=1937598989836489';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<?php
$session = Session::get('nameMenu');

?>
<script type="text/javascript">
    var nameOne = '<?php echo $listVideo[0]['name_course']; ?>';
    var idCourse = '<?php echo $listVideo[0]['id_course'] ?>';
    var infoUser = '<?php echo Session::get('user')['info']['id'] ?>';
    var nameMenu='<?php echo Session::get('nameMenu') ?>';

    $(function () {
        var session = '<?php echo $session?>';

        if (session !== '') {
            var activeDefault = $('.tabs-page .nav-tabs li')[0];
            $(activeDefault).removeClass("active");
            $('#outline').removeClass("active");
            $(session).addClass("active in");
            var active = "a[href=" + session + "]";
            $(active).parents('li').addClass("active");

            if ($('.nav-tabs').length) {
                $.each($('.nav-tabs'), function () {
                    var tabsItem = $(this).find('a'),
                        tabs = $(this),
                        leftActive = tabs.find('.active').children('a').position().left,
                        widthActive = tabs.find('.active').children('a').width();

                    $('.tabs-hr').css({
                        left: leftActive,
                        width: widthActive
                    });
                    tabsItem.on('click', function () {
                        var left = $(this).position().left,
                            width = $(this).width();
                        $('.tabs-hr').animate({
                            left: left,
                            width: width
                        }, 500, 'easeInOutExpo');
                    });
                });
            }

        }
    })
</script>