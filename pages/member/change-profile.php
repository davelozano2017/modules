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
				<li class="dropdown"><a href="#">my account</a>
					<ul class="dropdown-content">
						<li><a href="general-information">general information</a></li>
						<li><a href="change-password">change password</a></li>
						<li class="active"><a href="change-profile">change profile</a></li>
						<li><a href="friend-request">friend request <label class="notif">0</label></a></li>
						<li><a href="docs-upload">Upload Documents</a></li>
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
			<?php change_profile() ?>
			<form method="POST" enctype="multipart/form-data" name="changeprofile"> 
				
				<input type="hidden" name="id" value="<?php echo$_SESSION['user']?>">

				<img class="profile-picture" src="<?php echo$_SESSION['photos']?>">

				<input class="file"  id="file" type="file" name="image" multiple onchange="sub(this)"/></div>

			</form>
		</div>
	</div>

	<div class="footer">
		<p> Compiled Modules @ <?php echo date('Y')?> </p>
	</div>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/uploadfile.js" type="text/javascript"></script>
</html>
