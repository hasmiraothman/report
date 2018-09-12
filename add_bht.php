<?php
session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");
if (isset($_POST['submit'])) {
include("connect.php");
if (empty($_POST['id_tpc']) || empty($_POST['ic_pesakit']) ) {
		echo 'Sila lengkapkan maklumat BHT yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT tarikh_census, id_tpc FROM tbl_bht
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
	$ic_pesakit = $_POST["ic_pesakit"];
	$bulan_census = $_POST["bulan_census"];
	$tahun_census = $_POST["tahun_census"];
	$no_rn = $_POST["no_rn"];
	$alamat_pesakit = $_POST["alamat_pesakit"];
	$tarikh_discaj = $_POST["tarikh_discaj"];
	$kes_polis[] = $_POST["kes_polis[]"];
	$mati[] = $_POST["mati[]"];
	$insuran = $_POST["insuran[]"];
	$pomr[] = $_POST["pomr[]"];
	$kanser[] = $_POST["kanser[]"];
	$jam72[] = $_POST["jam72[]"];
	$wad = $_POST["wad"];
	$nama_pesakit = $_POST["nama_pesakit"];
	$tarikh_census = $_POST["tarikh_census"];
	$nama_discaj = $_POST["nama_discaj"];
	$now = date('m/d/Y');
	$pendaftar = $_SESSION["nama"];
	
		$s = "INSERT INTO tbl_bht SET
			id_pesakit = :id_pesakit,
			id_tpc = :id_tpc,
			ic_pesakit = :ic_pesakit,
			wad = :wad,
			nama_pesakit = :nama_pesakit,
			nama_discaj = :nama_discaj,
			nama = :nama,
			bulan_census = :bulan_census,
			tahun_census = :tahun_census,
			no_rn = :no_rn,
			alamat_pesakit = :alamat_pesakit,
			tarikh_discaj = :tarikh_discaj,
			kes_polis[] = :kes_polis[],
			mati[] = :mati[],
			insuran[] = :insuran[],
			pomr[] = :pomr[],
			kanser[] = :kanser[],
			jam72[] = :jam72[],
			tarikh_census = :tarikh_census";				
				
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_pesakit' => $_POST['id_pesakit'],
			'id_tpc' => $_POST['id_tpc'],
			'ic_pesakit' => $_POST['ic_pesakit'],
			'wad' => $_POST['wad'],
			'nama_pesakit' => $_POST['nama_pesakit'],
			'nama_discaj' => $_POST['nama_discaj'],
			'bulan_census' => $_POST['bulan_census'],
			'tahun_census' => $_POST['tahun_census'],
			'no_rn' => $_POST['no_rn'],
			'alamat_pesakit' => $_POST['alamat_pesakit'],
			'tarikh_discaj' => $_POST['tarikh_discaj'],
			'kes_polis[]' => $_POST['kes_polis[]'],
			'mati[]' => $_POST['mati[]'],
			'insuran[]' => $_POST['insuran[]'],
			'pomr[]' => $_POST['pomr[]'],
			'kanser[]' => $_POST['kanser[]'],
			'jam72[]' => $_POST['jam72[]'],
			'nama' => $pendaftar,
			'rekod_bht' => $now,
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