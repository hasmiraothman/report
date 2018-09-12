<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (isset($_GET['id_census'])) {
//dptkan maklumat pengguna berdasarkan id
		$s = "SELECT * FROM tbl_census
			WHERE id_census= :id_census
			ORDER BY id_census ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_census' => (int) $_GET['id_census']
		));

//jika id adalah sah
		if ($q->rowCount()) {
			$t = $q->fetch(PDO::FETCH_OBJ);
			
			?>
			
               
<html>
<form method="post" action="update_census2.php">
<h4>Pengemaskinian Census:</h4>

<table width="80%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="left" valign="middle" bgcolor="#CCCCCC">
<input name="id_census" type="hidden" value="<?php echo $t->id_census; ?>" id="id_census"/></td>
</tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC"> Tarikh Census <span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->tarikh_census; ?></td>
</tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Nama Wad<span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->wad; ?></td></tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Balik Rumah<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="discaj" type="text"  size="12" required/></td>
</tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Mati<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="mati" type="text"  size="12" required/></td>
</tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Absconded<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="absconded" type="text"  size="12" required/></td>
</tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">DAMA<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="DAMA" type="text"  size="12" required/></td>
</tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Transfer<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="transfer" type="text"  size="12" required/></td>
</tr>
<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Hidup<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="hidup" type="text"  size="12" required/></td>
</tr>


	
<tr><td colspan=2 valign="middle">
<input type="submit" name="btnSubmit" value="Kemaskini" />
<input type="reset" name="submit2" id="submit2" value="Reset" />
</td></tr>

</table>
</form>
</html>
<?php
		}
		
		//jika id tidak sah
		else {
			echo '<meta http-equiv="Refresh" content="0;url=bht/search_census.php">';
		}
		
		$pdo == null; 
	}
	
	//jika tiada id
	else {
		echo '<meta http-equiv="Refresh" content="0;url=bht/search_census.php">';
	}
?>