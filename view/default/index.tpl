<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" ; charset="UTF-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title><?php echo @$title; ?></title>
<link href="./view/<?php echo Config::$view ?>/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="./view/<?php echo Config::$view ?>/css/test-nerdy-soft-1.css">
 <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>	
	<?php 
	if (($_SERVER['QUERY_STRING']!=='controller=static&page=authorization')&&($_SERVER['QUERY_STRING']!=='controller=static&page=registration')&&($_SERVER['QUERY_STRING']!=='controller=errors&page=404')){
?>
<div class="container">
	<nav role="navigation" class="navbar navbar-default switch-pages">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target="#navbarCollapse">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="logo"><a
					href="./index.php?controller=static&page=my-tasks"><img
						src="./view/<?php echo Config::$view ?>/img/logo.jpeg"></a></li>
				<li class="menu-li"><a
					href="./index.php?controller=static&page=my-tasks">Menu1</a></li>
				<li class="menu-li"><a
					href="./index.php?controller=static&page=my-tasks">Menu2</a></li>
				<li class="menu-li"><a
					href="./index.php?controller=static&page=my-tasks">Menu3</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">


				<li class="dropdown"><a href="#"
					class="dropdown-toggle menu-avatar" data-toggle="dropdown"> <?php
					echo $firstName;
				?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="./index.php?controller=static&page=log-out">Log
								Out</a></li>
					</ul></li>
			</ul>
		</div>
	</nav>
</div>
<?php }
	include $_GET['controller'].'/'.$_GET['page'].'.tpl';
	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="./view/<?php echo Config::$view ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript"
	src="./view/<?php echo Config::$view ?>/js/test-nerdy-soft-1.js"></script>
</body>
</html>