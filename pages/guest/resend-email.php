<?php 
include 'functions/functions.php';
?>
<html>
<head>
	<title>Compiled Modules</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
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
				<li><a href="list-of-members"><?php echo$_SESSION['counts_guest']?></a></li>
			</ul>
		</div>

	</div>


	<?php resend_email(); ?>
		<div class="body-container">
			<div class="login-container">
				<form method="POST" data-parsley-validate>
					<label for="email">email</label>
					<input type="email" autofocus name="email" required>
					<input type="submit" name="btn-send" value="send">
				</form>
				<div class="links-container">
					<ul>
						<li><a href="create-account">create new account</a></li>
						<li><a href="lost-password-step-1">lost password</a></li>
						<li class="active"><a href="resend-email">resend email</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer">
			<p> Compiled Modules @ <?php echo date('Y')?> </p>
		</div>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/parsleyjs/dist/parsley.min.js"></script>
<script src="js/alphabet-validate.js"></script>
</html>