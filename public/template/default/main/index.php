<?php
$urlImage = $this->_dirImg;
$urlFile = TEMPLATE_URL . '/default/main';
if (MINIFIED_ALL_MEMBER == true)
    ob_start(); // Start output buffer capture.
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google font -->

    <?php
    echo $this->_metaHTTP;
    echo $this->_metaName;
    echo $this->_fileCSS;
    echo $this->_fileJquery
    ?>
    <meta property="fb:app_id" content="1937598989836489"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?php if (isset($this->course['name'])) echo $this->course['name'] ?>"/>
    <meta property="og:description"
          content="<?php if (isset($this->course['description'])) echo $this->course['description'] ?>"/>
    <meta property="og:image"
          content="<?php echo DOMAIN . $urlImage . "/thumbnail/" . $this->course['imageThumbnail'] ?>">

    <title><?php echo $this->_title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=vietnamese" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo $urlImage . "/logo.ico" ?>"/>
<!--    <script src='https://www.google.com/recaptcha/api.js'></script>-->

    <script type="text/javascript">
        root_url =  <?php echo json_encode(ROOT_URL . "/")  ?>;
        const ROOT_URL = root_url;

    </script>
    <script type="text/javascript">
        noticeOne =  <?php echo json_encode(NOTICE_USER_VIEW_VIDEO)  ?>;
        const NOTICE_USER_VIEW_VIDEO = noticeOne;
        noticeTwo = <?php echo json_encode(NOTICE_USER_FAVORITE_COURSE) ?>;
        const NOTICE_USER_FAVORITE_COURSE=noticeTwo;
        noticeThree = <?php echo json_encode(NOTICE_USER_REMOVE_FAVORITE_COURSE) ?>;
        const NOTICE_USER_REMOVE_FAVORITE_COURSE=noticeThree;

    </script>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

</head>
<body id="page-top" class="home">

<!-- PAGE WRAP -->
<div id="page-wrap">

    <!-- PRELOADER -->
    <?php include_once "html/preloader.php"; ?>
    <!-- END / PRELOADER -->

    <!-- HEADER -->
    <?php include_once "html/header.php"; ?>
    <!-- END / HEADER -->

    <?php
    if ($this->arrParam["controller"] == 'index' && $this->arrParam['action'] == "index") {
        echo '<!--HOME SLIDER-->';
        include_once "html/slider.php";
        echo '<!--END / HOME SLIDER-->';

        echo '<!-- AFTER SLIDER -->';
        include_once "html/after-slider.php";
        echo '<!-- END / AFTER SLIDER -->';

    } else if ($this->arrParam["controller"] == 'course' && $this->arrParam['action'] == "index") {
        echo '<!--SUB BANNER-->';
        include_once "html/sub-banner.php";
        echo '<!--END / SUB BANNER-->';
    }

    ?>



    <?php require_once MODULE_PATH . DS . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>

    <?php
    if ($this->arrParam["controller"] == 'index' && $this->arrParam['action'] == "index") {
        echo '<!-- BEFORE FOOTER -->';
        include_once "html/before-footer.php";
        echo '<!-- END / BEFORE FOOTER -->';
    }
    ?>


    <!-- FOOTER -->
    <?php include_once "html/footer.php"; ?>
    <!-- END / FOOTER -->

    <!--    -->
    <a class="back-to-top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
    <!--    -->

</div>
<!-- END / PAGE WRAP -->

<!--/google +-->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<!-- Load jQuery -->
<?php echo $this->_fileJS ?>

</body>
</html>
<?php
if (MINIFIED_ALL_MEMBER == true) {
    $output = ob_get_contents(); // This contains the output of yourtemplate.php
    ob_end_clean(); // Clear the buffer.
// Remove html comments
    $output = preg_replace('/<!--(.*?)-->/', '', $output);
//    $output = preg_replace('/\/\*(.*?)\*\//', '', $output);
// Merge multiple spaces into one space
    $output = preg_replace('/\s+/', ' ', $output);

// Remove space between tags. Skip the following if you want as it will also remove the space between <span>Hello</span> <span>World</span>.
    preg_replace('/>\s+</', '><', $output);
    echo $output;
}
?>