<?php
require_once 'define.php';

function __autoload($className)
{
    require_once LIBRARY_PATH . DS . "{$className}.php";
}

Session::init();
//Session::destroy();
$bootstrap = new Bootstrap();
