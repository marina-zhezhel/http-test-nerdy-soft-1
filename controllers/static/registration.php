<?php
$title = 'Registration';
$login = '';
$password = '';
$error = '';
if (isset ( $_POST ['submit'] )) {
	$login = $_POST ['login'];
	$password = $_POST ['password'];
	$firstName = $_POST ['first-name'];
	$lastName = $_POST ['last-name'];
	$success = true;
	$userTools = new UserTools ();
	$db = new DB ();
	if ($userTools->checkUsernameExists ( $db->connect (), $login )) {
		$error .= 'Login you entered already exists. Please enter a different email<br/>';
		$success = false;
	}
	if (!(filter_var($login, FILTER_VALIDATE_EMAIL))) {
		$error .= 'Invalid email. Please enter a valid email<br/>';
		$success = false;
	}
	if ($success) {
		$data ['login'] = $login;
		$data ['password'] = sha1 ( $password ) . sha1 ( $login );
		$data ['first_name'] = $firstName;
		$data ['last_name'] = $lastName;
		$newUser = new User ( $data );
		$newUser->save ( true );
		$userTools->login ( $db->connect (), $login, $data ['password'] );
		header ( 'Location:./index.php?controller=static&page=my-tasks' );
	}
}
$user = (isset ( $_SESSION ['user'] )) ? unserialize ( $_SESSION ['user'] ) : '';
$login = (isset ( $user->login )) ? $user->login : '';
