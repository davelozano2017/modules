<?php
include '../../functions/config.php';
global $db;

			if(isset($_POST['btn-add-friend'])) {
				$r_name = $db->real_escape_string($_POST['name']);
				$_SESSION['message'] = 'Please <a href="login" class="clean">Login</a> your account 
				before you add '.$r_name.' as your friend.';
				$message = $_SESSION['message'];

				echo '<div class="notification">'.$message.'</div>';
				unset($_SESSION['message']);
			}

			$query = $db->query("SELECT * FROM members_tbl WHERE role = 2");
			$check = $query->num_rows;
			if ($check < 1) {
				echo '<div class="notification">No result found.</div>';
			} else {
				while ($row = $query->fetch_object()) {
					$photos = $row->photos;
					$username = $row->username;
					$name 	= $row->firstname . ' ' .$row->surname;

					echo 
					'
					<div class="container">
					<div class="member-container">

					<img class="image" src="'.$photos.'">
					<p class="caption"><a class="clean" href="'.$username.'">'.$name.'</a></p>
					
					<form method="POST">
					<input type="hidden" name="name" value="'.$name.'">
					<input class="btn-add-friend" type="submit" name="btn-add-friend" value="Add Friend">
					</form>
					</div>

					<div class="clear"></div>
					</div>
					';
				}
			} 
?>