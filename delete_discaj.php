<?php
include("connect.php");
if (isset($_GET['id_discaj']))
try{

	//semak username wujud 
			$s = "SELECT * FROM discaj
			WHERE id_discaj = :id_discaj
			ORDER BY id_discaj ASC
			LIMIT 1
		";
			$q = $pdo->prepare($s); 
			$q->execute(array(
				'id_discaj' => (int) $_GET['id_discaj']
			));
	
		//delete data
		$s = "DELETE FROM discaj
			WHERE id_discaj = :id_discaj
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_discaj' => (int) $_GET['id_discaj']
		));
		



}catch(PDOException $e){
	$error = 'Error deleting discaj: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
header("Location:search_discaj.php");
exit();
?>