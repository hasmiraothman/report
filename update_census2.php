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
	
	$id_census = $_POST["id_census"];
	$discaj = $_POST["discaj"];
	$hidup = $_POST["hidup"];
	$mati = $_POST["mati"];
	$DAMA = $_POST["DAMA"];
	$absconded = $_POST["absconded"];
	$transfer = $_POST["transfer"];
	$now = date('Y/m/d');
	$pendaftar = $_SESSION["nama"];
	
	$sqlUpdate = "UPDATE tbl_census SET discaj=?, hidup=?, mati=?, DAMA=?,
	absconded=?, transfer=?, $tarikh=?, $kemaskini_census=? where id_census=? ";	

	$u = $pdo->prepare($sqlUpdate);

	$u->execute(array( $discaj, $hidup, $mati, $DAMA, $absconded, $transfer, $now, $id_census ));
				
				
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'error.html.php';
		exit();
	}
	
	echo '<p><a href="search_census.php"><body background="download.jpeg"><h3>Census telah dikemaskini</h3></p></a>';
	
	
		
?>