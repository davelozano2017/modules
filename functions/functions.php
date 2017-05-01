<?php
include 'functions/config.php';


function CreateActivationCode() {
	$chars = "a1A2b3Bc4C5d6D7e8E9f0F1g2G3h4H5i6I7j8J9k1K2l3L4m5M6n7N8o9OpPqQrRsStTuUvVwWxXyYzZ1234567890";
	srand((double)microtime()*1000000);
	$i = 0;
	$code = '' ;
	while ($i <= 60) {
		$num = rand() % 33;
		$tmp = substr($chars, $num, 1);
		$code = $code . $tmp;
		$i++;

	}
	return $code;
}

function login() {
	global $db;
	if (isset($_SESSION['user'])!=""){
		header('location: general-information');
	} elseif (isset($_SESSION['admin'])!=""){
		header('location: dashboard');
	}

	if(isset($_POST['btn-login'])) {
		$username 		= $db->real_escape_string($_POST['username']);
		$password 		= $db->real_escape_string($_POST['password']);
		$query 			= $db->query("SELECT * FROM members_tbl WHERE username = '$username' AND status = 'Active'");
		$check 			= $query->num_rows;
		if($check<1) {
			?>
			<script type="text/javascript">
			swal({   
				title: "Error!",  
				text: "Your account is not activated or you've entered invalid username or password.",
				timer: 6000, 
				type: 'error',  
				showConfirmButton: false 
			});
			</script>
			<?php
		} else {
			$row 			= $query->fetch_object();
			$id 			= $row->id;
			$role 			= $row->role;
			$status 		= $row->status;
			$password_hash 	= $row->password_hash;

			$hash = $password_hash;
			if (password_verify($password, $hash) && $role == 0) {
				$_SESSION['admin'] = $id;
				header("Location: dashboard");
			} elseif (password_verify($password, $hash) && $role == 1) {
				$_SESSION['admin'] = $id;
				header("Location: dashboard");
			} elseif (password_verify($password, $hash) && $role == 2) {
				$_SESSION['user'] = $id;
				header("Location: general-information");
			} else {
				?>
				<script type="text/javascript">
				swal({   
					title: "Error!",  
					text: "Your account is not activated or you've entered invalid username or password.",
					timer: 6000, 
					type: 'error',  
					showConfirmButton: false 
				});
				</script>
				<?php
			}
		} 
	}
}

function qr_login() {
	global $db;
	if (isset($_SESSION['user'])!=""){
		header('location: general-information');
	} elseif (isset($_SESSION['admin'])!=""){
		header('location: dashboard');
	}

	if(isset($_POST['username'])) {
		$username 		= $db->real_escape_string($_POST['username']);
		$query 			= $db->query("SELECT * FROM members_tbl WHERE username = '$username' AND status = 'Active'");
		$check 			= $query->num_rows;
		if($check<1) {
			?>
			<script type="text/javascript">
			swal({   
				title: "Error!",  
				text: "Your account is not activated or you've entered invalid username or password.",
				timer: 6000, 
				type: 'error',  
				showConfirmButton: false 
			});
			</script>
			<?php
		} else {
			$row 			= $query->fetch_object();
			$id 			= $row->id;
			$role 			= $row->role;
			$status 		= $row->status;

			if ($username && $role == 0) {
				$_SESSION['admin'] = $id;
				header("Location: dashboard");
			} elseif ($username && $role == 1) {
				$_SESSION['admin'] = $id;
				header("Location: dashboard");
			} elseif ($username && $role == 2) {
				$_SESSION['user'] = $id;
				header("Location: general-information");
			} else {
				?>
				<script type="text/javascript">
				swal({   
					title: "Error!",  
					text: "Your account is not activated or you've entered invalid username or password.",
					timer: 6000, 
					type: 'error',  
					showConfirmButton: false 
				});
				</script>
				<?php
			}
		} 
	}
}

function register() {
	global $db;
	include 'PHPMailerAutoload.php';
	if (isset($_POST['btn-register'])) {
		$DynamicCaptcha = new Captcha("DynamicCaptcha");
		$DynamicCaptcha->UserInputID = "CaptchaCode";
		$isHuman = $DynamicCaptcha->Validate();
		if (!$isHuman) {
			?>
			<script type="text/javascript">
			swal({   
				title: "Error!",  
				text: "Invalid captcha code.",  
				timer: 4000, 
				type: "error",  
				showConfirmButton: false 
			});
			</script>
			<?php
		} else {

			
			$surname 		= $db->real_escape_string($_POST['surname']);
			$firstname 		= $db->real_escape_string($_POST['firstname']);
			$middlename 	= $db->real_escape_string($_POST['middlename']);
			$email 			= $db->real_escape_string($_POST['email']);
			$gender 		= $db->real_escape_string($_POST['gender']);
			$contact 		= $db->real_escape_string($_POST['contact']);
			$role 			= $db->real_escape_string($_POST['role']);
			$username 		= $db->real_escape_string($_POST['username']);
			$password 		= $db->real_escape_string($_POST['password']);
			$code 			= $db->real_escape_string($_POST['activation_code']);
			$password_hash	= password_hash($password, PASSWORD_DEFAULT);
			$security_code	= rand(111111,999999);
			$activation 	= md5(uniqid(rand(), true));
			$status			= 'Not Active';
			switch ($gender) {
				case 'Male':
				$photos = 'uploads/default_male.jpg';
				break;

				case 'Female':
				$photos = 'uploads/default_female.jpg';
				break;
				
				default:
				break;
			}
			/*
			$query = $db->query("INSERT INTO members_tbl  
			(photos, surname, firstname, middlename, 
			 email, gender, contact, username, 
			 password, password_hash, security_code, 
			 role, status) 
			VALUES 
			('$photos','$surname', '$firstname', '$middlename', 
			 '$email', '$gender', '$contact', '$username', 
			 '$password', '$password_hash', '$security_code', 
			 '$role', '$status')");


				?>
				<script type="text/javascript">
				swal({   
					title: "Success!",  
					text: "You have successfully registered. Please activation your account.",  
					timer: 4000, 
					type: "success",  
					showConfirmButton: false 
				});
				</script>
				<?php
				*/
				$check 			= $db->query("SELECT * FROM members_tbl WHERE email = '$email'");
				$checkrow 		= $check->num_rows;
				if($checkrow > 0) {
					?>
					<script type="text/javascript">
					swal({   
						title: "Error!",  
						text: "The email address you have entered is existed. Please try another email address.",  
						timer: 4000, 
						type: "error",  
						showConfirmButton: false 
					});
					</script>
					<?php

				} else {
					$SMTP_query			= $db->query("SELECT * FROM smtp_server_tbl WHERE smtp_status = 0");
					$SMTP_check			= $SMTP_query->num_rows;
					if($SMTP_check < 1) {
						?>
						<script type="text/javascript">
						swal({   
							title: "Error!",  
							text: "Please configure SMTP server.",  
							timer: 4000, 
							type: "error",  
							showConfirmButton: false 
						});
						</script>
						<?php	


					} else {

					$level = 'H';
					$size = 5;
					$PNG_WEB_DIR = 'pages/guest/temp/';
					include "pages/guest/lib/qrlib.php";    
					if (!file_exists('pages/guest/temp/'))
						mkdir('pages/guest/temp/');
						$errorCorrectionLevel = 'L';
						if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
							$errorCorrectionLevel = $_REQUEST['level'];  
						$matrixPointSize = 4;
						if (isset($_REQUEST['size']))
							$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
						if (isset($username)) { 
						if (trim($username) == '')
						die('data cannot be empty! <a href="?">back</a>');
						$filename = 'pages/guest/temp/'.$username.'.png';
						QRcode::png($username, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
						} else {    
							QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
						}  

						$SMTP_row 		= $SMTP_query->fetch_object();
						$SMTP_socket	= $SMTP_row->smtp_socket;
						$SMTP_security	= $SMTP_row->smtp_security;
						$SMTP_email		= $SMTP_row->smtp_email;
						$SMTP_password	= $SMTP_row->smtp_password;
						$SMTP_from		= $SMTP_row->smtp_from;
						$mailer = new PHPMailer();
						$mailer->IsSMTP();
						$mailer->Host = $SMTP_socket;
						$mailer->SMTPAuth = TRUE;
						$mailer->SMTPSecure = $SMTP_security; 
						$mailer->IsHTML(true);
						$mailer->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
						$mailer->Username = $SMTP_email; 
						$mailer->Password = $SMTP_password; 
						$mailer->From = $SMTP_from; 
						$mailer->AddEmbeddedImage($filename, $username, $username);
						$mailer->FromName = 'Modules - Activate your account.';
						$mailer->Body =  
						'
						<div style="width:500px;margin:auto;padding:10px">
						<br>	    
						<h4 style="text-align:center">
						<a href="http://localhost/modules/'.$code.'"  style="margin:auto;text-align:center;text-decoration:none;border:#eee solid 1px;background:#336699;color:#fff;padding:20px;font-weight:bolder">CLICK ME TO ACTIVATE YOUR ACCOUNT</a>
						</h4>
						<br>
						<h4 style="text-align:center;margin:auto">
						This is your Qr Code. You can use it to login your account.
						<img style="width:250px"height:250px" alt="Qr Code" src="cid:'.$username.'">
						</h4>
						</div>    
						';
						$mailer->Subject = 'Modules - Activate your account.';
						$mailer->AddAddress($email);
						if(!$mailer->send()) {
							echo 'Message could not be sent.';
							echo 'Mailer Error: ' . $mailer->ErrorInfo;
						} else {
							$query = $db->query("INSERT INTO members_tbl  
								(photos, surname, firstname, middlename, 
									email, gender, contact, username, 
									password_hash, security_code, 
									role, status) 
							VALUES 
							('$photos','$surname', '$firstname', '$middlename', 
								'$email', '$gender', '$contact', '$username', 
								'$password_hash', '$security_code', 
								'$role', '$status')");
								?>
								<script type="text/javascript">
								swal({   
									title: "Success!",  
									text: "You have successfully registered. Please activation your account.",  
									timer: 4000, 
									type: "success",  
									showConfirmButton: false 
								});
								
								</script>
								<?php
								$case_link 	 = $code;
								$reqire_link = 'pages/generated/'.$username.'.php';
								$link = $db->query("INSERT INTO generated_tbl (email,case_link,require_link) VALUES ('$email','$case_link','$reqire_link')");

								$_SESSION['status'] = $activation;
								if($link) {
									$login = 'login';
									$id = '"$id"';
									$c = "'";
									$stats = 'Active';
									$fp=fopen('pages/generated/'.$username.'.php','w');
									fwrite($fp,'
										<?php if(empty($_SESSION["status"])) {
											header("location:login");
										}
										include "functions/config.php";
										$query = $db->query("UPDATE members_tbl SET status = '.$c.''.$stats.''.$c.' WHERE email ='.$c.''.$email.''.$c.'");
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
									setTimeout("location.href = '.$login.' ",2000);
									</script>
									<?php 
									unset($_SESSION["status"]);
									if (empty($_SESSION["status"])) {
										header("REFRESH:3;URL=login");
									}
									?>
									</body>
									</html>');
								fclose($fp);
							}
						}
					}
				}
			}
		}
	}

function resend_email() {
	global $db;
	include 'PHPMailerAutoload.php';
	if (isset($_POST['btn-send'])) {
		$email 		=  $db->real_escape_string($_POST['email']);
		$query 		=  $db->query("SELECT * FROM members_tbl where email='$email'");
		$check 		= $query->num_rows;
		if($check<1) {
			?>
			<script type="text/javascript">
			swal({   
				title: "Error!",  
				text: "Email not found!",
				timer: 6000, 
				type: 'error',  
				showConfirmButton: false 
			});
			</script>
			<?php
		} else {
			$row 		=  $query->fetch_object();
			$status 	=  $row->status;
			if($email 	!= $row->email){
				?>
				<script type="text/JavaScript">
				swal({   
					title: "Error!",
					text: 'Email not found!',  
					timer: 4000, 
					type: "error",  
					showConfirmButton: false 
				});
				</script>
				<?php 
			} elseif($status == 'Activated'){ 
				?>
				<script type="text/JavaScript">
				swal({   
					title: "Error!",
					text: 'This account is already active.',  
					timer: 4000, 
					type: "error",  
					showConfirmButton: false 
				});
				</script>
				<?php 
			} else {
				$SMTP_query			= $db->query("SELECT * FROM smtp_server_tbl WHERE smtp_status = 0");
				$SMTP_check			= $SMTP_query->num_rows;
				if($SMTP_check < 1) {
					?>
					<script type="text/javascript">
					swal({   
						title: "Error!",  
						text: "Please configure SMTP server.",  
						timer: 4000, 
						type: "error",  
						showConfirmButton: false 
					});
					</script>
					<?php	
				} else {
					$SMTP_row 		= $SMTP_query->fetch_object();
					$SMTP_socket	= $SMTP_row->smtp_socket;
					$SMTP_security	= $SMTP_row->smtp_security;
					$SMTP_email		= $SMTP_row->smtp_email;
					$SMTP_password	= $SMTP_row->smtp_password;
					$SMTP_from		= $SMTP_row->smtp_from;
					$_SESSION['status'] = $status;
					$query 		= $db->query("SELECT * FROM generated_tbl where email='$email'");
					$rows 		= $query->fetch_object();
					$case_link	= $rows->case_link;
					$mailer = new PHPMailer();
					$mailer->IsSMTP();
					$mailer->Host = $SMTP_socket;
					$mailer->SMTPAuth = TRUE;
					$mailer->SMTPSecure = $SMTP_security; 
					$mailer->IsHTML(true);
					$mailer->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
					$mailer->Username = $SMTP_email; 
					$mailer->Password = $SMTP_password; 
					$mailer->From = $SMTP_from; 
					$mailer->FromName = 'Modules - Activate your account.';
					$mailer->Body =  
					'
					<div style="width:500px;margin:auto;padding:10px">

					<br>	    
					<h4 style="text-align:center">
					<a href="http://localhost/modules/'.$case_link.'"  style="margin:auto;text-align:center;text-decoration:none;border:#eee solid 1px;background:#336699;color:#fff;padding:20px;font-weight:bolder">CLICK ME TO ACTIVATE YOUR ACCOUNT</a>
					</h4>
					<br>

					</div>   
					';
					$mailer->Subject = 'Modules - Activate your account.';
					$mailer->AddAddress($email);
					if(!$mailer->send()) {
						echo 'Message could not be sent.';
						echo 'Mailer Error: ' . $mailer->ErrorInfo;
					} else {
						?>
						<script type="text/JavaScript">
						swal({   
							title: "Success!",
							text: 'Email has been sent!',  
							timer: 4000, 
							type: "success",  
							showConfirmButton: false 
						});
						setTimeout("location.href = 'resend-email'",2000);
						</script>
						<?php 
					}
				}
			}
		}
	}
}


function retrieve_password_step_1() {
	global $db;
	include 'PHPMailerAutoload.php';
	if(isset($_POST['btn-forgot-password-step-1'])) {
		$email 		= $db->real_escape_string($_POST['email']);
		$query 		= $db->query("SELECT * FROM members_tbl where email='$email'");
		$check 		= $query->num_rows;
		if($check<1) {
			?>
			<script type="text/javascript">
			swal({   
				title: "Error!",  
				text: "Email not found!",
				timer: 6000, 
				type: 'error',  
				showConfirmButton: false 
			});
			</script>
			<?php
		} else {
			$row 			=  $query->fetch_object();
			$username 		= $row->username;
			$security_code 	= $row->security_code;

			if($email != $row->email){
				?>
				<script type="text/JavaScript">
				swal({   
					title: "Error!",
					text: 'Email not found.',  
					timer: 4000, 
					type: "error",  
					showConfirmButton: false 
				});
				</script>
				<?php 
			} else {
				$SMTP_query			= $db->query("SELECT * FROM smtp_server_tbl WHERE smtp_status = 0");
				$SMTP_check			= $SMTP_query->num_rows;
				if($SMTP_check < 1) {
					?>
					<script type="text/javascript">
					swal({   
						title: "Error!",  
						text: "Please configure SMTP server.",  
						timer: 4000, 
						type: "error",  
						showConfirmButton: false 
					});
					</script>
					<?php	
				} else {
					$SMTP_row 		= $SMTP_query->fetch_object();
					$SMTP_socket	= $SMTP_row->smtp_socket;
					$SMTP_security	= $SMTP_row->smtp_security;
					$SMTP_email		= $SMTP_row->smtp_email;
					$SMTP_password	= $SMTP_row->smtp_password;
					$SMTP_from		= $SMTP_row->smtp_from;
					$_SESSION['security_code'] = $security_code;
					$mailer = new PHPMailer();
					$mailer->IsSMTP();
					$mailer->Host = $SMTP_socket;
					$mailer->SMTPAuth = TRUE;
					$mailer->SMTPSecure = $SMTP_security; 
					$mailer->IsHTML(true);
					$mailer->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
					$mailer->Username = $SMTP_email; 
					$mailer->Password = $SMTP_password; 
					$mailer->From = $SMTP_from; 
					$mailer->FromName = 'Modules - Recover Your Account.';

					$mailer->Body =  
					'
					<div style="width:500px;background:#eee;border:1px #ccc solid;margin:auto;padding:10px">

					<h3 style="font-weight:bolder;text-align:center;text-transform:uppercase">Password Reset Instructions</h3>
					<div style="clear:both"></div>

					<h4 style="text-align:justify">Someone requested that the password be reset for the following account:</h4>
					<div style="clear:both"></div>

					<h4 style="text-align:justify">Username : <strong>'.$username.'</strong></h4>
					<div style="clear:both"></div>

					<h4 style="text-align:justify">Email Address : <strong>'.$email.'</strong></h4>
					<div style="clear:both"></div>

					<h4 style="text-align:justify">If this was a mistake, just ignore this email and nothing will happen.</h4>
					<div style="clear:both"></div>

					<h4 style="text-align:justify">To reset your password, click the link and copy and paste this :</h4>
					<div style="clear:both"></div>

					<h4 style="text-align:justify">Security Code : '.$_SESSION['security_code'].'</h4>
					<div style="clear:both"></div>

					<h4 style="text-align:justify"><a href="http://localhost/modules/lost-password-step-2" style="text-decoration:none">Click here to reset your password</a></h4>

					</div>


					';
					$mailer->Subject = 'Modules - Recover Your Account.';
					$mailer->AddAddress($email);
					if(!$mailer->send()) {
						?>
						<script type="text/JavaScript">
						swal({   
							title: "Email could not be sent!!", 
							text: "Please check your internet connection.", 
							timer: 4000, 
							type: "error",  
							showConfirmButton: false 
						});
						</script>
						<?php 
					} else {
						?>
						<script type="text/JavaScript">
						swal({   
							title: "Success!",
							text: 'Email has been sent!',  
							timer: 4000, 
							type: "success",  
							showConfirmButton: false 
						});
						</script>
						<?php 	
					}
				}
			}
		}
	}
}

function retrieve_password_step_2() {
	global $db;
	if(isset($_POST['btn-forgot-password-step-2'])) {
		$security_code 			= $db->real_escape_string($_POST['security_code']);
		$correct_security_code 	= $db->real_escape_string($_POST['correct_security_code']);
		if ($security_code != $correct_security_code){
			?>
			<script type="text/JavaScript">
			swal({   
				title: "Error!",
				text: 'Invalid Security Code.',  
				timer: 4000, 
				type: "error",  
				showConfirmButton: false 
			});
			</script>
			<?php 
		} else {

			unset($_SESSION['security_code']);
			$_SESSION['correct_security_code'] = $security_code;
			header('location: lost-password-step-3');
		}
	}
}

function retrieve_password_step_3() {
	global $db;
	if(isset($_POST['btn-forgot-password-step-3'])) {
		$security_code 			= $db->real_escape_string($_POST['security_code']); // stored in session
		$correct_security_code 	= $db->real_escape_string($_POST['correct_security_code']); // generated by function
		$password 				= $db->real_escape_string($_POST['password']);
		$hash 					= $password;
		$password_hash 			= password_hash($hash, PASSWORD_DEFAULT);
		$query 	= $db->query("SELECT * FROM members_tbl WHERE security_code = '$correct_security_code'");
		$row 	= $query->fetch_object();
		$id 	= $row->id;

		$query 	= $db->query("UPDATE members_tbl SET password_hash = '$password_hash', 
			security_code = '$security_code' WHERE id = '$id'");
		unset($_SESSION['correct_security_code']);
		?>
		<script type="text/JavaScript">
		swal({   
			title: "Success!",
			text: 'Your account is now recovered.',  
			timer: 4000, 
			type: "success",  
			showConfirmButton: false 
		});
		setTimeout("location.href = 'login'",2000);
		</script>
		<?php 
	}
}

function add_socket() {
	global $db;
	if (isset($_POST['btn-add-socket'])) {
		$socket = $db->real_escape_string($_POST['socket']);
		$query 	= $db->query("SELECT * FROM socket_tbl WHERE socket = '$socket'");
		$check 	= $query->num_rows;
		if($check > 0) {
			?>
			<script type="text/JavaScript">
			swal({   
				title: "Error!",
				text: 'Socket already exist.',  
				timer: 4000, 
				type: "error",  
				showConfirmButton: false 
			});
			</script>
			<?php 	
		} else {
			$query = $db->query("INSERT INTO socket_tbl (socket) VALUES ('$socket')");
			?>
			<script type="text/JavaScript">
			swal({   
				title: "Success!",
				text: 'Successfully added.',  
				timer: 4000, 
				type: "success",  
				showConfirmButton: false 
			});
			</script>
			<?php 
		}
	}
}
function add_security() {
	global $db;
	if (isset($_POST['btn-add-security'])) {
		$security 	= $db->real_escape_string($_POST['security']);
		$query 		= $db->query("SELECT * FROM security_tbl WHERE security = '$security'");
		$check 		= $query->num_rows;
		if($check > 0) {
			?>
			<script type="text/JavaScript">
			swal({   
				title: "Error!",
				text: 'security already exist.',  
				timer: 4000, 
				type: "error",  
				showConfirmButton: false 
			});
			</script>
			<?php 	
		} else {
			$query = $db->query("INSERT INTO security_tbl (security) VALUES ('$security')");
			?>
			<script type="text/JavaScript">
			swal({   
				title: "Success!",
				text: 'Successfully added.',  
				timer: 4000, 
				type: "success",  
				showConfirmButton: false 
			});
			</script>
			<?php 
		}
	}
}

function add_smtp_config() {
	global $db;
	if(isset($_POST['btn-save'])) {
		$socket 	= $db->real_escape_string($_POST['socket']);
		$security 	= $db->real_escape_string($_POST['security']);
		$email 		= $db->real_escape_string($_POST['email']);
		$password 	= $db->real_escape_string($_POST['password']);
		$from 		= $db->real_escape_string($_POST['from']);
		$query 		= $db->query("SELECT * FROM smtp_server_tbl WHERE smtp_email = '$email'");
		$check 		= $query->num_rows;
		if($check > 0) {
			?>
			<script type="text/JavaScript">
			swal({   
				title: "Error!",
				text: 'smtp account already exist.',  
				timer: 4000, 
				type: "error",  
				showConfirmButton: false 
			});
			</script>
			<?php 
		} else {
			$query	= $db->query("INSERT INTO smtp_server_tbl
				(smtp_socket, smtp_security, smtp_email, 
					smtp_password,smtp_from,smtp_status) VALUES 
			('$socket', '$security', '$email',
				'$password', '$from',1)");
				?>
				<script type="text/JavaScript">
				swal({   
					title: "Success!",
					text: 'Successfully added smtp account.',  
					timer: 4000, 
					type: "success",  
					showConfirmButton: false 
				});
				</script>
				<?php 
			}
		}
	}

	function show_smtp_accounts() {
		global $db;
		$query = $db->query("SELECT * FROM smtp_server_tbl");
		$check = $query->num_rows;
		if($check < 1) {
			echo 
			'
			<tr>
			<td colspan=7>No result found.</td>
			</tr>
			';
		} else {
			while ($row = $query->fetch_object()) {
				switch ($row->smtp_status) {
					case 0:
					$status = 'Activated';
					break;

					case 1:
					$status = 'Deactivated';
					break;

					default:
					# code...
					break;
				}
				echo 
				'
				<tr>
				<td>'.$row->smtp_socket.'</td>
				<td>'.$row->smtp_security.'</td>
				<td>'.$row->smtp_email.'</td>
				<td>'.$status.'</td>
				<td>
				<form method="POST">
				<input type="hidden" name="id" value="'.$row->id.'">
				<input type="submit" name="btn-modify" value="Modify">
				</form>
				</td>
				</tr>
				';
			}

			if(isset($_POST['btn-modify'])) {
				$modify_id = $db->real_escape_string($_POST['id']);
				$_SESSION['modify_id'] = $modify_id;
				header('location: modify-smtp-account');
			}
		}
	}

	function smtp_account_modify() {
		global $db;

		if(isset($_POST['btn-update'])) {
			$id = $db->real_escape_string($_POST['id']);
			$socket = $db->real_escape_string($_POST['socket']);
			$security = $db->real_escape_string($_POST['security']);
			$email = $db->real_escape_string($_POST['email']);
			$password = $db->real_escape_string($_POST['password']);
			$from = $db->real_escape_string($_POST['from']);
			$status = $db->real_escape_string($_POST['status']);
			$query = $db->query("UPDATE smtp_server_tbl SET smtp_status =1");
			$query = $db->query("UPDATE  smtp_server_tbl SET 
				smtp_socket = '$socket', smtp_security = '$security', 
				smtp_email 	= '$email', smtp_password  = '$password',
				smtp_from 	= '$from', smtp_status = '$status' WHERE id = '$id'");
				?>
				<script type="text/JavaScript">
				swal({   
					title: "Success!",
					text: 'SMTP account has been updated.',  
					timer: 4000, 
					type: "success",  
					showConfirmButton: false 
				});
				</script>
				<?php 	
				header('REFRESH:2;URL=manage-smtp-account');

			}

			if(isset($_POST['btn-delete'])) {
				$id = $db->real_escape_string($_POST['id']);
				$query = $db->query("DELETE FROM smtp_server_tbl WHERE id = '$id'");
				?>
				<script type="text/JavaScript">
				swal({   
					title: "Success!",
					text: 'SMTP account has been deleted.',  
					timer: 4000, 
					type: "success",  
					showConfirmButton: false 
				});
				</script>
				<?php 	
				header('REFRESH:2;URL=manage-smtp-account');
			}

		}


		function view_members() {

			global $db;

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
					<p class="caption"><a class="clean" title="view profile?" href="'.$username.'">'.$name.'</a></p>
					</div>

					<div class="clear"></div>
					</div>
					';
				}
			} 
		}

		function add_members() {
			global $db;
			$query = $db->query("SELECT * FROM members_tbl WHERE role = 2 AND id != ".$_SESSION['user']);
			$check = $query->num_rows;
			if ($check < 1) {
				echo '<div class="notification">No result found.</div>';
			} else {
				while ($row 	 = $query->fetch_object()) {
					$photos 	 = $row->photos;
					$username = $row->username;
					$name 	 = $row->firstname . ' ' .$row->surname;

					echo 
					'
					<div class="container">
					<div class="member-container">

					<img class="image" src="'.$photos.'">
					<p class="caption"><a class="clean" href="'.$username.'">'.$name.'</a></p>
					
					<form method="POST">
					<input type="hidden" name="name" value="'.$name.'">
					'?>

					<input class="btn-add-friend"  type="submit" name="btn-add-friend" value="add friend">
					
					<?php echo 
					'
					</form>
					</div>

					<div class="clear"></div>
					</div>
					';
				}
			} 
		}


		function member_logout() {
			include 'functions/config.php';
			unset($_SESSION['user']); 
			unset($_SESSION['surname']); 
			unset($_SESSION['firstname']); 
			unset($_SESSION['middlename']); 
			unset($_SESSION['email']); 
			unset($_SESSION['gender']); 
			unset($_SESSION['contact']); 
			unset($_SESSION['user']); 
			header('location: login');
		}

		function admin_logout() {
			include 'functions/config.php';
			unset($_SESSION['admin']); 
			header('location: login');
		}


		function member_count() {
			global $db;
			$query 	= $db->query("SELECT * FROM members_tbl WHERE role = 2");
			$var 	= $query->num_rows;
			$handle = $var;
			$count 	= number_format($handle, 0, '.' ,',');
			$_SESSION['count'] = $count;
		}


		function all() {
			if(!isset($_SESSION['user'])){
				header("Location: login");
			}
			global $db;
			$query 					= $db->query("SELECT * FROM members_tbl WHERE id = ".$_SESSION['user']."");
			$row 					= $query->fetch_object();
			$_SESSION['photos'] 	= $row->photos;
			$_SESSION['surname'] 	= $row->surname;
			$_SESSION['firstname'] 	= $row->firstname;
			$_SESSION['middlename'] = $row->middlename;
			$_SESSION['email']		= $row->email;
			$_SESSION['gender'] 	= $row->gender;
			$_SESSION['contact'] 	= $row->contact;
			$role 					= $row->role;
			if($role == 2) {
				$_SESSION['roles'] 		= 'member';
			}
			$query 	= $db->query("SELECT * FROM members_tbl WHERE role = 2 AND id != ".$_SESSION['user']);
			$var 	= $query->num_rows;
			$handle = $var;
			$count 	= number_format($handle, 0, '.' ,',');
			if($count <= 1) {
				$_SESSION['counts'] = 'Member ('.$count.')';
			} else {
				$_SESSION['counts'] = 'Members ('.$count.')';
			}
		}

		function all_guest() {
			global $db;
			$query 	= $db->query("SELECT * FROM members_tbl WHERE role = 2");
			$var 	= $query->num_rows;
			$handle = $var;
			$count 	= number_format($handle, 0, '.' ,',');
			if($count <= 1) {
				$_SESSION['counts_guest'] = 'Member ('.$count.')';
			} else {
				$_SESSION['counts_guest'] = 'Members ('.$count.')';
			}
		}

		function change_password() {

			global $db;
			if (isset($_POST['btn-update'])) {
				$id = $db->real_escape_string($_POST['id']);
				$password = $db->real_escape_string($_POST['password']);
				$password_hash 	= password_hash($password, PASSWORD_DEFAULT);
				$query = $db->query("UPDATE members_tbl SET password_hash = '$password_hash' WHERE id = '$id'");
				?>
				<script type="text/javascript">
				swal({   
					title: "Success!",  
					timer: '2000',
					text: "Your password has been changed.",
					type: 'success',  
					showConfirmButton: false 
				});
				</script>
				<?php
			}
		}

		function update_record() {

			global $db;
			if(isset($_POST['btn-update'])) {
				$id 		= $db->real_escape_string($_POST['id']);
				$surname 	= $db->real_escape_string($_POST['surname']);
				$firstname 	= $db->real_escape_string($_POST['firstname']);
				$middlename = $db->real_escape_string($_POST['middlename']);
				$email 		= $db->real_escape_string($_POST['email']);
				$gender 	= $db->real_escape_string($_POST['gender']);
				$contact 	= $db->real_escape_string($_POST['contact']);

				$query 		= $db->query("UPDATE members_tbl SET
					surname 	 = '$surname', 	  firstname = '$firstname',
					middlename = '$middlename', email  	= '$email',
					gender 	 = '$gender', 	  contact 	= '$contact' 
					WHERE id = '$id'");
					?>	
					<script type="text/JavaScript">
					swal({   
						title: "Success!",
						text: 'Your information has been updated.',  
						timer: 4000, 
						type: "success",  
						showConfirmButton: false 
					});
					setTimeout("location.href = 'general-information'",2000);
					</script>
					<?php 
				}
			}

			function change_profile() {
				global $db;
				if (isset($_FILES['image']['tmp_name'])) {
					$file		= $_FILES['image'][	'tmp_name'];
					$image		= addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$image_name	= addslashes($_FILES['image']['name']);
					move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" .$_FILES["image"]["name"]);
					$id 		= $db->real_escape_string($_POST['id']);
					$photos 	= $db->real_escape_string("uploads/" .$_FILES["image"]["name"]);
					$query 		= $db->query("UPDATE members_tbl SET photos = '$photos' WHERE id = '$id'");
					header('location:change-profile');
				}
			}

			function upload_documents() {
				global $db;
				if (isset($_FILES['image']['tmp_name'])) {
					$file		= $_FILES['image'][	'tmp_name'];
					$image		= addslashes(file_get_contents($_FILES['image']['tmp_name']));
					$image_name	= addslashes($_FILES['image']['name']);
					move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" .$_FILES["image"]["name"]);
					$name 	 	= $db->real_escape_string("uploads/" .$_FILES["image"]["name"]);
					$query 		= $db->query("INSERT INTO documents_tbl (name) VALUES ('$name')");
				}
			}

		//count all members in member pages
			member_count();
		//count all members in guest pages
			all_guest();
