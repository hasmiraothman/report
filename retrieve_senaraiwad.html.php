<?php
include("connect.php");
date_default_timezone_set("Asia/Kuala_Lumpur");


session_start();
if(!isset($_SESSION["login"]))
	header("Location: ".$APP_URL."/casenotes/admin/logmasuk.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pentadbiran Sistem Casenotes Hospital Sibu</title>
<link href="include/layout2.css" rel="stylesheet" type="text/css" />
<link href="include/font.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>

<body bgcolor="#FFFFFF">
<div id="header">
	<div id="headermain">
  </div>
</div>
<div id="nav" align="left">
<?php if (!$_SESSION["tahap"]=="Pentadbir") {?>
  <p><a href="index.php">01.Modul Pendaftaran Kad Pegawai</a> | <a href="barcodegen/">02.Modul Menjana Barcode ID</a> | <a href="daftarpentadbir.html.php">03.Modul Pendaftaran Pentadbir </a> | <span class="style1"><a href="rptStafList.html.php" target="_blank">04.Senarai Nama Staf</a></span> 
  |05.Modul Pendaftaran Lokasi</a> |  <a href="logkeluar.php">Log Keluar</a></p> 
  <h2>
<p><br />
 <a href="http://10.175.129.30/casenotes/admin/add_senaraiwad.php">Tambah Lokasi Pinjaman Casenotes Baru</a> 

</p>
</h2>

<form id="spm" name="spm" method="post" action="delete_senaraiwad.php">
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
<tr>
		<td height="70" colspan="5" align="center" valign="middle" bgcolor="#00CED1" class="teks1"><h3>.:: Senarai Lokasi ::.</h3></td>
	  </tr>
	  		  
			<tr class="teks5">
			  <td width="37" align="center" valign="middle" bgcolor="#A9A9A9">Bil</td>
			  <td width="550" align="center" valign="middle" bgcolor="#A9A9A9">Senarai Lokasi</td>
			  <td width="250" align="center" valign="middle" bgcolor="#A9A9A9">IC Pendaftar</td>
			  <td width="50" colspan="2" align="center" valign="middle" bgcolor="#A9A9A9">Tindakan</td>
			</tr>

<?php			
//susun senaraiwad
			$s = "SELECT * FROM senaraiwad where flag=0 ORDER BY senaraiwad ASC";
			$q = $pdo->prepare($s);
			$q->execute();
			$n = 0;
			while ($t = $q->fetch(PDO::FETCH_OBJ)) {
				$n += 1;
				?>
					
				  <td align="center" valign="middle" bgcolor="#F5F5DC"><?php echo $n; ?>
				  <input name="lokasiID" id="lokasiID" bgcolor="#F5F5DC" 
				  value="<?php echo $t->lokasiID; ?>" type="hidden" />
				  <td align="left" valign="middle" bgcolor="#F5F5DC"><?php echo $t->senaraiwad; ?></td>
				  <td align="left" valign="middle" bgcolor="#F5F5DC"><?php echo $t->ic_pengguna; ?></td>
				  <td align="center" valign="middle" FONT COLOR="#0000FF">
				  <a href="http://10.175.129.30/casenotes/admin/delete_senaraiwad.php?id=<?php echo $t->lokasiID; ?>">HAPUS</a></td>
				             	

				  
				  </td>
				  
				</tr>
	<?php
			}
		
			
			if (!$n) {
				?>
			  <tr>
				<td colspan="6" align="center" valign="middle">TIADA MAKLUMAT LOKASI</td>
			  </tr>
			<?php
			}
			?>
		  </table>
		</td>
	  </tr>
	  <tr>
		<td colspan="2" align="center" valign="middle" bgcolor="#0000FF" class="teks2">Copyright 2013 : Hakcipta Terpelihara</td>
	  </tr>
	</table>

  <?php } ?>
<?php if ($_SESSION["tahap"]=="Pengguna") {?>  
    <p><a href="03_senarai.php">01.Modul Laporan</a> | <a href="logkeluar.php">Log Keluar</a></p> <?php } ?>
</div>
</form>
</body>
</html>