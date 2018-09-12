<?php

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");


include("connect.php");

if (empty($_POST['nama']) || empty($_POST['katalaluan']) ) {
		echo 'Sila lengkapkan maklumat Pengguna yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT ic_pengguna FROM akaun
			WHERE ic_pengguna = :ic_pengguna
			ORDER BY ic_pengguna ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'ic_pengguna' => $_POST['ic_pengguna']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'Nombor Penjawat telah didaftarkan.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{

$katalaluan = md5($_POST["katalaluan"]);
$now = date('Y/m/d');
$pendaftar = $_SESSION["nama"];

		$sqlInsert = "INSERT INTO akaun (nama, ic_pengguna, katalaluan, tahap, 
		kemaskini_akaun, tarikh_akaun, kemaskinit_akaun) 
		VALUES (:nama, :ic_pengguna, :katalaluan, :tahap, 
		:kemaskini_akaun, :tarikh_akaun, :kemaskinit_akaun)";
		$s = $pdo ->prepare($sqlInsert);
		$s->bindValue(':nama', strtoupper($_POST['nama']));
		$s->bindValue(':ic_pengguna', $_POST['ic_pengguna']);
		$s->bindValue(':katalaluan', $katalaluan);
		$s->bindValue(':tahap', $_POST['tahap']);
		$s->bindValue(':tarikh_akaun', $now);
		$s->bindValue(':kemaskini_akaun', $pendaftar);
		$s->bindValue(':kemaskinit_akaun', $now);
		$s->execute();
$pdo=null;
}catch(PDOException $e){
	$error = 'Error adding submitted profil: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
}}
header("Location:search_akaun.php");
?>