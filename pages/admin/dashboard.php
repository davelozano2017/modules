<?php include 'functions/admin-session.php';?>
<html>
<head>
	<title>Compiled Modules</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

	<div class="main-container">

		<div class="logo-container">
			<img src="images/logo.png">
		</div>

		<div class="nav-container">
			<ul>
				<li class="active"><a href="dashboard">dashboard</a></li>
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

				<li class="dropdown"><a href="#">manage records</a>
					<ul class="dropdown-content">
						<li><a href="manage-smtp-account">smtp accounts</a></li>
						<li><a href="manage-accounts">accounts</a></li>
					</ul>
				</li>
				<li><a href="admin-logout">logout</a></li>
			</ul>
		</div>

	</div>

		<div class="body-container">
			<h1>Hi! I'm <?php echo$roles?></h1>
		</div>

		<div class="footer">
			<p> Compiled Modules @ <?php echo date('Y')?> </p>
		</div>

</body>
</html>
