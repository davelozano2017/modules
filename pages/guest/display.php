<?php include 'functions/functions.php';
global $db;

$query = $db->query("SELECT * FROM members_tbl WHERE role = 2");
$check = $query->num_rows;
if ($check < 1) {
	echo '<div class="notification">No result found.</div>';
} else {
	while ($row = $query->fetch_object()) {
		$photos = $row->photos;
		$name 	= $row->firstname . ' ' .$row->surname;

		echo 
		'
		<div class="container">
		<div class="member-container">

		<img class="image" src="'.$photos.'">
		<p class="caption">'.$name.'</p>
		
		<form method="POST">
		<input class="btn-add-friend" type="submit" name="btn-add-friend" value="Add Friend">
		</form>
		</div>

		<div class="clear"></div>
		</div>
		';
	}
}
?>

