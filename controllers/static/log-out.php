<?php
$taskTools=new TaskTools();
$taskTools->logout;
$userTools=new UserTools();
$userTools->logout;
header('Location:./index.php?controller=static&page=authorization');