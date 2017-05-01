
										<?php if(empty($_SESSION["status"])) {
											header("location:login");
										}
										include "functions/config.php";
										$query = $db->query("UPDATE members_tbl SET status = 'Active' WHERE email ='lozanojohndavid@gmail.com'");
										?>
										<html>	
										<head>
										<title> Compiled Modules </title>
										<link rel="stylesheet" href="css/sweetalert.css">
										<script type="text/javascript" src="js/sweetalert-dev.js"></script>
										<script type="text/javascript" src="js/sweetalert.min.js"></script>
										</head>
										<body>
										<script type="text/javascript">
										swal({   
											title: "Success!",  
											text: "Your account is now active.",  
											timer: 4000, 
											type: "success",  
											showConfirmButton: false 
										});
									setTimeout("location.href = login ",2000);
									</script>
									<?php 
									unset($_SESSION["status"]);
									if (empty($_SESSION["status"])) {
										header("REFRESH:3;URL=login");
									}
									?>
									</body>
									</html>