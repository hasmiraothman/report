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
	
	$id_pengguna = $_POST["id_pengguna"];
	$nama = strtoupper($_POST["nama"]);
	$tahap = $_POST["tahap"];
	$now = date('Y/m/d');
	$katalaluan = md5($_POST["katalaluan"]);
	$pendaftar = $_SESSION["nama"];
	
	$sqlUpdate = "UPDATE akaun SET nama=?, katalaluan=?, tahap=?, kemaskini_akaun=?,
	kemaskinit_akaun=? where id_pengguna=? ";	
	$u = $pdo->prepare($sqlUpdate);
	$u->execute(array( $nama, $katalaluan, $tahap, $pendaftar, $now, $id_pengguna ));
				
				
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'error.html.php';
		exit();
	}
	
	echo '<p><a href="search_akaun.php"><body background="download.jpeg"><h3>Akaun Pengguna telah dikemaskini</h3></p></a>';
	
	
		
?>