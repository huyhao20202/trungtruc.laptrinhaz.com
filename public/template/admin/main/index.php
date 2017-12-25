<?php
$dirImg = $this->_dirImg;
?>
<!DOCTYPE html>
<html>
<head>

    <?php
    echo $this->_metaHTTP;
    echo $this->_metaName;
    echo $this->_fileCSS;
    echo $this->_fileJS
    ?>
    <title><?php echo $this->_title ?></title>
    <link rel="shortcut icon" href="<?php echo $dirImg . "/logo.ico" ?>"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script type="text/javascript">
        root_url =  <?php echo json_encode(ROOT_URL ."/")  ?>;
        const ROOT_URL = root_url;
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include_once 'html/header.php' ?>
    <!-- Left side column. contains the logo and sidebar -->

    <?php include_once 'html/mainSidebar.php' ?>
    <!-- Content Wrapper. Contains page content -->
    <?php require_once MODULE_PATH . DS . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
    <!-- /.content-wrapper -->
    <?php include_once 'html/footer.php' ?>
    <!-- Control Sidebar -->
    <?php include_once 'html/controlSidebar.php' ?>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
</body>
</html>
