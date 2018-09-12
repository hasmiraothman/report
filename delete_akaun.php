<?php
include("connect.php");
if (isset($_GET['id_pengguna']))
try{

	//semak username wujud 
			$s = "SELECT * FROM akaun
			WHERE id_pengguna = :id_pengguna
			ORDER BY id_pengguna ASC
			LIMIT 1
		";
			$q = $pdo->prepare($s); 
			$q->execute(array(
				'id_pengguna' => (int) $_GET['id_pengguna']
			));
	
		//delete data
		$s = "DELETE FROM akaun
			WHERE id_pengguna = :id_pengguna
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_pengguna' => (int) $_GET['id_pengguna']
		));
		



}catch(PDOException $e){
	$error = 'Error deleting Akaun Pengguna: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
header("Location:search_akaun.php");
exit();
?>