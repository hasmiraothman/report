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
		
		
	$id_tujuan = $_POST["id_tujuan"];
	$nama_tujuan = $_POST["nama_tujuan"];
	$catatan_tujuan = $_POST["catatan_tujuan"];
	$now = date('Y/m/d');
	$pendaftar = $_SESSION["nama"];
	
	$sqlUpdate = "UPDATE tbl_tujuan SET nama_tujuan=?, nama=?,
	kemaskinit_tujuan=?, catatan_tujuan=? where id_tujuan=? ";	
	$u = $pdo->prepare($sqlUpdate);
	$u->execute(array(strtoupper($nama_tujuan), $pendaftar, $now, $catatan_tujuan, $id_tujuan ));
	
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'file:///C|/xampp/htdocs/occ/error.html.php';
		exit();
	}
	echo '<p><a href="search_tujuan.php"><body background="im30.jpg"><h3>Maklumat Tujuan telah dikemaskini</h3></p></a>';
		
?>