<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
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
<h1 align="center">Daily Report</h1>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="query" id="query">
<Table>
<tr><td>
<label>Employee No. : </label></td>
<td>
<input type="text" name="id_tpc" id="id_tpc" />
    <label>
    <input type="submit" name="button" id="button" value="Submit" />
    </label>
	</td></tr>
</Table>
</form>

<form method="post" action="add_discaj.php">
  <h4>Daftar Discaj:</h4>
<table>
<tr><td>
<label>Nama Discaj: </label></td><td><input type="text" name="nama_discaj" required/></td></tr>
<tr><td><label>IC Staf Pendaftar: </label></td><td><input type="text" name="ic_staf_daftar" required></td></tr>
<tr><td><label>Tarikh Daftar: </label></td><td><input type="date" name="tarikh_discaj" value="<?php echo date('Y-m-d');?>"></td></tr>
</table>
<input name="btnSubmit" type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=6 valign="middle">Pengemaskinian wad</th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
    <td>Cara Discaj</td>
	 <td><span class="style1" valign="middle">ic. staf  daftar</span></td>
	<td><span class="style1" valign="middle">Tarikh </span></td>
	<td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_discaj ORDER BY nama_discaj ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>

				  <td align="center" valign="middle"><?php echo $n; ?>
				  <td align="left" valign="middle"><?php echo $t->nama_discaj; ?></td>
				  <td align="left" valign="middle"><?php echo $t->ic_staf_daftar; ?></td>
				  <td align="left" valign="middle"><?php echo $t->tarikh_discaj; ?></td>
				  <td align="center" valign="middle">
				   <a href="update_discaj.php?id_discaj=<?php echo $t->id_discaj; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_discaj.php?id_discaj=<?php echo $t->id_discaj; ?>">DELETE</a></td></tr>
					 

				 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
