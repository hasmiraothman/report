<?php

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");

		include("connect.php");

if (empty($_POST['tarikh_census']) || empty($_POST['discaj']) ) {
		echo 'Sila lengkapkan maklumat Banci Harian Wad yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT discaj, tarikh_census FROM tbl_census
			WHERE  tarikh_census = :tarikh_census && discaj = :discaj
			ORDER BY tarikh_census DESC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'tarikh_census' => $_POST['tarikh_census'],
			'discaj' => $_POST['discaj']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'Maklumat Banci Harian Wad telah wujud.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{
	$tarikh_census = $_POST["tarikh_census"];
	$nama_wad = $_POST["wad"];
	$discaj = $_POST["discaj"];
	$mati = $_POST["mati"];
	$absconded = $_POST["absconded"];
	$DAMA = $_POST["DAMA"];
	$transfer = $_POST["transfer"];
	$hidup = $_POST["hidup"];
	$jumlah = $discaj + $mati + $absconded + $DAMA + $transfer + $hidup;
	$now = date('m/d/Y');
	$nama = $_SESSION["nama"];;

		$sqlInsert = "INSERT INTO tbl_census (tarikh_census, wad, discaj, mati, 
		absconded, DAMA, transfer, hidup, jumlah, tarikh, nama) 
		VALUES (:tarikh_census, :wad, :discaj, :mati, :absconded, :DAMA, :transfer, :hidup, :jumlah, :tarikh, :nama)";
		$s = $pdo ->prepare($sqlInsert);
		$s->bindValue(':tarikh_census', $_POST['tarikh_census']);
		$s->bindValue(':wad', $_POST['wad']);
		$s->bindValue(':discaj', $_POST['discaj']);
		$s->bindValue(':mati', $_POST['mati']);
		$s->bindValue(':absconded', $_POST['absconded']);
		$s->bindValue(':DAMA', $_POST['DAMA']);
		$s->bindValue(':transfer', $_POST['transfer']);
		$s->bindValue(':hidup', $_POST['hidup']);
		$s->bindValue(':jumlah',  $jumlah);
		$s->bindValue(':tarikh', $now);
		$s->bindValue(':nama', $nama);
		$s->execute();
$pdo=null;
}catch(PDOException $e){
	$error = 'Error add Banci Harian Wad: ' . $e->getMessage();
		//include "error.html.php";
		echo "wrong... wrong";
		exit();
}
}}
header("Location:search_bht.php");

?>