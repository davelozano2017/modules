<?php
require 'functions/functions.php';
all();
?>
<html>
<head>
	<title>Compiled Modules</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/costum.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<style type="text/css">
	#notif {background:#df6a6a !important;line-height: 10px;padding:2px;color:#fff;margin-left:5px;border-radius:5px;}
	</style>	
	<script type="text/javascript" src="js/sweetalert-dev.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>

</head>
<body>

	<div class="main-container">

		<div class="logo-container">
			<img src="images/logo.png">
		</div>

		<div class="nav-container">
			<ul>
				<li class="dropdown active"><a href="#">my account</a>
					<ul class="dropdown-content">
						<li><a href="general-information">general information</a></li>
						<li><a href="change-password">change password</a></li>
						<li><a href="change-profile">change profile</a></li>
						<li class="active"><a href="friend-request">friend request <label class="notif">0</label></a></li>
						<li><a href="member-logout">logout</a></li>
					</ul>
				</li>
				<li><a href="add-friend"><?php echo$_SESSION['counts']?></a></li>
				<li class="right"><a href="#"><img class="profile" src="<?php echo$_SESSION['photos']?>"><?php echo$_SESSION['firstname']?></a></li>
			</ul>
		</div>

	</div>

	<div class="body-container">

		<h1>Hi! I'm <?php echo$_SESSION['roles']?></h1>

	</div>

	<div class="footer">
		<p> Compiled Modules @ <?php echo date('Y')?> </p>
	</div>

</body>

<script src="js/jquery.min.js"></script>
<script src="js/ajax_refresh.js"></script>
<script src="js/parsleyjs/dist/parsley.min.js"></script>
</html>

