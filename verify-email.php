<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>User Account Activation </title>
</head>
<body>
	<?php
		if($_GET['key'] && $_GET['token'])	
		{
			include "db.php";
			$email = $_GET['key'];
			$token = $_GET['token']; 
			$query = mysqli_query($conn,"SELECT * FROM `users` WHERE `email_verification_link` = '".$token."' and `email`='".$email."';");
			$d = date('Y-m-d H:i:s'); 
			if(mysqli_num_rows($query) > 0){
				$row=mysqli_fetch_array($query); 
				if($row['email_verified_at']==NULL){
					mysqli_query($conn,"UPDATE users SET email_verified_at='".$d."' WHERE email='" .$email."'"); 
					$msg = "Congratulations! your email is verified."; 
				}
				else{
					$msg="You have  already verified with us."; 
				}
			}
			else{
				$msg="this email has not been registered with us"; 
			}
		}
		else{
			$msg="Danger! something went wrong."; 
		}
	?>
	<div> User Account verification using php 
	<p><?php echo $msg; ?></p> 
	</div>
</body> 
</html>