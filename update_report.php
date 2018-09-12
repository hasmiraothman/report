<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (isset($_GET['id_pengguna'])) {
//dptkan maklumat pengguna berdasarkan id
		$s = "SELECT * FROM akaun
			WHERE id_pengguna = :id_pengguna
			ORDER BY id_pengguna ASC
			LIMIT 1
		";
		$q = $pdo->prepare($s);
		$q->execute(array(
			'id_pengguna' => (int) $_GET['id_pengguna']
		));

//jika id adalah sah
		if ($q->rowCount()) {
			$t = $q->fetch(PDO::FETCH_OBJ);
			
			?>
			
               
<html>
<form method="post" action="update_akaun1.php">
<h4>Pengemaskinian Akaun Pengguna:</h4>

<table width="80%" border="1" cellspacing="0" cellpadding="3">
<tr>
<td align="left" valign="middle" bgcolor="#CCCCCC">
<input name="id_pengguna" type="hidden" value="<?php echo $t->id_pengguna; ?>" id="id_pengguna"/></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Nama Pengguna<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="nama" value="<?php echo $t->nama; ?>" type="text" size="60" /></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC"> Nombor Penjawat<span class="teks4"></span></td>
<td align="left" valign="middle" bgcolor="#CCCCCC"><?php echo $t->ic_pengguna; ?></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Katalaluan Pengguna Baru<span class="teks4">*</span></td>
<td align="left" valign="middle"><input name="katalaluan" type="password"  size="60" required/></td>
</tr>

<tr>
<td align="right" valign="middle" bgcolor="#CCCCCC">Tahap Pengguna <span class="teks4">*</span></td>
<td align="left" valign="middle">
		<select name="tahap">
        	<option>administrator</option>
        	<option>regular user</option>
        	<option>moderator</option>
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