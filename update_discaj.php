<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (isset($_GET['id_discaj'])) {
//dptkan maklumat pengguna berdasarkan id
		$s = "SELECT * FROM discaj
			WHERE id_discaj = :id_discaj
			ORDER BY id_discaj ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_discaj' => (int) $_GET['id_discaj']
		));

//jika id adalah sah
		if ($q->rowCount()) {
			$t = $q->fetch(PDO::FETCH_OBJ);
			
			?>
			
               
<html>
<form method="post" action="update_discaj1.php">
<h4>Pengemaskinian Cara Discaj:</h4>

<table width="80%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="left" valign="middle" bgcolor="#CCCCCC">
<input name="id_discaj" type="hidden" value="<?php echo $t->id_discaj; ?>" id="id"/></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Nama Discaj<span class="teks4">*</span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->nama_discaj; ?></td></tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">IC Staf Pendaftar<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="ic_staf_daftar" type="text"  size="12" required/></td>
</tr>


<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC"> Tarikh Daftar  <span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><input name="tarikh_discaj" type="date"  value="2016-12-22" required/></td>
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
			echo '<meta http-equiv="Refresh" content="0;url=bht/search_discaj.php">';
		}
		
		$pdo == null;
	}
	
	//jika tiada id
	else {
		echo '<meta http-equiv="Refresh" content="0;url=bht/search_discaj.php">';
	}
?>