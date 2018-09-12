<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (isset($_GET['id_tujuan'])) {



//dptkan maklumat pengguna berdasarkan id
		$s = "SELECT * FROM tbl_tujuan
			WHERE id_tujuan = :id_tujuan
			ORDER BY id_tujuan ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_tujuan' => (int) $_GET['id_tujuan']
		));

//jika id adalah sah
		if ($q->rowCount()) {
			$t = $q->fetch(PDO::FETCH_OBJ);
			
			?>
			
               
<html>
<form method="post" action="update_tujuan1.php">
<h4>Update Tujuan Information:</h4>


 
<table width="80%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="left" valign="middle" bgcolor="#CCCCCC">
<input name="id_tujuan" type="hidden" value="<?php echo $t->id_tujuan; ?>" id="id_tujuan"/></td>



</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC"> Nama Tujuan<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="nama_tujuan" value="<?php echo $t->nama_tujuan; ?>" type="text" size="60" Required/></td>
</tr>


<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Note<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="catatan_tujuan" value="<?php echo $t->catatan_tujuan; ?>" type="text" size="60" /></td>
</tr>
			
<tr><td colspan=2 valign="middle">
<input type="submit" name="submit" id="submit" value="Update" />

<input type="reset" name="submit2" id="submit2" value="Reset" /></td>
</tr>
</table>
</form>
</html>
<?php
		}
		
		//jika id tidak sah
		else {
			echo '<meta http-equiv="Refresh" content="0;url=occ/search_tujuan.php">';
		}
		
		$pdo == null;
	}
	
	//jika tiada id
	else {
		echo '<meta http-equiv="Refresh" content="0;url=occ/search_tujuan.php">';
	}
?>