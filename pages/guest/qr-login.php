<?php
require 'functions/functions.php';
?>
<html>
<head>
	<title>Compiled Modules</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<script type="text/javascript" src="js/sweetalert-dev.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<style type="text/css">#v{width:100%;}#qr-canvas {display: none;}</style>
</head>
<body>

	<div class="main-container">

		<div class="logo-container">
			<img src="images/logo.png">
		</div>

		<div class="nav-container">
			<ul>
				<li class="active"><a href="login">login</a></li>
				<li><a href="list-of-members"><?php echo$_SESSION['counts_guest']?></a></li>
			</ul>
		</div>

	</div>



<div id="mainbody"></div>
		<div class="body-container">
			<div class="login-container">

				<?php qr_login() ?>
				<form method="POST" data-parsley-validate>
					<div id="qr-container">
						<div id="outdiv"></div>
					</div>
						
						<input type="text" name="username" id="results" required>

				</form>
				<div class="links-container">
					<ul>
						<li><a href="create-account">create  new account</a></li>
						<li><a href="lost-password-step-1">lost password</a></li>
						<li><a href="resend-email">resend email</a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="footer">
			<p> Compiled Modules @ <?php echo date('Y')?> </p>
		</div>

</body>
<script src="js/llqrcode.js"></script>
<script src="js/webqr.js"></script>
<canvas id="qr-canvas"></canvas>
<div id="result" style="visibility: hidden;"></div>
<img class="selector" id="webcamimg" onclick="setwebcam()" align="left" />
<img class="selector" id="qrimg"  onclick="setimg()" align="right"/>
<script src="js/jquery.min.js"></script>
<script src="js/parsleyjs/dist/parsley.min.js"></script>
<script>load();</script>
<script>
var lastValue = '';
setInterval(function() {
    if ($("#results").val() != lastValue) {
        lastValue = $("#results").val();
        $("form").submit();
    }
}, 500)
</script>
</body>
</html>
