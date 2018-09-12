<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

//id dalam db ygprimary key
if (isset($_GET['id_dpesakit'])) {


//dptkan maklumat pengguna berdasarkan id
	//id kmk ubah dlm db kmk id_dpesakit
		$s = "SELECT * FROM tbl_register
			WHERE id_dpesakit = :id_dpesakit
			ORDER BY id_dpesakit ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_dpesakit' => (int) $_GET['id_dpesakit']
		));

//jika id adalah sah
		if ($q->rowCount()) {
			$t = $q->fetch(PDO::FETCH_OBJ);
			
			?>
			
               
<html>
<form method="post" action="update_register2.php">
<h4>Pengemaskinian Maklumat Pesakit:</h4>


 
<table width="80%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="left" valign="middle" bgcolor="#CCCCCC">
<input name="id_dpesakit" type="hidden" value="<?php echo $t->id_dpesakit; ?>" id="id_dpesakit"/></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Nama Pesakit<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="nama_pesakit" value="<?php echo $t->nama_pesakit; ?>" type="text" size="60" /></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">No. Siri Rawatan<span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->no_rawatan; ?></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">NRIC Pesakit<span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->ic_pesakit; ?></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Alamat<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="alamat_pesakit" value="<?php echo $t->alamat_pesakit; ?>" type="text" size="60" /></td>
</tr>

<tr><td align="right" valign="middle" bgcolor="#CCCCCC">Kedatangan<span class="teks4">*</span></td><td>
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



<tr><td align="right" valign="middle" bgcolor="#CCCCCC">Kategori Pesakit<span class="teks4">*</span></td><td>
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


<tr><td align="right" valign="middle" bgcolor="#CCCCCC">Punca Rujukan<span class="teks4">*</span></td><td>
<select name="nama_rujukan" id="nama_rujukan">
	<?php
		$sa = "SELECT * FROM rujukan ORDER BY nama_rujukan ASC";
		$qa = $pdo->prepare($sa);
		$qa->execute();
		while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
			echo '<option value="' . $ta->nama_rujukan . '">' . $ta->nama_rujukan . '</option>';
	}
	?>
	</select>
</td></tr>

<tr><td align="right" valign="middle" bgcolor="#CCCCCC">Disiplin <span class="teks4">*</span></td><td>
<select name="nama_disiplin" id="nama_disiplin">
	<?php
		$sa = "SELECT * FROM disiplin ORDER BY nama_disiplin ASC";
		$qa = $pdo->prepare($sa);
		$qa->execute();
		while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
			echo '<option value="' . $ta->nama_disiplin . '">' . $ta->nama_disiplin . '</option>';
	}
	?>
	</select>
</td></tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Asssessment and Training<span class="teks4">*</span></td>
<td><select name="nama_assessment" id="nama_assessment">
			<?php
		$sa = "SELECT * FROM assessment ORDER BY nama_assessment ASC";
		$qa = $pdo->prepare($sa);
		$qa->execute();
		while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
			echo '<option value="' . $ta->nama_assessment . '">' . $ta->nama_assessment . '</option>';
	}
	?>
</select></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Diagnosis<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="nama_diagnosis" value="<?php echo $t->nama_diagnosis; ?>" type="text" size="60" /></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Catatan<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="catatan_pesakit" value="<?php echo $t->catatan_pesakit; ?>" type="text" size="60" /></td>
</tr>

<tr><td colspan=2 valign="middle">
<input type="submit" name="submit" id="submit" value="Kemaskini" />

<input type="reset" name="submit2" id="submit2" value="Reset" /></td>
</tr>
</table>
</form>
</html>
<?php
		}
		
		//jika id tidak sah
		else {
			echo '<meta http-equiv="Refresh" content="0;url=occ/search_register.php">';
		}
		
		$pdo == null;
	}
	
	//jika tiada id
	else {
		echo '<meta http-equiv="Refresh" content="0;url=occ/search_register.php">';
	}
?>