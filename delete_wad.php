<?php
include("connect.php");
if (isset($_GET['id_wad']))
try{

	//semak username wujud 
			$s = "SELECT * FROM tbl_wad
			WHERE id_wad = :id_wad
			ORDER BY id_wad ASC
			LIMIT 1
		";
			$q = $pdo->prepare($s); 
			$q->execute(array(
				'id_wad' => (int) $_GET['id_wad']
			));
	
		//delete data
		$s = "DELETE FROM tbl_wad
			WHERE id_wad = :id_wad
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_wad' => (int) $_GET['id_wad']
		));
		



}catch(PDOException $e){
	$error = 'Error deleting wad: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
header("Location:wadReg.php");
exit();
?>