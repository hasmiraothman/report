<?php
$host 	= "localhost";
$db	= "newbht";
$user	= "root";
$pass	= "";

$conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
$sql = "SELECT * FROM tbl_wad";
$q	 = $conn->query($sql) or die("failed!");


try
{
	//$pdo = new PDO('mysql:host=localhost;dbname=casenotes', 'root','mZhcd236');
	$pdo = new PDO('mysql:host=localhost;dbname=newbht', 'root');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
	//echo "Connected successfully";
}
catch(PDOException $e)
{
	$output = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}


?>