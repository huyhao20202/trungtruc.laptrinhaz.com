<!DOCTYPE html>
<html>
<head>
    <title><?php echo $this->_title ?></title>
    <?php
    echo $this->_metaHTTP;
    echo $this->_metaName;
    echo $this->_fileCSS;
    ?>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">
<!-- login box -->
<?php require_once MODULE_PATH . DS . $this->_moduleName . DS . 'views' . DS . $this->_fileView . '.php'; ?>
<!-- /.login-box -->

<?php echo $this->_fileJS; ?>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script
</body>
</html>
