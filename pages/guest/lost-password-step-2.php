<?php 
require 'functions/functions.php';
if (!isset($_SESSION['security_code'])) {
header('location:login');
}
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
		<?php retrieve_password_step_2()?>
		<div class="body-container">
			<div class="login-container">
				<form method="POST" data-parsley-validate>
					<label for="security_code">Security Code</label>
					<input type="text" autofocus name="security_code" required>
					<input value="<?php echo$_SESSION['security_code']?>" name="correct_security_code"  type="hidden">
					<input type="submit" name="btn-forgot-password-step-2" value="Validate">
				</form>
				<div class="links-container">
					<ul>
						<li><a href="create-account">create new account</a></li>
						<li class="active"><a href="lost-password-step-1">lost password</a></li>
						<li><a href="resend-email">resend email</a></li>
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
</html>