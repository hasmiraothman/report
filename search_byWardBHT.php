<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if ($_SESSION['tahap']=="administrator") {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loading MySQL Records on Drop Down Selection using PHP jQuery</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
<style type="text/css">
select{
	
	width:250px;
	padding:5px;
	border-radius:3px;
}
</style>
<script src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{		
	// function to get all records from table
	function getAll(){
		
		$.ajax
		({
			url: 'getproducts.php',
			data: 'action=showAll',
			cache: false,
			success: function(r)
			{
				$("#display").html(r);
			}
		});			
	}
	
	getAll();
	// function to get all records from table
	
	
	// code to get all records from table via select box
	$("#getProducts").change(function()
	{				
		var id = $(this).find(":selected").val();

		var dataString = 'action='+ id;
				
		$.ajax
		({
			url: 'getproducts.php',
			data: dataString,
			cache: false,
			success: function(r)
			{
				$("#display").html(r);
			} 
		});
	})
	// code to get all records from table via select box
});
</script>
</head>
<body>
<h1 align="center">Selamat datang ke Sistem Pengurusan BHT</h1>
<div class="container">
    	<div class="page-header">
        <h3>
        <select id="getProducts">
        <option value="showAll" selected="selected">Show All ward</option>
        <?php
        require_once 'config.php';
        
        $stmt = $dbcon->prepare('SELECT * FROM tbl_wad');
        $stmt->execute();
        
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $wad; ?>"><?php echo $wad; ?></option>
            <?php
        }
        ?>
        </select>
        </h3>
        </div>
    <blockquote>Load MySQL Records On Drop Down Selection</blockquote>
    <hr />
    
    <div class="" id="display">
       <!-- Records will be displayed here -->
    </div>
    


</div>


<form method="post" action="add_pesakit.php">
  <h4>Tambah Senarai Pesakit:</h4>
<table>

<select id="wad">
        <option value="wad" selected="selected">Wad</option>
        <?php
        require_once 'connect.php';
        
        $stmt = $dbcon->prepare('SELECT * FROM tbl_wad');
        $stmt->execute();
        
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $wad; ?>"><?php echo $wad; ?></option>
            <?php
        }
        ?>
    </select>
</table>
</form>
 
<table width="90%" border="1" bgcolor="#FFFFFF">
  <tr>
  <th colspan=14 valign="middle">Pengemaskinian Data Pesakit</th></tr>
  <tr><td><span class="style1" valign="middle">No.</span></td>
    <td><span class="style1" valign="middle">Tarikh </span></td>
	 <td><span class="style1" valign="middle">Wad</span></td>
	<td><span class="style1" valign="middle">ID TPC Pesakit</span></td>
    <td><span class="style1" valign="middle">RN Pesakit</span></td>
    <td><span class="style1" valign="middle">Nama Pesakit</span></td>
    <td><span class="style1" valign="middle">Cara Discaj</span></td>
	   
    <td><span class="style1" valign="middle">Kemaskini</span></td>
  	<td><span class="style1" valign="middle">Hapus</span></td>
  </tr>
  
 <?php
	$t = "SELECT * FROM tbl_pesakit ORDER BY id_pesakit ASC";
			$q = $pdo->prepare($t);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
?>

				  <td align="center" valign="middle"><?php echo $n; ?>
				  <td align="left" valign="middle"><?php echo $t->tarikh_dpesakit; ?></td>
				  <td align="left" valign="middle"><?php echo $t->wad; ?></td>
				  <td align="left" valign="middle"><?php echo $t->id_tpc; ?></td>
                  <td align="left" valign="middle"><?php echo $t->rn_pesakit; ?></td>
                  <td align="left" valign="middle"><?php echo $t->nama_pesakit; ?></td>
                  <td align="left" valign="middle"><?php echo $t->nama_discaj; ?></td>
                  <td align="center" valign="middle">
				   <a href="update_pesakit.php?id_pesakit=<?php echo $t->id_pesakit; ?>">UPDATE</a></td>
				    <td align="center" valign="middle">
					 <a href="delete_pesakit.php?id_pesakit=<?php echo $t->id_pesakit; ?>">DELETE</a></td></tr>
					 
				 
<?php
$pdo = NULL;
			}
				?>

</table></body>
</html>
<?php
}
?>
