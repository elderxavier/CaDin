<?php
if(trim($_SERVER['HTTP_HOST']) == 'localhost'){
    $_CURDIR = 'faculdade/cadin';
}else{
    $_CURDIR = 'cadin';
}
$_URLSITE = $_CURURL = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . "/".$_CURDIR;
$_PAGETITLE = '';




