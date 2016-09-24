<?php
$title = "My Tasks";
$db = new DB ();
$countView = 10;
if (isset ( $_GET ['page-tasks'] )) {
	$pageNum = ( int ) $_GET ['page-tasks'];
} else {
	$pageNum = 1;
}
$startIndex = ($pageNum - 1) * $countView;
$user = (isset ( $_SESSION ['user'] )) ? unserialize ( $_SESSION ['user'] ) : '';
$allResponsiblesRes = $db->select ( $db->connect (), 'tasks', "tasks.responsible_user_id = '$user->id'" );
if (isset ( $allResponsiblesRes [0] )) {
	$allResponsibles = $allResponsiblesRes;
} else {
	$allResponsibles [0] = $allResponsiblesRes;
}
$countAllResponsibles = count ( $allResponsibles );
for($i = 0; $i < $countAllResponsibles; $i ++) {
	$tasksData [] = $allResponsibles [$i];
}
if (isset ( $tasksData ) && ! empty ( $tasksData )) {
	$taskTools = new TaskTools ();
	$countTasks = count ( $tasksData );
	$lastPage = ceil ( $countTasks / $countView );
	$tasksDataPage = $taskTools->getTasks ( $db->connect (), $user->id, $startIndex, $countView );
	$userTools = new UserTools ();
	$countTasksPage = count ( $tasksDataPage );
	for($i = 0; $i < $countTasksPage; $i ++) {
		$coauthorsData = array ();
		$taskId = $tasksDataPage [$i] ['id'];
		$tasksСurrentUserCoauthor = $taskTools->getTasksСurrentUserCoauthor ( $db->connect (), $taskId );
		if (isset ( $tasksСurrentUserCoauthor [0] )) {
			$tasksDataPage [$i] ['coauthors'] = $tasksСurrentUserCoauthor;
		} else {
			$tasksDataPage [$i] ['coauthors'] [0] = $tasksСurrentUserCoauthor;
		}
		$responsibleData = $userTools->get ( $db->connect (), $tasksDataPage [$i] ['responsible_user_id'] );
		$tasksDataPage [$i] ['responsibleData'] = $responsibleData;
	}
}
$user = (isset ( $_SESSION ['user'] )) ? unserialize ( $_SESSION ['user'] ) : '';
$firstName = (isset ( $user->firstName ) && ($user->firstName !== '')) ? $user->firstName : 'Username';
if (isset ( $_GET ['id'] )) {
	$db->delete ( $db->connect (), 'tasks', 'id=' . $_GET ['id'] );
	$db->delete ( $db->connect (), 'coauthors', 'task_id=' . $_GET ['id'] );
	header ( 'Location:./index.php?controller=static&page=my-tasks' );
}