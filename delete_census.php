<?php
include("connect.php");
if (isset($_GET['id_census']))
try{

	//semak username wujud 
			$s = "SELECT * FROM tbl_census
			WHERE id_census = :id_census
			ORDER BY id_census ASC
			LIMIT 1
		";
			$q = $pdo->prepare($s); 
			$q->execute(array(
				'id_census' => (int) $_GET['id_census']
			));
	
		//delete data
		$s = "DELETE FROM tbl_census
			WHERE id_census = :id_census
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_census' => (int) $_GET['id_census']
		));
		



}catch(PDOException $e){
	$error = 'Error deleting census: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
header("Location:search_census.php");
exit();
?>