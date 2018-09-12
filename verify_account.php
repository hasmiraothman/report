<?php

//verify .php Declare and create a session
$username=$_POST['username'];
$user_password=$_POST['user_password'];

$md5user_password=md5($user_password);

if($username!=NULL)
{
// connect to mysql server
//$db = mysql_connect ("localhost", "ict")
$db = mysqli_connect("localhost", "root")
or die
("The MySQL server is OFF <br>");

if($db==true)
{
echo ("The MySQL server is ON <br>");
}

//connect to the database
$dbexist = mysqli_select_db($db,"logbook");
if ($db->query($dbexist) === TRUE)
{echo ("The database does EXIST <br>");}
else {echo ("The database does EXIST <br>");}

//the sql query
$query = "SELECT * FROM tbl_users WHERE username=$username";
//executing the sql
$result = mysqli_query($db,$query);
if($db->query($query) === TRUE)
{
echo '<a href="index.html">Paparan Utama!</a>';

die ("Invalid query: " . mysqli_error());
}

//check record number
$id_users = mysqli_num_rows($result);
if($id_users==1) 
{
//one user found
$row=mysqli_fetch_array($db,$result);
if($md5user_password==$row["user_password"])
//create session for this user
//session begins
{session_start(); //set the users full name
$_SESSION["username"]=$row["username"]; 
$_SESSION["user_privilege"]=$row["user_privilege"]; 
header("Location:header.html");}
else {echo 'kata laluan anda salah!'; echo '<a href="index.html">Cuba lagi-user_password!</a>';}
}
else {echo 'Maklumat akaun anda salah!'; echo '<a href="index.html">Cuba lagi-user_password!</a><br>';
}
}
else {echo '<a href="index.html">Cuba semula!</a>';}


?>