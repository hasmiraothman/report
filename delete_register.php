<?php
include("connect.php");
if (isset($_GET['id_dpesakit']))
try{

	//semak username wujud 
			$s = "SELECT * FROM tbl_register
			WHERE id_dpesakit = :id_dpesakit
			ORDER BY id_dpesakit ASC
			LIMIT 1
		";
			$q = $pdo->prepare($s); 
			$q->execute(array(
				'id_dpesakit' => (int) $_GET['id_dpesakit']
			));
	
		//delete data
		$s = "DELETE FROM tbl_register
			WHERE id_dpesakit = :id_dpesakit
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_dpesakit' => (int) $_GET['id_dpesakit']
		));
		



}catch(PDOException $e){
	$error = 'Error deleting Pesakit: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
header("Location:search_register.php");
exit();
?>