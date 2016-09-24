<?php
$title = "Add Task";
$id = '';
$name = '';
$description = '';
$responsibleId = '';
$coauthorsId = '';
$error = '';
$db = new DB ();
$taskTools = new TaskTools ();
$userTools = new UserTools ();
if (isset ( $_POST ['submit'] )) {
	$success = true;
	$id = $_POST ['id'];
	$name = $_POST ['name'];
	$description = $_POST ['description'];
	$responsibleId = $_POST ['responsible-id'];
	$coauthorsId = $_POST ['coauthors-id'];
	$data ['name'] = $name;
	$data ['description'] = $description;
	$task = new Task ( $data );
	if ($taskTools->checkIdExists ( $db->connect (), $id )) {
		$taskTools->taskActiveSession ( $db->connect (), $id );
		$id = $task->save ( false, $responsibleId, $coauthorsId );
	} else {
		$id = $task->save ( true, $responsibleId, $coauthorsId );
	}
	
	$taskTools->taskActiveSession ( $db->connect (), $id );
	header ( 'Location:./index.php?controller=static&page=my-tasks' );
}
$allUsers = $userTools->getAllUsers ( $db->connect () );
$countAllUsers = count ( $allUsers );
$taskActive = (isset ( $_SESSION ['taskActive'] )) ? unserialize ( $_SESSION ['taskActive'] ) : '';
$user = (isset ( $_SESSION ['user'] )) ? unserialize ( $_SESSION ['user'] ) : '';
$firstName = (isset ( $user->firstName ) && ($user->firstName !== '')) ? $user->firstName : 'Username';
if (isset ( $_GET ['id'] )) {
	$valueTaskId = $_GET ['id'];
	$taskData = $taskTools->getTask ( $db->connect (), $valueTaskId );
	$countTaskData = count ( $taskData );	
		$coauthorsData = array ();
		$taskId = $taskData ['id'];
		$allCoauthorsRes = $taskTools->getCoauthors($db->connect (), $taskId);
		if (isset($allCoauthorsRes[0])){
			$allCoauthors = $allCoauthorsRes;
		} else {
			$allCoauthors[0] = $allCoauthorsRes;
		}
		$countAllCoauthors = count($allCoauthors);
		for ($i=0; $i<$countAllCoauthors; $i++) {
			$coauthorsData [] = $allCoauthors[$i];
		}
		$taskData ['coauthors'] = $coauthorsData;
		if (isset($taskData ['coauthors'])) {
			$countTaskCoauthors = count($taskData ['coauthors']);
		}
} else {
	$valueTaskId = 0;
}