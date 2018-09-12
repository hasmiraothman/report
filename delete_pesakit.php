<?php
include("connect.php");
if (isset($_GET['id_pesakit']))
try{

	//semak username wujud 
			$s = "SELECT * FROM tbl_pesakit
			WHERE id_pesakit = :id_pesakit
			ORDER BY id_pesakit ASC
			LIMIT 1
		";
			$q = $pdo->prepare($s); 
			$q->execute(array(
				'id_pesakit' => (int) $_GET['id_pesakit']
			));
	
		//delete data
		$s = "DELETE FROM tbl_pesakit
			WHERE id_pesakit = :id_pesakit
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_pesakit' => (int) $_GET['id_pesakit']
		));
		



}catch(PDOException $e){
	$error = 'Error deleting census: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
header("Location:search_pesakit.php");
exit();
?>