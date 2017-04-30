<?php 
include 'functions/functions.php';
if(!isset($_SESSION['admin'])){
header("Location: login");
}
$query 	= $db->query("SELECT * FROM members_tbl WHERE id = ".$_SESSION['admin']." ");
$row 	= $query->fetch_object();
$role 	= $row->role;
switch ($role) {
	case 0:
	$roles = 'Super Admin';
	break;
	
	case 1:
	$roles = 'Admin';
	break;
	
	default:
	# code...
	break;
}
?>