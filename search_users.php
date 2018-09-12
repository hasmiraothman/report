
<?php
include("connect.php");

session_start();
if(!isset($_SESSION["username"]))
{header("Location:index.html");}
if(!isset($_SESSION["user_privilege"]))
{header("Location:index.html");}

if (($_SESSION['tahap']=="administrator")) {
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


<form method="post" action="add_users.php">
  <h4>Register User Account:</h4>
<table>
<tr><td><label>Username: </label></td><td><input type="text" name="username"/></td></tr>
<tr><td><label>Employee Number (unique): </label></td><td><input type="text" name="staff_regno"/></td></tr>
<tr><td><label>Password: </label></td><td><input type="password" name="password" required></td></tr>
<tr><td>User Privilege: </td><td><select name="user_privilege" required/>
        <option>administrator</option>
        <option>regular user</option>
        <option>moderator</option>
        </select>
</td></tr>
<tr><td><label>Remarks: </label></td><td><input type="text" name=remarks"></td></tr>

</table>
<input name="btnSubmit" type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=6 valign="middle">UPDATED USERS ACCOUNT</th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
    <td><span class="style1" valign="middle">Name</span></td>
	 <td><span class="style1" valign="middle">Staff No</span></td>
	<td><span class="style1" valign="middle">Updated Dated</span></td>
	<td><span class="style1" valign="middle">Update/Delete</span></td>
  	
  </tr>
  
 	<?php
	$t = "SELECT * FROM tbl_user ORDER BY username ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
	?>
				<td align="center" valign="middle"><?php echo $n; ?>
				<td align="left" valign="middle"><?php echo $t->username; ?></td>
				<td align="left" valign="middle"><?php echo $t->staff_regno; ?></td>
				<td align="left" valign="middle"><?php echo $t->update_users; ?></td>
				<td align="center" valign="middle">
				   	<a href="update_akaun.php?id_pengguna=<?php echo $t->id_pengguna; ?>">UPDATE</a>
					<a href="delete_akaun.php?id_pengguna=<?php echo $t->id_pengguna; ?>">DELETE</a>
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
