<?php

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");


include("connect.php");

if (empty($_POST['nama_tujuan'])) {
		echo 'Sila lengkapkan maklumat Tujuan yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT nama_tujuan FROM tbl_tujuan
			WHERE nama_tujuan = :nama_tujuan
			ORDER BY nama_tujuan ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'nama_tujuan' => $_POST['nama_tujuan']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'Senarai tujuan tersebut telah didaftarkan.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{

$now = date('Y/m/d');
$pendaftar = $_SESSION["nama"];

		$sqlInsert = "INSERT INTO tbl_tujuan (nama_tujuan, catatan_tujuan, nama, kemaskinit_tujuan, tarikh_tujuan) 
		VALUES (:nama_tujuan, :catatan_tujuan, :nama, :tarikh_tujuan, :kemaskinit_tujuan)";
		$s = $pdo ->prepare($sqlInsert);
		$s->bindValue(':nama_tujuan', strtoupper($_POST['nama_tujuan']));
		$s->bindValue(':catatan_tujuan', $_POST['catatan_tujuan']);
		$s->bindValue(':nama', $pendaftar);
		$s->bindValue(':tarikh_tujuan', $now);
		$s->bindValue(':kemaskinit_tujuan', $now);
		$s->execute();
$pdo=null;
}catch(PDOException $e){
	$error = 'Error adding submitted profil: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
}}
header("Location:search_tujuan.php");
?>