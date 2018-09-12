<?php
include("connect.php");

session_start();
if(!isset($_SESSION["username"]))
{header("Location:index.html");}
if(!isset($_SESSION["user_privilege"]))
{header("Location:index.html");}

if (($_SESSION['user_privilege']=="administrator")) {
?>
<html>
<style> 
h1{ color:#ff6347;}
#example1 {
    background-image: url(big-data.jpg);
   opacity: 1;
    filter: alpha(opacity=50);
}
</style>



<body>
<h1 align="center">Daily Report System</h1>


<form method="post" action="add_department.php">
  <h4>Department Register:</h4>
<table>
<tr><td>
<label>Location Name: </label></td><td><input type="text" name="department_name" required/></td></tr>
<tr><td><label>Staff No: </label></td><td><input type="text" name="staff_regno" required></td></tr>
<tr><td><label>Date: </label></td><td><input type="date" name="d_date" value="<?php echo date('Y-m-d');?>" ></td>
</tr>
</table>
<input name="btnSubmit" type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=6 valign="middle">Current Department</th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
    <td><span class="style1" valign="middle">Location Name</span></td>
	 <td><span class="style1" valign="middle">Staff No</span></td>
	<td><span class="style1" valign="middle">Date Inserted </span></td>
	<td><span class="style1" valign="middle">Update/Delete</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_department ORDER BY department_name ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>

				<td align="center" valign="middle"><?php echo $n; ?>
				<td align="left" valign="middle"><?php echo $t->department_name; ?></td>
				<td align="left" valign="middle"><?php echo $t->staff_regno; ?></td>
				<td align="left" valign="middle"><?php echo $t->d_date; ?></td>
				<td align="center" valign="middle">
				   	<a href="update_department.php?id_department=<?php echo $t->id_department; ?>">UPDATE</a>
					<a href="delete_department.php?id_department=<?php echo $t->id_department; ?>">DELETE</a>
				</td></tr>		 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
