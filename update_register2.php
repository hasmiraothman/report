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
	
	$id_dpesakit = $_POST["id_dpesakit"];
	$nama_pesakit = $_POST["nama_pesakit"];
	$alamat_pesakit = $_POST["alamat_pesakit"];
	$nama_kedatangan = $_POST["nama_kedatangan"];
	$nama_kategori = $_POST["nama_kategori"];
	$nama_rujukan = $_POST["nama_rujukan"];
	$nama_disiplin = $_POST["nama_disiplin"];
	$nama_assessment = $_POST["nama_assessment"];
	$nama_diagnosis = $_POST["nama_diagnosis"];
	$catatan_pesakit = $_POST["catatan_pesakit"];
	$pendaftar = $_SESSION["nama"];
	
	$sqlUpdate = "UPDATE tbl_register SET nama_pesakit=?, alamat_pesakit=?, nama_kedatangan=?, nama_kategori=?,
	nama_rujukan=?, nama_disiplin=?, nama_assessment=?, nama_diagnosis=?, catatan_pesakit=? where id_dpesakit=? ";	

	$u = $pdo->prepare($sqlUpdate);

	$u->execute(array( $nama_pesakit, $alamat_pesakit, $nama_kedatangan, $nama_kategori, $nama_rujukan, $nama_disiplin, $nama_assessment, $nama_diagnosis, $catatan_pesakit, $id_dpesakit ));
				
				
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'error.html.php';
		exit();
	}
	
	echo '<p><a href="search_register.php"><body background="download.jpeg"><h3>Maklumat pesakit telah dikemaskini</h3></p></a>';
	
	
		
?>