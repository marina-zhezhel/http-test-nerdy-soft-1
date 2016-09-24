<?php
class User {
	public $id;
	public $login;
	public $hashedPassword;
	public $firstName;
	public $lastName;
	function __construct($data) {
		$this->id = (isset ( $data ['id'] )) ? $data ['id'] : "";
		$this->login = (isset ( $data ['login'] )) ? $data ['login'] : "";
		$this->hashedPassword = (isset ( $data ['password'] )) ? $data ['password'] : "";
		$this->firstName = (isset ( $data ['first_name'] )) ? $data ['first_name'] : "";
		$this->lastName = (isset ( $data ['last_name'] )) ? $data ['last_name'] : "";
	}
	public function save($isNewUser = false) {
		$db = new DB ();
		$data = array (
				"login" => "'$this->login'",
				"password" => "'$this->hashedPassword'",
				"first_name" => "'$this->firstName'",
				"last_name" => "'$this->lastName'" 
		);
		if (! $isNewUser) {
			$db->update ( $db->connect (), $data, 'users', 'id=' . $this->id );
		} else {
			$this->id = $db->insert ( $db->connect (), $data, 'users' );
		}
		return true;
	}
}
?>