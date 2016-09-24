<?php
$title = 'Authorization';
$error = '';
$login = '';
$password = '';
if (isset ( $_POST ['submit'] )) {
	$login = $_POST ['login'];
	$password = $_POST ['password'];
	$hashPassword = sha1 ( $password ) . sha1 ( $login );
	$userTools = new UserTools ();
	$db = new DB ();
	if ($userTools->login ( $db->connect (), $login, $hashPassword )) {
		header ( 'Location:./index.php?controller=static&page=my-tasks' );
	} else {
		$error = 'You entered an incorrect username or password';
	}
}
$user = (isset($_SESSION ['user']))? unserialize( $_SESSION ['user'] ):'';
$login=(isset($user->login))?$user->login:'';