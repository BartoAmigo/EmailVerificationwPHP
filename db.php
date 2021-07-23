<?php 
		//Database Information
		$servername='FILL';
		$username='FILL';
		$password='FILL';
		$dbname='FILL';
		$conn=mysqli_connect($servername,$username,$password,"$dbname");
			if(!$conn){
				die('Could not Connect MySql Server:' .mysql_error());
		}
				
?>