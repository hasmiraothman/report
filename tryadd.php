
<?php
include("connect.php");


session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if (($_SESSION['tahap']=="administrator")|| ($_SESSION['tahap']=="regular user")) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset>
<title>bht</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
<div class="container" style="width:80%;">
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" name="query" id="query">
<Table>
<tr><td>
<label>TPC Pesakit No: </label></td>
<td>
<input type="text" name="id_tpc" id="id_tpc" />
    <label>
    <input type="submit" name="button" id="button" value="Submit" />
    </label>
	</td></tr>
</Table>
</form>


	<h4>Tambah BHT Pesakit:</h4>
    <?php
	$query = "SELECT * FROM tbl_census ORDER BY id_census ASC";	
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			?>
            <div class="col-md-4">
                <form method="post" action="tryadd2.php?action=submit&id_census=<?php echo $row["id_census"];?>">
<table>
    <tr><td>
<label>Tarikh Census: </label></td>
<td><input type="date" id="tarikh_census" name="tarikh_census"/>  (dd/mm/yyyy)</td></tr>

<tr><td><label>Wad: </label></td><td>
<select name="wad" id="wad">
				<?php
				$sa = "SELECT * FROM tbl_wad ORDER BY wad ASC";
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
 <input type="submit" name="submit" value="Insert">
 </form>
  </div>
  <?php
 
  }
}
?>
<div style="clear:both"></div>
<h2>My KLCK</h2>
<div class="table-responsive">

<table class="table table-bordered">
<tr>
  <th colspan=13 valign="middle">Pengemaskinian Banci Harian Wad</th>
  </tr>
  <tr>
  <td><span class="style1" valign="middle">ID Pesakit</span></td>
    <td><span class="style1" valign="middle">ID TPC</span></td>
	<td><span class="style1" valign="middle">NRIC Pesakit</span></td>
	<td><span class="style1" valign="middle">Nama Pesakit</span></td>
	<td><span class="style1" valign="middle">Wad</span></td>
	<td><span class="style1" valign="middle">Tarikh Census</span></td>
	<td><span class="style1" valign="middle">Jenis Discaj</span></td>
    <td><span class="style1" valign="middle">ID Census</span></td>
	<td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
<?php
if (!empty($_SESSION["nama"]))
{
	foreach($_SESSION["nama"] as $key => $values)
	{
		?>
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
				   <a href="update_bht.php?id=<?php echo $t->id_BHT; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_bht.php?id=<?php echo $t->id_BHT; ?>">DELETE</a></td></tr>
					 

				 
<?php
$pdo = NULL;
			}}}
				?>
</table>
<h4><a href="UserShoppingCart.php">&gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt; &gt;   Proced to next step</a></h4>
</div>
</div>
</body>
</html>
<?php
}
?>
