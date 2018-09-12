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
	$id_pesakit = $_POST["id_pesakit"];
	$nama_discaj = $_POST["nama_discaj"];
	$id_tpc = $_POST["id_tpc"];
	$tarikh_dpesakit = $_POST["tarikh_dpesakit"];
	$wad = $_POST["wad"];
	$pendaftar = $_SESSION["nama"];
	
	$sqlUpdate = "UPDATE tbl_pesakit SET nama_discaj=?, id_tpc=?, tarikh_dpesakit=?, wad=? where id_pesakit=? ";	
	$u = $pdo->prepare($sqlUpdate);
	$u->execute(array( $nama_discaj, $id_tpc, $tarikh_dpesakit, $wad, $id_pesakit ));
				
				
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'error.html.php';
		exit();
	}
	
	echo '<p><a href="search_pesakit.php"><body background="download.jpeg"><h3>Maklumat Pesakit telah dikemaskini</h3></p></a>';
	
?>