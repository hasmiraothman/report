<?php
include("connect.php");
//if (isset($_GET['deletehospital']))
try{

	//semak username wujud 
			$s = "SELECT * FROM tbl_tujuan
			WHERE id_tujuan = :id_tujuan
			ORDER BY id_tujuan ASC
			LIMIT 1
		";
			$q = $pdo->prepare($s); 
			$q->execute(array(
				'id_tujuan' => (int) $_GET['id_tujuan']
			));
	
		//delete data
		$s = "DELETE FROM tbl_tujuan
			WHERE id_tujuan = :id_tujuan
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_tujuan' => (int) $_GET['id_tujuan']
		));
		



}catch(PDOException $e){
	$error = 'Error deleting Maklumat Program: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
header("Location:search_tujuan.php");
exit();
?>