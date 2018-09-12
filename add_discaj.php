
<?php

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");


include("connect.php");

if (empty($_POST['nama_discaj']) || empty($_POST['ic_staf_daftar']) ) {
		echo 'Sila lengkapkan maklumat Discaj yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT nama_discaj, tarikh_discaj FROM tbl_discaj
			WHERE nama_discaj = :nama_discaj && tarikh_discaj = :tarikh_discaj
			ORDER BY nama_discaj  ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'nama_discaj' => $_POST['nama_discaj'],
			'tarikh_discaj' => $_POST['tarikh_discaj']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'Nama Discaj telah wujud dalam sistem.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{

$nama_discaj = $_POST["nama_discaj"];
$ic_staf_daftar = $_POST["ic_staf_daftar"];
$tarikh_discaj = $_POST["tarikh_discaj"];
$now = date('Y/m/d');
$pendaftar = $_SESSION["nama"];


		$sqlInsert = "INSERT INTO tbl_discaj(nama_discaj, ic_staf_daftar, tarikh_discaj) 
		VALUES (:nama_discaj, :ic_staf_daftar, :tarikh_discaj)";
		$s = $pdo ->prepare($sqlInsert);
		$s->bindValue(':nama_discaj', strtoupper($_POST['nama_discaj']));
		$s->bindValue(':ic_staf_daftar', $_POST['ic_staf_daftar']);
		$s->bindValue(':tarikh_discaj', $now);
		$s->execute();

$pdo=null;
}catch(PDOException $e){
	$error = 'Error adding submitted profil: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
}}
header("Location:search_discaj.php");
?>