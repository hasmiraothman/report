<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (($_SESSION['tahap']=="administrator") || ($_SESSION['tahap']=="regular user")) {
?>
<html>
<style> 
h1{ color:#CD5C5C;}
#example1 {
    background-image: url(big-data.jpg);
   opacity: 1;
    filter: alpha(opacity=50);
}
</style>
<body>
<h1 align="center">Selamat datang</h1>


<form method="post" action="add_register.php">
  <h4>Tambah Maklumat:</h4>
<table>

<tr><td><label>Tarikh Daftar: </label></td><td><input type="date" name="tarikh_daftar" required></td></tr>

<tr><td><label>Nama Pesakit: </label></td><td><input type="text" name="nama_pesakit" required></td></tr>

<tr><td><label>NRIC Pesakit: </label></td><td><input type="text" name="ic_pesakit" required></td></tr>

<tr><td><label>Alamat Pesakit: </label></td><td><textarea name="alamat_pesakit" rows="4" cols="50" required></textarea></td></tr>

<tr><td><label>No. Rawatan: </label></td><td><input type="text" name="no_rawatan" required></td></tr>

<tr><td><label>ID TPC Pesakit: </label></td><td><input type="text" name="id_tpc" required></td></tr>

<tr><td><label>Nama Kedatangan: </label></td><td>
<select name="nama_kedatangan" id="nama_kedatangan">
				<?php
				$sa = "SELECT * FROM kedatangan  ORDER BY nama_kedatangan ASC";
				$qa = $pdo->prepare($sa);
				$qa->execute();
				
				while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
					echo '<option value="' . $ta->nama_kedatangan . '">' . $ta->nama_kedatangan . '</option>';
				}
				?>
			  </select>
</td></tr>


<tr><td><label>Kategori Pesakit:</label></td><td>
	<select name="nama_kategori" id="nama_kategori">
	<?php
		$sa = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
		$qa = $pdo->prepare($sa);
		$qa->execute();
		while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
			echo '<option value="' . $ta->nama_kategori . '">' . $ta->nama_kategori . '</option>';
	}
	?>
	</select>
</td></tr>

<tr><td><label>Punca Rujukan:</label></td><td>
	<select name="nama_rujukan" id="nama_rujukan">
	<?php
	$sa = "SELECT * FROM rujukan ORDER BY nama_rujukan ASC";
	$qa = $pdo->prepare($sa);
	$qa->execute();
	while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
		echo '<option value="' . $ta->nama_rujukan . '">' . $ta->nama_rujukan . '</option>';
	}
	?>
</select></td></tr>

<tr><td><label>Disiplin:</label></td><td>
	<select name="nama_disiplin" id="nama_disiplin">
		<?php
		$sa = "SELECT * FROM disiplin ORDER BY nama_disiplin ASC";
		$qa = $pdo->prepare($sa);
		$qa->execute();
		while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
			echo '<option value="' . $ta->nama_disiplin . '">' . $ta->nama_disiplin . '</option>';
	}
	?>
</select></td></tr>

<tr><td><label>Assessment and Training:</label></td><td>
	<select name="nama_assessment" id="nama_assessment">
			<?php
		$sa = "SELECT * FROM assessment ORDER BY nama_assessment ASC";
		$qa = $pdo->prepare($sa);
		$qa->execute();
		while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
			echo '<option value="' . $ta->nama_assessment . '">' . $ta->nama_assessment . '</option>';
	}
	?>
</select></td></tr>

<tr><td><label>Diagnosis : </label></td><td><input type="text" name="nama_diagnosis" required></td></tr>

<tr><td><label>Tarikh Rawatan: </label></td><td><input type="date" name="tarikh_rawatan" required></td></tr>

<tr><td><label>Catatan : </label></td><td><input type="text" name="catatan_pesakit" required></td></tr>

</table>
<input name="btnSubmit" type="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=16 valign="middle">Pengemaskinian Maklumat</th></tr>
	
	<tr>
    <td><span class="style1" valign="middle">No.</span></td>
    <td><span class="style1" valign="middle">Tarikh Daftar</span></td>
	<td><span class="style1" valign="middle">Nama Pesakit</span></td>
    <td><span class="style1" valign="middle">NRIC Pesakit</span></td>
    
    <td><span class="style1" valign="middle">Alamat Pesakit</span></td>
    
    
	<td><span class="style1" valign="middle">No.Rawatan Pesakit</span></td>
    
    <td><span class="style1" valign="middle">Nama Kedatangan</span></td>
    <td><span class="style1" valign="middle">Nama Kategori</span></td>
    <td><span class="style1" valign="middle">Nama Rujukan</span></td>
    <td><span class="style1" valign="middle">Nama Disiplin</span></td>
    <td><span class="style1" valign="middle">Nama Assessement</span></td>
    <td><span class="style1" valign="middle">Diagnosis</span></td>
    <td><span class="style1" valign="middle">Tarikh Rawatan</span></td>
    <td><span class="style1" valign="middle">Catatan</span></td>


    <td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_register ORDER BY id_dpesakit ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>
				<td align="center" valign="middle"><?php echo $n; ?>
				<td align="left" valign="middle"><?php echo $t->tarikh_daftar; ?></td>
				<td align="left" valign="middle"><?php echo $t->nama_pesakit; ?></td>
				<td align="left" valign="middle"><?php echo $t->ic_pesakit; ?></td>
                <td align="left" valign="middle"><?php echo $t->alamat_pesakit; ?></td>
                <td align="left" valign="middle"><?php echo $t->no_rawatan; ?></td>
                 <td align="left" valign="middle"><?php echo $t->nama_kedatangan; ?></td>
                <td align="left" valign="middle"><?php echo $t->nama_kategori; ?></td>
                <td align="left" valign="middle"><?php echo $t->nama_rujukan; ?></td>
                <td align="left" valign="middle"><?php echo $t->nama_disiplin; ?></td>
                <td align="left" valign="middle"><?php echo $t->nama_assessment; ?></td>
                <td align="left" valign="middle"><?php echo $t->nama_diagnosis; ?></td>
                <td align="left" valign="middle"><?php echo $t->tarikh_rawatan; ?></td>
                <td align="left" valign="middle"><?php echo $t->catatan_pesakit; ?></td>

                <td align="center" valign="middle">
				<a href="update_register.php?id_dpesakit=<?php echo $t->id_dpesakit; ?>">UPDATE</a></td>
				<td align="center" valign="middle">
                <a href="delete_register.php?id_dpesakit=<?php echo $t->id_dpesakit; ?>">DELETE</a></td></tr>		 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
