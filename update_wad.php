<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (isset($_GET['id_wad'])) {
//dptkan maklumat pengguna berdasarkan id
		$s = "SELECT * FROM tbl_wad
			WHERE id_wad = :id_wad
			ORDER BY id_wad ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_wad' => (int) $_GET['id_wad']
		));

//jika id adalah sah
		if ($q->rowCount()) {
			$t = $q->fetch(PDO::FETCH_OBJ);
			
			?>
			
               
<html>
<form method="post" action="update_wad1.php">
<h4>Pengemaskinian Wad:</h4>

<table width="80%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="left" valign="middle" bgcolor="#CCCCCC">
<input name="id_wad" type="hidden" value="<?php echo $t->id_wad; ?>" id="id"/></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Nama Wad<span class="teks4">*</span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->wad; ?></td></tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">IC Staf Pendaftar<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="ic_staf_daftar" type="text"  size="12" required/></td>
</tr>


<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC"> Tarikh Daftar  <span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><input name="tarikhwad" type="date"  value="2016-12-22" required/></td>
</tr>

			
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