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
h1{ color:#ff6347;}
#example1 {
    background-image: url(big-data.jpg);
   opacity: 1;
    filter: alpha(opacity=50);
}
</style>
<body>
<h1 align="center">Selamat datang ke Sistem Pengurusan BHT</h1>


<form method="post" action="add_census.php">
  <h4>Tambah Cencus:</h4>
<table>

<tr><td><label>Tarikh Census: </label></td><td><input type="date" name="tarikh_census" required></td></tr>

<tr><td><label>Wad: </label></td><td>
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
<tr><td><label>Discaj: </label></td>
<td><input type="text" name="discaj" required></td></tr>

<tr><td><label>Mati: </label></td><td><input type="text" name="mati" required></td></tr>

<tr><td><label>Absconded: </label></td><td><input type="text" name="absconded" required></td></tr>

<tr><td><label>DAMA: </label></td><td><input type="text" name="DAMA" required></td></tr>

<tr><td><label>Transfer: </label></td><td><input type="text" name="transfer" required></td></tr>

<tr><td><label>Hidup: </label></td><td><input type="text" name="hidup" required></td></tr>

</table>
<input name="btnSubmit" type="submit" value="Insert">

<p><strong>Note:</strong> type="time" is not supported in Firefox, or Internet Explorer 12 and earlier versions.</p>
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=14 valign="middle">Pengemaskinian Cencus</th></tr>
	
	<tr>
    <td><span class="style1" valign="middle">No.</span></td>
    <td><span class="style1" valign="middle">Tarikh Cencus</span></td>
	<td><span class="style1" valign="middle">Wad</span></td>
	<td><span class="style1" valign="middle">Discaj</span></td>
    <td><span class="style1" valign="middle">Mati</span></td>
    <td><span class="style1" valign="middle">Absconded</span></td>
    <td><span class="style1" valign="middle">DAMA</span></td>
	<td><span class="style1" valign="middle">Transfer</span></td>
    <td><span class="style1" valign="middle">Hidup</span></td>
	<td><span class="style1" valign="middle">Tarikh Kemaskini</span></td> 
    <td><span class="style1" valign="middle">Nama Pendaftar</span></td>  
	<td><span class="style1" valign="middle">Jumlah</span></td>     
    <td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_census ORDER BY id_census ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>
				<td align="center" valign="middle"><?php echo $n; ?>
				<td align="left" valign="middle"><?php echo $t->tarikh_census; ?></td>
				<td align="left" valign="middle"><?php echo $t->wad; ?></td>
				<td align="left" valign="middle"><?php echo $t->discaj; ?></td>
                <td align="left" valign="middle"><?php echo $t->mati; ?></td>
                <td align="left" valign="middle"><?php echo $t->absconded; ?></td>
                <td align="left" valign="middle"><?php echo $t->DAMA; ?></td>
                <td align="left" valign="middle"><?php echo $t->transfer; ?></td>
                <td align="left" valign="middle"><?php echo $t->hidup; ?></td>
                <td align="left" valign="middle"><?php echo $t->tarikh; ?></td>
                <td align="left" valign="middle"><?php echo $t->nama; ?></td>
				<td align="left" valign="middle"><?php echo $t->jumlah; ?></td> 
                <td align="center" valign="middle">
				<a href="update_census.php?id_census=<?php echo $t->id_census; ?>">UPDATE</a></td>
				<td align="center" valign="middle">
                <a href="delete_census.php?id_census=<?php echo $t->id_census; ?>">DELETE</a></td></tr>		 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
