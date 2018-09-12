<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (isset($_GET['id_pesakit'])) {
//dptkan maklumat pengguna berdasarkan id
		$s = "SELECT * FROM tbl_pesakit
			WHERE id_pesakit = :id_pesakit
			ORDER BY id_pesakit ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_pesakit' => (int) $_GET['id_pesakit']
		));

//jika id adalah sah
		if ($q->rowCount()) {
			$t = $q->fetch(PDO::FETCH_OBJ);
			
			?>
			
               
<html>
<form method="post" action="update_pesakit2.php">
<h4>Pengemaskinian Maklumat Pesakit:</h4>

<table width="80%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="left" valign="middle" bgcolor="#CCCCCC">
<input name="id_pesakit" type="hidden" value="<?php echo $t->id_pesakit; ?>" id="id_pesakit"/></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC"> Nama Pesakit<span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->nama_pesakit; ?></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC"> NRIC Pesakit<span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->ic_pesakit; ?></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">ID TPC Pesakit<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="id_tpc" value="<?php echo $t->id_tpc; ?>" type="text" size="20" /></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Tarikh Discharge Pesakit: <span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="tarikh_dpesakit" value="<?php echo $t->tarikh_dpesakit; ?>" type="date" size="60" /></td>
</tr>


<tr><td align="right" valign="middle" bgcolor="#CCCCCC">Cara Discaj :<span class="teks4">*</span></td><td>
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

<tr><td align="right" valign="middle" bgcolor="#CCCCCC">Wad :<span class="teks4">*</span></td><td>
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
			
			
<tr><td colspan=2 valign="middle">
<input type="submit" name="btnSubmit" value="Kemaskini" />

<input type="reset" name="submit2" id="submit2" value="Reset" /></td>
</tr>
</table>
</form>
</html>
<?php
		}
		
		//jika id tidak sah
		else {
			echo '<meta http-equiv="Refresh" content="0;url=bht/search_akaun.php">';
		}
		
		$pdo == null;
	}
	
	//jika tiada id
	else {
		echo '<meta http-equiv="Refresh" content="0;url=bht/search_akaun.php">';
	}
?>