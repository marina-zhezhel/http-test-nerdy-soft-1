<?php
class UserTools {
	public function login($dbcon, $login, $hashedPassword) {
		$result = mysqli_query ( $dbcon, "SELECT * FROM users WHERE login = '$login' AND 
password = '$hashedPassword'" );
		if (mysqli_num_rows ( $result ) == 1) {
			$_SESSION ['user'] = serialize ( new User ( mysqli_fetch_assoc ( $result ) ) );
			$_SESSION ['loginTime'] = time ();
			$_SESSION ['loggedIn'] = 1;
			return true;
		} else {
			return false;
		}
	}
	public function logout() {
		unset ( $_SESSION ['user'] );
		unset ( $_SESSION ['loginTime'] );
		unset ( $_SESSION ['loggedIn'] );
		session_destroy ();
	}
	public function checkUsernameExists($dbcon, $login) {
		$result = mysqli_query ( $dbcon, "select id from users where login='$login'" );
		if (mysqli_num_rows ( $result ) == 0) {
			return false;
		} else {
			return true;
		}
	}
	public function get($dbcon, $id) {
		$db = new DB ();
		$result = $db->select ( $dbcon, 'users', "id = $id" );
		return new User ( $result );
	}
	public function getAllUsers($dbcon) {
		$db = new DB ();
		$result = $db->selectTable ( $dbcon, 'users' );
		return $result;
	}
}