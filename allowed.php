<?php
$allowedController=array('static','errors');
$allowed=array('authorization','registration','404', 'my-tasks', 'add-task', 'log-out');
if (!isset ($_GET['controller'])) {
	$_GET['controller']='static';
} elseif (!in_array($_GET['controller'], $allowedController)) {
	header('Location: ./index.php?controller=errors&page=404');
	exit();
}
if (!isset ($_GET['page'])) {
	$_GET['page']='authorization';
} elseif (!in_array($_GET['page'], $allowed)) {
	header('Location: ./index.php?controller=errors&page=404');
	exit();
}