<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama_akaun"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap_akaun"]))
{header("Location:index.html");}

if (($_SESSION['tahap_akaun']=="Admin")) {
?>
<html>
<style type="text/css">
H1 {text-decoration:blink;}
</style>
</Head>
<Body bgcolor="burlywood" text="black">
<center><h1><p style="background-color:pink">Welcome to e-Medical Rehabilitation System</p></h1></center>
<form method="post" action="add_assessment.php">
<h4>Register Assessment and Training Assessment:</h4>
<table>
<tr><td><label>Assessment and Training: </label></td><td><input type="text" size="50" name="nama_assessment"></td></tr>
<tr><td><label>Note: </label></td><td><input type="text" name="catatan_assessment"></td></tr>

</table>
<input type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=7 valign="middle">Update Assessment and Training Information</th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
  <td><span class="style1" valign="middle">Assessment and Training</span></td>
	<td><span class="style1" valign="middle">Update By</span></td>
	<td><span class="style1" valign="middle">Date of Update</span></td>
	<td><span class="style1" valign="middle">Update</span></td>
  	<td><span class="style1" valign="middle">Delete</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM assessment ORDER BY nama_assessment ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>

				  <td align="center" valign="middle"><?php echo $n; ?>
				  <td align="left" valign="middle"><?php echo $t->nama_assessment; ?></td>
				  <td align="left" valign="middle"><?php echo $t->nama_akaun; ?></td>
				  <td align="left" valign="middle"><?php echo $t->kemaskini_assessment; ?></td>
				  <td align="center" valign="middle">
				   <a href="update_assessment.php?id=<?php echo $t->id_assessment; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_assessment.php?id=<?php echo $t->id_assessment; ?>">DELETE</a></td>
                      <td align="center" valign="middle">
					 <a href="insert_assessment.php?id_assessment=<?php echo $t->id_assessment; ?>">INSERT Assessment</a></td>
                     </tr>
					 

				 
<?php
$pdo = NULL;
			}
				?>

</table>
</html>
<?php
}
?>