
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
<h1 align="center">Selamat datang ke Sistem Pengurusan BHT</h1>


<form method="post" action="add_tujuan.php">
  <h4>Daftar Metadata Tujuan Pinjaman:</h4>
<table>
<tr><td>
<label>Daftar Nama Tujuan Pinjaman: </label></td><td><input type="text" name="nama_tujuan" required/></td></tr>
<tr><td><label>Catatan Tujuan Pinjaman: </label></td><td><input type="text" name="catatan_tujuan" ></td></tr>

</table>
<input name="btnSubmit" type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=6 valign="middle">Pengemaskinian Tujuan Pinjaman </th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
    <td><span class="style1" valign="middle">Nama Tujuan</span></td>
	 <td><span class="style1" valign="middle">Nama Pendaftar</span></td>
	<td><span class="style1" valign="middle">Tarikh Kemaskini</span></td>
	<td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_tujuan ORDER BY nama_tujuan ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>

				  <td align="center" valign="middle"><?php echo $n; ?>
				  <td align="left" valign="middle"><?php echo $t->nama_tujuan; ?></td>
				  <td align="left" valign="middle"><?php echo $t->nama; ?></td>
				  <td align="left" valign="middle"><?php echo $t->kemaskinit_tujuan; ?></td>
				  <td align="center" valign="middle">
				   <a href="update_tujuan.php?id_tujuan=<?php echo $t->id_tujuan; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_tujuan.php?id_tujuan=<?php echo $t->id_tujuan; ?>">DELETE</a></td></tr>
					 

				 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
