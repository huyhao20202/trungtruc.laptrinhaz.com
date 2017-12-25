<?php
$userInfo =Session::get("user")['info'];
$url = [
    'profile' => URL::createLink('admin', 'user', 'profile'),
    'logout' => URL::createLink('admin', 'index', 'logout'),
    'view-site' => URL::createLink('default', 'index', 'index',null,'trang-chu.html')
];
?>

<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Zend</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Zend</b>VN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo $url['view-site'] ?>" target="_blank">View Site</a></li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $dirImg ?>/no-avatar.png" class="user-image">
                        <span class="hidden-xs"><?php echo $userInfo['username'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p>
                                <?php echo $userInfo['username'] ?>
                            </p>
                            <p>
                                <?php echo $userInfo['fullname'] ?>
                            </p>
                            <p>
                                <?php echo $userInfo['email'] ?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo $url['profile'] ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo $url['logout'] ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>