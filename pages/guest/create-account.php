<?php 
include 'functions/functions.php';
include 'botdetect.php';

$_SESSION['activation_code'] = CreateActivationCode();
?>
<html>
<head>
	<title>Compiled Modules</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<script type="text/javascript" src="js/sweetalert-dev.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<style type="text/css">.BDC_CaptchaDiv{width:100% !important;}</style>
    <link type="text/css" rel="Stylesheet" href="<?php echo CaptchaUrls::LayoutStylesheetUrl() ?>" />
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
		<?php register()?>
		<div class="body-container">
			<div class="login-container">
				<form method="POST" data-parsley-validate>
					<label for="surname">surname *</label>
					<input type="text" class="alphabets" name="surname"  autofocus required>

					<label for="firstname">firstname *</label>
					<input type="text" class="alphabets" name="firstname" required>

					<label for="middlename">middlename *</label>
					<input type="text" class="alphabets" name="middlename" required>

					<label for="email">email *</label>
					<input type="email" name="email" required>

					<label for="gender">Gender *</label>
					<select name="gender">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>

					<label for="contact">contact *</label>
					<input type="number" minlength=11 maxlength=11 name="contact" required>

					<label for="role">role *</label>
					<select name="role">
						<option value='0'>Super Admin</option>
						<option value='1'>Admin</option>
						<option value='2'>Members</option>
					</select>

					<label for="username">username *</label>
					<input type="text" name="username" required>

					<label for="password">password *</label>
					<input type="password" id="password" minlength=8 name="password" required>

					<label for="confirmpassword">confirm password *</label>
					<input type="password" data-parsley-equalto="#password" name="confirmpassword" required>

                    <label for="captcha">captcha *</label>
					
					<?php // Adding BotDetect Captcha to the page
                      $DynamicCaptcha = new Captcha("DynamicCaptcha");
                      $DynamicCaptcha->UserInputID = "CaptchaCode";
                      echo $DynamicCaptcha->Html();
                    ?>    

                    <input name="CaptchaCode" type="text" id="CaptchaCode" required />

                    <input type="hidden" name="activation_code" value="<?php echo'$2y$10'.$_SESSION['activation_code']?>">
					
					<input type="submit" name="btn-register" value="Register">
				</form>

				<div class="links-container">
					<ul>
						<li class="active"><a href="create-account">create  new account</a></li>
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
<script src="js/jquery.min.js"></script>
<script src="js/parsleyjs/dist/parsley.min.js"></script>
<script src="js/alphabet-validate.js"></script>
<script type="text/javascript">
 $('.alphabets').keypress(function (e) {
        var regex = new RegExp("^[a-zA-Z ]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        else
        {
        e.preventDefault();
        return false;
        }
    });
    </script>
</html>