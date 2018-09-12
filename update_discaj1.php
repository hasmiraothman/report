<?php

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");

//update
include("connect.php");


	try
	{
	
	$id_discaj = $_POST["id_discaj"];
	$ic_staf_daftar = $_POST["ic_staf_daftar"];
	$tarikh_discaj = date('Y/m/d');
	$pendaftar = $_SESSION["nama"];
	
	$sqlUpdate = "UPDATE discaj SET ic_staf_daftar=?, tarikh_discaj=? where id_discaj=? ";	
	$u = $pdo->prepare($sqlUpdate);
	$u->execute(array(  $ic_staf_daftar, $tarikh_discaj, $id_discaj ));
				
				
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'error.html.php';
		exit();
	}
	
	echo '<p><a href="search_discaj.php"><body background="download.jpeg"><h3>Pendaftaran discaj telah dikemaskini</h3></p></a>';
			
?>