<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if ($_SESSION['tahap']=="administrator") {
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


<form method="post" action="add_pesakit.php">
  <h4>Tambah Senarai Pesakit:</h4>
<table>

<tr><td><label>Tarikh: </label></td><td><input type="date" name="tarikh_dpesakit" value="<?php echo date('Y-m-d');?>" ></td></tr>

<tr><td><label>Wad: </label></td><td>
<select name="wad" id="wad">
				<?php
				$sa = "SELECT * FROM tbl_wad  ORDER BY wad ASC";
				$qa = $pdo->prepare($sa);
				$qa->execute();
				
				while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
					echo '<option value="' . $ta->wad . '">' . $ta->wad . '</option>';
				}
				?>
			  </select>
</td></tr>
<tr><td><label>Id TPC Pesakit: </label></td><td><input type="text" name="id_tpc" required></td></tr>

<tr><td><label>Nama Pesakit: </label></td><td><input type="text" name="nama_pesakit" required></td></tr>

<tr><td><label>NRIC Pesakit: </label></td><td><input type="text" name="ic_pesakit" required></td></tr>


<tr><td><label>Cara Discaj : </label></td><td>
<select name="nama_discaj" id="nama_discaj">
				<?php
				$sa = "SELECT * FROM tbl_discaj  ORDER BY nama_discaj ASC";
				$qa = $pdo->prepare($sa);
				$qa->execute();
				
				while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
					echo '<option value="' . $ta->nama_discaj . '">' . $ta->nama_discaj . '</option>';
				}
				?>
			  </select>
</td></tr>
</table>
<input name="btnSubmit" type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=14 valign="middle">Pengemaskinian Data Pesakit</th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
    <td><span class="style1" valign="middle">Tarikh </span></td>
	 <td><span class="style1" valign="middle">Wad</span></td>
	<td><span class="style1" valign="middle">ID TPC Pesakit</span></td>
    <td><span class="style1" valign="middle">NRIC Pesakit</span></td>
    <td><span class="style1" valign="middle">Nama Pesakit</span></td>
    <td><span class="style1" valign="middle">Cara Discaj</span></td>
	
    <td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_pesakit ORDER BY id_pesakit ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>

				  <td align="center" valign="middle"><?php echo $n; ?>
				  <td align="left" valign="middle"><?php echo $t->tarikh_dpesakit; ?></td>
				  <td align="left" valign="middle"><?php echo $t->wad; ?></td>
				  <td align="left" valign="middle"><?php echo $t->id_tpc; ?></td>
                  <td align="left" valign="middle"><?php echo $t->ic_pesakit; ?></td>
                  <td align="left" valign="middle"><?php echo $t->nama_pesakit; ?></td>
                  <td align="left" valign="middle"><?php echo $t->nama_discaj; ?></td>
                  <td align="center" valign="middle">
				   <a href="update_pesakit.php?id_pesakit=<?php echo $t->id_pesakit; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_pesakit.php?id_pesakit=<?php echo $t->id_pesakit; ?>">DELETE</a></td></tr>
					 
				 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
