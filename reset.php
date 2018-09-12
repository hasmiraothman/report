<?php
//update
include("connect.php");


	try
	{
	$username=$_POST['username'];
	$user_password=$_POST['user_password'];

	$md5user_password=md5($user_password);
	
	$reset_bht = "UPDATE tbl_users SET user_password=? where username=? ";	
	$reset_bht1 = $pdo->prepare($reset_bht);
	$reset_bht1->execute(array($user_password, $username));
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'error.html.php';
		exit();
	}
	
	echo '<p><a href="index.html"><body background=""><h3>Sila pasti akaun telah wujud! user_password anda telah dikemaskini ~ Paparan Utama!</h3></p></a>';
	
	
		
?>