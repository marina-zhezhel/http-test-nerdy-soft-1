<?php
class TaskTools {
	public function taskActiveSession($dbcon, $id) {
		$db = new DB ();
		$result = $db->select ( $dbcon, 'tasks', "id = $id" );
		if (isset ( $result ['id'] )) {
			$_SESSION ['taskActive'] = serialize ( new Task ( $result ) );
			$_SESSION ['isTask'] = 1;
			return true;
		} else {
			return false;
		}
	}
	public function logout() {
		unset ( $_SESSION ['taskActive'] );
		unset ( $_SESSION ['isTask'] );
	}
	public function checkIdExists($dbcon, $id) {
		$db = new DB ();
		$result = $db->selectField ( $dbcon, 'id', 'tasks', "id = $id" );
		if (! isset ( $result ['id'] )) {
			return false;
		} else {
			return true;
		}
	}
	public function get($dbcon, $id) {
		$db = new DB ();
		$result = $db->select ( $dbcon, 'tasks', "id = '$id'" );
		return new Task ( $result );
	}
	public function getTask($dbcon, $id) {
		$db = new DB ();
		$result = $db->select ( $dbcon, 'tasks', "id = '$id'" );
		return $result;
	}
	public function getCoauthors($dbcon, $taskId) {
		$db = new DB ();
		$result = $db->select ( $dbcon, 'coauthors', "task_id=$taskId" );
		return $result;
	}
	public function getTasksСurrentUserCoauthor($dbcon, $taskId) {
		$db = new DB ();
		$result = $db->select ( $dbcon, 'users, coauthors', "users.id=coauthors.user_id AND coauthors.task_id=$taskId" );
		return $result;
	}
	public function getTasks($dbcon, $userId, $startIndex, $countView) {
		$db = new DB ();
		$sql = mysqli_query ( $db->connect (), "(SELECT tasks.id, tasks.name, tasks.description, tasks.date_added, tasks.responsible_user_id, users.login, users.first_name, users.last_name FROM `users`, `tasks` WHERE users.id=$userId AND tasks.responsible_user_id=$userId) UNION (SELECT tasks.id, tasks.name, tasks.description, tasks.date_added, tasks.responsible_user_id, users.login, users.first_name, users.last_name FROM `users`, `tasks`, `coauthors` WHERE users.id=$userId AND coauthors.user_id=$userId AND tasks.id=coauthors.task_id) ORDER BY date_added DESC LIMIT $startIndex, $countView" );
		$result = array ();
		while ( $result1 = mysqli_fetch_array ( $sql, MYSQLI_ASSOC ) ) {
			$result [] = $result1;
		}
		return $result;
	}
}