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

<form method="post" action="add_csv.php">
  <h4>Penerimaan Casenote:</h4>
<table>
<tr><td>
<label>Tarikh terima: </label></td><td><input type="date" name="tarikh_terima" required/>(mm/dd/yyyy)</td></tr>
<tr><td>Wad: </td><td><select name="wad" required/>
        <option>pediatrik</option>
        <option>Hemo</option>
        <option>Psikatrik</option>
        </select>
</td></tr>
<tr><td><label>Balik Rumah: </label></td><td><input type="text" name="discharge" required></td></tr>
<tr><td><label>Mati: </label></td><td><input type="text" name="mati" required></td></tr>
<tr><td><label>DAMA: </label></td><td><input type="text" name="dama" required></td></tr>
<tr><td><label>Polis: </label></td><td><input type="text" name="polis" required></td></tr>
<tr><td><label>Hidup: </label></td><td><input type="text" name="hidup" required></td></tr>
</table>
<input name="btnSubmit" type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=13 valign="middle">Pengemaskinian Data Casenote</th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
  <td><span class="style1" valign="middle">Wad</span></td>
	<td><span class="style1" valign="middle">Tarikh Terima</span></td>
    <td><span class="style1" valign="middle">Tarikh Pinjam</span></td>
    <td><span class="style1" valign="middle">Tarikh Hantar</span></td>
    <td><span class="style1" valign="middle">Balik Rumah</span></td>
	<td><span class="style1" valign="middle">Mati</span></td>
	<td><span class="style1" valign="middle">DAMA</span></td>
    <td><span class="style1" valign="middle">Polis</span></td>
    <td><span class="style1" valign="middle">Hidup</span></td>
	<td><span class="style1" valign="middle">Jumlah Hantar</span></td>
	<td><span class="style1" valign="middle">Jumlah Sebenar</span></td>
	<td><span class="style1" valign="middle">Jumlah Hari</span></td>
	<td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_casenote ORDER BY wad ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>

				  <td align="center" valign="middle"><?php echo $n; ?>
				  <td align="left" valign="middle"><?php echo $t->wad; ?></td>
				  <td align="left" valign="middle"><?php echo $t->tarikh_terima; ?></td>
                  <td align="left" valign="middle"><?php echo $t->tarikh_pinjam; ?></td> 
                  <td align="left" valign="middle"><?php echo $t->tarikh_hantar; ?></td>
                  <td align="left" valign="middle"><?php echo $t->discharge; ?></td>
				  <td align="left" valign="middle"><?php echo $t->mati; ?></td>
				  <td align="left" valign="middle"><?php echo $t->dama; ?></td>
				  <td align="left" valign="middle"><?php echo $t->polis; ?></td>
				  <td align="left" valign="middle"><?php echo $t->hidup; ?></td>
				  <td align="left" valign="middle"><?php echo $t->jumlah_hantar; ?></td>
				  <td align="left" valign="middle"><?php echo number_format(($t->discharge)+($t->mati)+($t->dama)+($t->polis)+($t->hidup)); ?></td>
				  <td align="left" valign="middle"><?php echo number_format(($t->tarikh_hantar)-($t->tarikh_pinjam)); ?></td>
				  <td align="center" valign="middle">
				   <a href="update_akaun.php?id_pengguna=<?php echo $t->id; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_akaun.php?id_pengguna=<?php echo $t->id; ?>">DELETE</a></td></tr>				 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
