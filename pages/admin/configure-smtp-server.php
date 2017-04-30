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
				<li class="dropdown active"><a href="#">Settings</a>
					<ul class="dropdown-content">
						<li class="active"><a href="configure-smtp-server">configure smtp server</a></li>
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
		<?php add_smtp_config() ?>
		<div class="body-container">
			<div class="login-container">
				<form method="POST" data-parsley-validate>
					<label for="socket">smtp socket *</label>
					<select name="socket" required="required" >
                      <?php
                      $query = $db->query("SELECT socket FROM socket_tbl");
                      while ($row = $query->fetch_object()){
                      echo '<option value="'.$row->socket.'">'.$row->socket.'</option>';
                      }
                      ?>
                    </select>

					<label for="security">smtp security *</label>
					<select name="security" required="required" >
                      <?php
                      $query = $db->query("SELECT security FROM security_tbl");
                      while ($row = $query->fetch_object()){
                      echo '<option value="'.$row->security.'">'.$row->security.'</option>';
                      }
                      ?>
                    </select>

					<label for="smtpemail">smtp username *</label>
					<input type="email" name="email" required>

					<label for="smtppassword">smtp password *</label>
					<input type="password"  name="password" id="password" required>

					<label for="smtpconfirmpassword">smtp confirm password *</label>
					<input type="password" data-parsley-equalto="#password" name="password" required>


					<label for="from">smtp from *</label>
					<input type="text" name="from" required>

					<input type="submit" name="btn-save" value="save">
				</form>
			</div>
		</div>

		<div class="footer">
			<p> Compiled Modules @ <?php echo date('Y')?> </p>
		</div>

</body>
<script src="js/jquery.min.js"></script>
<script src="js/parsleyjs/dist/parsley.min.js"></script>
</html>
