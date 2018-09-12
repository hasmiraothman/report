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
	
	$id_wad = $_POST["id_wad"];
	$ic_staf_daftar = $_POST["ic_staf_daftar"];
	$tarikhwad = date('Y/m/d');
	$pendaftar = $_SESSION["nama"];
	
	$sqlUpdate = "UPDATE tbl_wad SET ic_staf_daftar=?, tarikhwad=? where id_wad=? ";	
	$u = $pdo->prepare($sqlUpdate);
	$u->execute(array(  $ic_staf_daftar, $tarikhwad, $id_wad ));
				
				
	
	}
	catch (PDOException $f)
	{
		$error = 'Error adding submitted profil: ' . $f->getMessage();
		//include 'error.html.php';
		exit();
	}
	
	echo '<p><a href="wadReg.php"><body background="download.jpeg"><h3>Pendaftaran wad telah dikemaskini</h3></p></a>';
			
?>