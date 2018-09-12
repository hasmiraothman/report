<?php
include("connect.php");


session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (($_SESSION['tahap']=="administrator")) {
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

<h4>Tambah Banci Harian Wad:</h4>
<table>
<tr><td>
<label>Tarikh Census: </label></td>
<td>

<?php
	$ta = "SELECT distinct tarikh_census FROM tbl_bht
	ORDER BY id_bht DESC limit 1";
	
			$qt = $pdo->prepare($ta);
			$qt->execute();
			while ($y = $qt->fetch(PDO::FETCH_OBJ)) {
			?>
<input name="tarikh_census" id="tarikh_census" value="<?php echo $y->tarikh_census; ?>" type="date" />
</td></tr>
<?php
}
?>


<tr><td><label for="nama_wad">Wad: </label></td><td>
<select name="wad" id="wad">
				<?php
				$sa = "SELECT * FROM tbl_bht
				ORDER BY id_bht DESC limit 1";
				$qa = $pdo->prepare($sa);
				$qa->execute();
				
				while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
					echo '<option value="' . $ta->wad . '">' . $ta->wad . '</option>';
				}
				?>
			  </select></td></tr>
<tr><td>

</td></tr>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="query";">
<tr><td>
<label for="date">TPC Pesakit No: </label></td>
<td>
<input type="text" name="id_tpc" id="id_tpc" />
    <label>
    <input type="submit" name="button" id="button" value="Submit" />
    </label>
	</td></tr>
</form>
<tr><td>


<?php 
if(isset($_POST["id_tpc"]))
{
echo "ID TPC";
?>
</td><td>
<?php
$id_tpc = $_POST['id_tpc'];

	$tb = "SELECT * FROM tbl_pesakit
	where id_tpc = '$id_tpc'
	UNION 
	SELECT  * FROM tbl_pesakit1
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
<td><input name="ic_pesakit" id="ic_pesakit" value="<?php echo $yb->ic_pesakit; ?>"  /></td></tr>
<tr><td>Nama Pesakit</td>
<td><input name="nama_pesakit" id="nama_pesakit" value="<?php echo $yb->nama_pesakit; ?>"  /></td></tr>


<?php
}}
?>

<tr><td><label>Cara Discaj: </label></td><td>
<select name="discaj" id="discaj">
				<?php
				$sa = "SELECT * FROM discaj ORDER BY nama_discaj ASC ";
				$qa = $pdo->prepare($sa);
				$qa->execute();
				
				while ($ta = $qa->fetch(PDO::FETCH_OBJ)) {
					echo '<option value="' . $ta->nama_discaj . '">' . $ta->nama_discaj . '</option>';
				}
				?>
			  </select></td></tr>			


</table>
<input type="submit" value="Insert">
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
    <td><span class="style1" valign="middle">No.Census</span></td>
	<td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_bht 
	ORDER BY id_bht DESC  limit 20";
			$q = $pdo->prepare($t);
			$q->execute();
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
			
?>

				  <td align="center" valign="middle"><?php echo $t->id_pesakit; ?>
				  <td align="center" valign="middle"><?php echo $t->id_tpc; ?></td>
				  <td align="center" valign="middle"><?php echo $t->ic_pesakit; ?></td>
				  <td align="center" valign="middle"><?php echo $t->nama_pesakit; ?></td>
				  <td align="center" valign="middle"><?php echo $t->wad; ?></td>
				  <td align="center" valign="middle"><?php echo $t->tarikh_census; ?></td>
				  <td align="center" valign="middle"><?php echo $t->nama_discaj; ?></td>
                  <td align="center" valign="middle"><?php echo $t->id_census; ?></td>
				  <td align="center" valign="middle">
				   <a href="update_census.php?id=<?php echo $t->no_census; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_census.php?id=<?php echo $t->no_census; ?>">DELETE</a></td></tr>
					 

				 
<?php
$pdo = NULL;
			}
				?>

</table>
</html>
<?php
}
?>