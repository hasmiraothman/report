<?
mysql_connect("localhost");
mysql_select_db("test") or die("database could not connect ");
?>
<html>
<head>
<meta name="description" content="Php Code for View, Search, Edit and Delete
Record" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Student Record</title>
</head>
<body>
<?
$roll=$_GET["roll"];
$query="delete from student where roll=$roll";
mysql_query($query);
echo "<center>Successfully Deleted</center>";
include("search.php");
?>
</body>
</html>