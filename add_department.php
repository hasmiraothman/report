
<?php

session_start();
if(!isset($_SESSION["username"]))
{header("Location:index.html");}
if(!isset($_SESSION["user_privilege"]))
{header("Location:index.html");}

date_default_timezone_set("Asia/Kuala_Lumpur");


include("connect.php");

if (empty($_POST['deparment_name']) || empty($_POST['staff_regno']) ) {
		echo 'Please insert the complete Information!';
		echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
	}

	else
{
//semak akaun telah didaftarkan
		$s = "SELECT department_name, d_date FROM tbl_department
			WHERE department_name = :department_name && d_date = :d_date
			ORDER BY department_name ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'department_name' => $_POST['department_name'],
			'd_date' => $_POST['d_date']
		));
		
		//jika telah didaftarkan
		if ($q->rowCount()) {
			echo 'Department has been created in System.';
			echo '<meta http-equiv="Refresh" content="2;url=../index.html">';
		}
		
		//jika tiada, daftar baru
else
{

try{

$department_name = $_POST["department_name"];
$staff_regno = $_POST["staff_regno"];
$d_date = $_POST["d_date"];
$now = date('Y/m/d');
$registrar = $_SESSION["username"];


		$sqlInsert = "INSERT INTO tbl_department (department_name, staff_regno, d_date) 
		VALUES (:department_name, :staff_regno, :d_date)";
		$s = $pdo ->prepare($sqlInsert);
		$s->bindValue(':department_name', strtoupper($_POST['department_name']));
		$s->bindValue(':staff_regno', $_POST['staff_regno']);
		$s->bindValue(':d_date', $now);
		$s->execute();

$pdo=null;
}catch(PDOException $e){
	$error = 'Error adding submitted profil: ' . $e->getMessage();
		//include "error.html.php";
		exit();
}
}}
header("Location:search_department.php");
?>