
<?php

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");


include("connect.php");

if (empty($_POST['id_tpc']) || empty($_POST['ic_pesakit']) ) {
		echo 'Sila lengkapkan maklumat Pesakit yang diperlukan!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}
	else
{
//semak akaun telah didaftarkan
		$s = "SELECT id_tpc, ic_pesakit FROM tbl_pesakit
			WHERE id_tpc = :id_tpc && ic_pesakit = :ic_pesakit
			ORDER BY id_tpc ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_tpc' => $_POST['id_tpc'],
			'ic_pesakit' => $_POST['ic_pesakit']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'ID TPC Pesakit telah wujud dalam sistem.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{

$id_tpc = $_POST["id_tpc"];
$ic_pesakit = $_POST["ic_pesakit"];
$tarikh_dpesakit = $_POST["tarikh_dpesakit"];
$wad = $_POST["wad"];
$nama_pesakit = $_POST["nama_pesakit"];
$nama_discaj = $_POST["nama_discaj"];

$now = date('Y/m/d');
$pendaftar = $_SESSION["nama"];


		$sqlInsert = "INSERT INTO tbl_pesakit (id_tpc, ic_pesakit, tarikh_dpesakit, wad, nama_pesakit, nama_discaj) 
		VALUES (:id_tpc, :ic_pesakit, :tarikh_dpesakit, :wad, :nama_pesakit, :nama_discaj)";
		$s = $pdo ->prepare($sqlInsert);
		
		$s->bindValue(':id_tpc', $_POST['id_tpc']);
		$s->bindValue(':ic_pesakit', $_POST['ic_pesakit']);
		$s->bindValue(':tarikh_dpesakit', $_POST['tarikh_dpesakit']);
		$s->bindValue(':wad', $_POST['wad']);

		$s->bindValue(':nama_pesakit', strtoupper($_POST['nama_pesakit']));
		
		$s->bindValue(':nama_discaj', $_POST['nama_discaj']);
		
		$s->execute();

$pdo=null;
}catch(PDOException $e){
	$error = 'Error adding submitted profil: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
}}
header("Location:search_pesakit.php");
?>