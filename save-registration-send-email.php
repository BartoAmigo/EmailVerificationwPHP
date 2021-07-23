<?php
	//Import PHPMailer classes into global namespace 
	//must be at top. 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP; 
	
	
	if(isset($_POST['password']) && $_POST['email'])	
	{
	include("db.php");
	$result = mysqli_query($conn,"SELECT * FROM users WHERE email ='" . $_POST['email'] . "'"); 
	$row = mysqli_num_rows($result);
	if($row == 0) 
	{
	$token = md5($_POST['email']).rand(10,9999);
	mysqli_query($conn,"INSERT INTO users(username,email,password,email_verification_link,gender) VALUES( '". $_POST['username'] . "','".$_POST['email']."','".md5($_POST['password'])."','". $token . "','" . $_POST['sex'] ."')");
	$link = "<a href='localhost/html/verify-email.php?key=".$_POST['email']."&token=".$token."'>Click and Verify Email </a>";
	require($_SERVER["DOCUMENT_ROOT"]."/PHPMailer/src/PHPMailer.php");
	require($_SERVER["DOCUMENT_ROOT"]."/PHPMailer/src/Exception.php"); 
	require($_SERVER["DOCUMENT_ROOT"]."/PHPMailer/src/SMTP.php");

	//Create new instance passing true enables exceptions 
	$mail = new PHPMailer(true);
	
	//server settings 
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;  
	$mail->IsSMTP(); 
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true; 
	//Login Details 
	$mail->Username = "Enter a email";
	$mail->Password = "Enter a password";
	
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
	$mail->Port = "465"; 
	
	 
	$mail->setFrom('enter email', 'enterName');  
	$mail->AddAddress($_POST['email'],$_POST['username']); 
	$mail->Subject = 'Activate Account'; 
	$mail->IsHTML(true); 
	$mail->Body = '<h1 style="font-size:40px;">Hello click on this link!</h1>'.$link.''; 
	if($mail->Send())
	{
		echo "Check your Email box and Click on the email verification link."; 
	}
	else
	{
		echo "mail error -> ". $mail->ErrorInfo; 
	}
	}
	else
	{
		echo "You have already registered with us. Check your email box and verify email."; 
	}
	}
?>