<?php

session_start();
if(!isset($_SESSION["nama_akaun"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap_akaun"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");

if (isset($_POST['submit'])) {

include("connect.php");

if (empty($_POST['id_tpc']) || empty($_POST['rn_pesakit']) ) {
		echo 'Sila lengkapkan maklumat BHT yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT tarikh_census, id_tpc FROM bht
			WHERE tarikh_census = :tarikh_census && 
			id_tpc = :id_tpc
			ORDER BY id_tpc DESC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'tarikh_census' => $_POST['tarikh_census'],
			'id_tpc' => $_POST['id_tpc']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'Maklumat BHT telah wujud.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{

    $id_pesakit = $_POST["id_pesakit"];
	$id_tpc = $_POST["id_tpc"];
	$rn_pesakit = $_POST["rn_pesakit"];
	$nama_wad = $_POST["nama_wad"];
	$nama_pesakit = $_POST["nama_pesakit"];
	$tarikh_census = $_POST["tarikh_census"];
	$jenis_discaj = $_POST["nama_discaj"];
	$now = date('m/d/Y');
	$nama_akaun = $_POST["nama_akaun"];
	

	
			$s = "INSERT INTO bht SET
				
				id_pesakit = :id_pesakit,
				id_tpc = :id_tpc,
				rn_pesakit = :rn_pesakit,
				nama_wad = :nama_wad,
				nama_pesakit = :nama_pesakit,
				jenis_discaj = :jenis_discaj,
				nama_akaun = :nama_akaun,
				rekod_BHT = :rekod_BHT,
				tarikh_census = :tarikh_census";
				
				
			$q = $pdo->prepare($s);
			$q->execute(array(
				'id_pesakit' => $_POST['id_pesakit'],
				'id_tpc' => $_POST['id_tpc'],
				'rn_pesakit' => $_POST['rn_pesakit'],
				'nama_wad' => $_POST['nama_wad'],
				'nama_pesakit' => $_POST['nama_pesakit'],
				'jenis_discaj' => $_POST['nama_discaj'],
				'nama_akaun' => $_POST['nama_akaun'],
				'rekod_BHT' => $now,
				'tarikh_census' => $_POST['tarikh_census']
				
			));
	
		
$pdo=null;


}catch(PDOException $e){
	$error = 'Error add BHT Pesakit: ' . $e->getMessage();
		//include "error.html.php";
		echo "wrong... wrong";
		
		exit();
}
}}}
else
{
header("Location:search_bht_c.php");
}

header("Location:search_bht_c.php");
?>