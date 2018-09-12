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
$now = date('Y/m/d');


		$sqlInsert = "INSERT INTO tbl_casenote (wad, tarikh_terima, tarikh_pinjam, tarikh_hantar, discharge, mati, dama, polis, hidup, jumlah_hantar, jumlah_sebenar, jumlah_hari) 
		VALUES (:wad, :tarikh_terima, :tarikh_pinjam, :tarikh_hantar, :discharge, :mati, :dama, :polis, :hidup, :jumlah_hantar, :jumlah_sebenar, :jumlah_hari)";
		$s = $pdo ->prepare($sqlInsert);
		$s->bindValue(':wad', strtoupper($_POST['wad']));
		$s->bindValue(':tarikh_terima', $now);
		$s->bindValue(':tarikh_pinjam', $_POST['tarikh_pinjam']);
		$s->bindValue(':tarikh_hantar', $_POST['tarikh_hantar']);
		$s->bindValue(':discharge', $_POST['balik_rumah']);
		$s->bindValue(':mati', $_POST['mati']);
		$s->bindValue(':dama', $_POST['dama']);
		$s->bindValue(':polis', $_POST['polis']);
		$s->bindValue(':hidup', $_POST['hidup']);
		$s->bindValue(':jumlah_hantar', $_POST['jumlah_hantar']);
		$s->bindValue(':jumlah_sebenar', $_POST['jumlah_sebenar']);
		$s->bindValue(':jumlah_hari', $_POST['jumlah_hari']);
		$s->execute();
$pdo=null;
}catch(PDOException $e){
	$error = 'Error adding submitted profil: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
}}
header("Location:csvupload2.php");
?>