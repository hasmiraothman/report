<?php

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");

		include("connect.php");

if (empty($_POST['tarikh_daftar']) || empty($_POST['nama_pesakit']) ) {
		echo 'Sila lengkapkan maklumat yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT tarikh_daftar , nama_pesakit FROM tbl_register
			WHERE tarikh_daftar = :tarikh_daftar &&  nama_pesakit = :nama_pesakit
			ORDER BY tarikh_daftar DESC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'tarikh_daftar' => $_POST['tarikh_daftar'],
			'nama_pesakit' => $_POST['nama_pesakit']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'Maklumat telah wujud.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{
	$tarikh_daftar = $_POST["tarikh_daftar"];
	$nama_pesakit = $_POST["nama_pesakit"];
	$ic_pesakit = $_POST["ic_pesakit"];
	$no_rawatan = $_POST["no_rawatan"];
	
	$nama_kedatangan = $_POST["nama_kedatangan"];
	$nama = $_SESSION["nama"];;

		$sqlInsert = "INSERT INTO tbl_register (tarikh_daftar, nama_pesakit, ic_pesakit, alamat_pesakit, no_rawatan, nama_kedatangan, nama_kategori, nama_rujukan, nama_disiplin, nama_assessment, nama_diagnosis, tarikh_rawatan, catatan_pesakit, nama) 
		VALUES (:tarikh_daftar, :nama_pesakit, :ic_pesakit, :alamat_pesakit, :no_rawatan, :nama_kedatangan, :nama_kategori, :nama_rujukan, :nama_disiplin, :nama_assessment, :nama_diagnosis, :tarikh_rawatan, :catatan_pesakit, :nama)";
		$s = $pdo ->prepare($sqlInsert);
		$s->bindValue(':tarikh_daftar', $_POST['tarikh_daftar']);
		$s->bindValue(':nama_pesakit', $_POST['nama_pesakit']);
		$s->bindValue(':ic_pesakit', $_POST['ic_pesakit']);
		$s->bindValue(':alamat_pesakit', $_POST['alamat_pesakit']);
		$s->bindValue(':no_rawatan', $_POST['no_rawatan']);
		$s->bindValue(':nama_kedatangan', $_POST['nama_kedatangan']);
		$s->bindValue(':nama_kategori', $_POST['nama_kategori']);
		$s->bindValue(':nama_rujukan', $_POST['nama_rujukan']);
		$s->bindValue(':nama_disiplin', $_POST['nama_disiplin']);
		$s->bindValue(':nama_assessment', $_POST['nama_assessment']);
		$s->bindValue(':nama_diagnosis', $_POST['nama_diagnosis']);
		$s->bindValue(':tarikh_rawatan', $_POST['tarikh_rawatan']);
		$s->bindValue(':catatan_pesakit', $_POST['catatan_pesakit']);
		$s->bindValue(':nama', $nama);
		$s->execute();
$pdo=null;
}catch(PDOException $e){
	$error = 'Error add Maklumat: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
}}
header("Location:search_register.php");
?>