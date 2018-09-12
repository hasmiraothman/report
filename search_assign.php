<?php
include("connect.php");


session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

?>
<html>

<script type="text/javascript">
    var datefield=document.createElement("input")
    datefield.setAttribute("type", "date")
    if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
        document.write('<link href="css/date.css" rel="stylesheet" type="text/css" />\n')
        document.write('<script src="jquery/jquery.min.js"><\/script>\n')
        document.write('<script src="jquery/jquery-ui.min.js"><\/script>\n')
    }
</script>

<script>
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
    jQuery(function($){ //on document.ready
        $('#tarikh_census').datepicker();
		$('#tarikh_discaj').datepicker();
		 $('#waktu_tarikh_pinjam').datepicker();
    })
}
</script>


<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="query";">
<Table>
<tr><td>
<label for="date">TPC Pesakit No: </label></td>
<td>
<input type="text" name="id_tpc" id="id_tpc" />
    <label>
    <input type="submit" name="button" id="button" value="Submit" />
    </label>
	</td></tr>
</Table>
</form>


<form method="post" action="add_bht.php">
<h4>Tambah BHT Pesakit:</h4>
<table>
<tr><td>
<label>Tarikh Census: </label></td>
<td><input type="date" id="tarikh_census" name="tarikh_census" size="20"/>  (mm/dd/yyyy)</td></tr>
<tr><td><label>Wad: </label></td><td>
<select name="nama_wad" id="nama_wad">
				<?php
				$sa = "SELECT * FROM tbl_wad  ORDER BY wad ASC";
				$qa = $pdo->prepare($sa);
				$qa->execute();
				
				while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
					echo '<option value="' . $ta->wad . '">' . $ta->wad . '</option>';
				}
				?>
			  </select></td></tr>
<tr><td>

<?php 
if(isset($_POST["id_tpc"]))
{
echo "ID TPC";
?>
</td><td>
<?php
$id_tpc = $_POST['id_tpc'];

	$tb = "SELECT * FROM pesakit
	where id_tpc = '$id_tpc'
	UNION 
	SELECT  * FROM pesakit1
	where id_tpc = '$id_tpc'
	order by id_tpc DESC LIMIT 1
	
	";
	$qb = $pdo->prepare($tb);
	$qb->execute();
	while ($yb = $qb->fetch(PDO::FETCH_OBJ)) {
			?>
<input name="id_tpc" id="id_tpc" value="<?php echo $yb->id_tpc; ?>"  />
</td></tr>
<tr><td>ID Pesakit</td>
<td><input name="id_pesakit" id="id_pesakit" value="<?php echo $yb->id_pesakit; ?>"  /></td></tr>
<tr><td>NRIC Pesakit</td>
<td><input name="rn_pesakit" id="rn_pesakit" value="<?php echo $yb->rn_pesakit; ?>"  /></td></tr>
<tr><td>Nama Pesakit</td>
<td><input name="nama_pesakit" id="nama_pesakit" value="<?php echo $yb->nama_pesakit; ?>"  /></td></tr>


<?php
}}
?>
<tr><td><label>Cara Discaj: </label></td><td>
<select name="nama_discaj" id="nama_discaj">
				<?php
				$sa = "SELECT * FROM discaj  ORDER BY id_discaj ASC";
				$qa = $pdo->prepare($sa);
				$qa->execute();
				
				while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
					echo '<option value="' . $ta->nama_discaj . '">' . $ta->nama_discaj . '</option>';
				}
				?>
			  </select></td></tr>

</table>
<h4>Catatan:  Selepas tambah BHT pesakit --> akan 'link' kepada <br>
Tambah rekod BHT Susulan<br>
untuk kemasukan rekod BHT seterusnya.
</h4>
<input type="submit" name="submit" value="Insert">
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=13 valign="middle">Pengemaskinian Banci Harian Wad</th></tr>
  <tr><td><span class="style1" valign="middle">ID Pesakit</span></td>
    <td><span class="style1" valign="middle">ID TPC</span></td>
	 <td><span class="style1" valign="middle">NRIC Pesakit</span></td>
	<td><span class="style1" valign="middle">Nama Pesakit</span></td>
	<td><span class="style1" valign="middle">Wad</span></td>
	<td><span class="style1" valign="middle">Tarikh Census</span></td>
	<td><span class="style1" valign="middle">Jenis Discaj</span></td>
	<td><span class="style1" valign="middle">Nama Pengguna</span></td>
	<td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
 $user = $_SESSION["nama"];
 
	$t = "SELECT * FROM bht 
	where nama_akaun = '$user'
	ORDER BY id_BHT DESC  limit 20";
			$q = $pdo->prepare($t);
			$q->execute();
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
			
?>

				  <td align="center" valign="middle"><?php echo $t->id_pesakit; ?>
				  <td align="center" valign="middle"><?php echo $t->id_tpc; ?></td>
				  <td align="center" valign="middle"><?php echo $t->rn_pesakit; ?></td>
				  <td align="center" valign="middle"><?php echo $t->nama_pesakit; ?></td>
				  <td align="center" valign="middle"><?php echo $t->nama_wad; ?></td>
				  <td align="center" valign="middle"><?php echo $t->tarikh_census; ?></td>
				  <td align="center" valign="middle"><?php echo $t->jenis_discaj; ?></td>
				  <td align="center" valign="middle"><?php echo $t->nama_akaun; ?></td>
				  <td align="center" valign="middle">
				   <a href="update_bht.php?id=<?php echo $t->id_BHT; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_bht.php?id=<?php echo $t->id_BHT; ?>">DELETE</a></td></tr>
					 

				 
<?php
$pdo = NULL;
			}
				?>

</table>
</html>