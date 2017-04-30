<?php include 'functions/admin-session.php';?>
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
				<li><a href="dashboard">dashboard</a></li>
				<li class="dropdown"><a href="#">Settings</a>
					<ul class="dropdown-content">
						<li><a href="configure-smtp-server">configure smtp server</a></li>
						<li><a href="#">manage priveledges</a></li>
						<li><a href="#">theme options</a></li>
						<li><a href="export-database">export database</a></li>
					</ul>
				</li>

				<li class="dropdown"><a href="#">master list</a>
					<ul class="dropdown-content">
						<li><a href="add-socket">add socket</a></li>
						<li><a href="add-security">add security</a></li>
					</ul>
				</li>

				<li class="dropdown active"><a href="#">manage records</a>
					<ul class="dropdown-content">
						<li class="active"><a href="manage-smtp-account">smtp accounts</a></li>
						<li><a href="manage-accounts">accounts</a></li>
					</ul>
				</li>
				
				<li><a href="admin-logout">logout</a></li>
			</ul>
		</div>

	</div>
	
		<div class="body-container">
			<div class="smtp-table">
				<table>
					<th>Socket</th>
					<th>Security</th>
					<th>username</th>
					<th>status</th>
					<th>action</th>
					<?php show_smtp_accounts() ?>
				</table>
			</div>
		</div>

		<div class="footer">
			<p> Compiled Modules @ <?php echo date('Y')?> </p>
		</div>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/parsleyjs/dist/parsley.min.js"></script>
</html>
