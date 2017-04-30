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
						<li class="active"><a href="general-information">general information</a></li>
						<li><a href="change-password">change password</a></li>
						<li><a href="change-profile">change profile</a></li>
						<li><a href="friend-request">friend request <label class="notif">0</label></a></li>
						<li><a href="member-logout">logout</a></li>
					</ul>
				</li>
				<li><a href="add-friend"><?php echo$_SESSION['counts']?></a></li>
				<li class="right"><a href="#"><img class="profile" src="<?php echo$_SESSION['photos']?>"><?php echo$_SESSION['firstname']?></a></li>
			</ul>
		</div>

	</div>

	<div class="body-container">
		<div class="login-container">
			<?php update_record()?>
			<form method="POST" data-parsley-validate> 
				
				<input type="hidden" name="id" value="<?php echo$_SESSION['user']?>">
				
				<label for="surname">surname *</label>
				<input type="text" class="alphabets" name="surname" value="<?php echo$_SESSION['surname']?>"  autofocus required>

				<label for="firstname">firstname *</label>
				<input type="text" class="alphabets" name="firstname" value="<?php echo$_SESSION['firstname']?>" required>

				<label for="middlename">middlename *</label>
				<input type="text" class="alphabets" name="middlename" value="<?php echo$_SESSION['middlename']?>" required>

				<label for="email">email *</label>
				<input type="email" name="email" value="<?php echo$_SESSION['email']?>" required>

				<label for="gender">Gender *</label>
				<select name="gender">
					<option value="<?php echo$_SESSION['gender']?>" selected><?php echo$_SESSION['gender']?></option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>

				<label for="contact">contact *</label>
				<input type="number" minlength=11 maxlength=11 name="contact" value="<?php echo$_SESSION['contact']?>" required>

				<input type="submit" name="btn-update" value="update">

			</form>
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
	} else {
		e.preventDefault();
		return false;
	}
});
</script>
</html>
