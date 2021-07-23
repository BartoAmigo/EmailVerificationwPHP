<?php 
		//Database Information
		$servername='FILL in';
		$username='FILL in';
		$password='FILL in';
		$dbname='FILL in';
		$conn=mysqli_connect($servername,$username,$password,"$dbname");
			if(!$conn){
				die('Could not Connect MySql Server:' .mysql_error());
		}
				
?>