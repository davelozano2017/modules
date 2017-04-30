<?php
require 'functions/functions.php';
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
				<li><a href="login">login</a></li>
				<li class="active"><a href="list-of-members"><?php echo$_SESSION['counts_guest']?></a></li>
			</ul>
		</div>

	</div>

	<div class="body-container">

		<?php view_members()?>

	</div>

	<div class="footer">
		<p> Compiled Modules @ <?php echo date('Y')?> </p>
	</div>

</body>

<script src="js/jquery.min.js"></script>
<script src="js/ajax_refresh.js"></script>
<script src="js/parsleyjs/dist/parsley.min.js"></script>
</html>

