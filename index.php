<?php
error_reporting (E_ALL);
ini_set('display_errors',true);
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
ini_set('track_errors', 1);
header ( 'Content-Type:text/html; charset=utf-8' );
session_set_cookie_params(1800, '/', null, isset($_SERVER['HTTPS']), true);
session_start ();
include_once './Config.php';
include_once './autoload.php';
include_once './allowed.php';

if(!isset($_SESSION['loggedIn'])) {
	if (($_SERVER['QUERY_STRING']!=='controller=static&page=authorization')&&($_SERVER['QUERY_STRING']!=='controller=static&page=registration')&&($_SERVER['QUERY_STRING']!=='controller=errors&page=404')){
		header('Location:./index.php?controller=static&page=authorization');
	}
}
include './controllers/'.$_GET['controller'].'/'.$_GET['page'].'.php';
include './view/'.Config::$view.'/index.tpl';