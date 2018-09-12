<?php
session_start();
if(!isset($_SESSION["username"]))
{header("Location:index.html");}
if(!isset($_SESSION["user_privilege"]))
{header("Location:index.html");}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Menu Utama</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2321" />
<style type="text/css">

div.header, div.footer
{	padding:0.5em;
color:#FFFFFF;
background-color:#FA8072;
clear:left;	}
h1.header
{	padding:0;
margin:0;	}

div.left
{	float:left;

width:180px;
margin:0;
padding:0.5em;	}

</style>

<script type="text/javascript">
function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
s=checkTime(s);
document.getElementById('txt').innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}
</script>


</Head>
<Body bgcolor="#8000000" text="snow" link="snow" vlink="snow">
<body onload="startTime()">

<div class="container">
<div class="header"><h1 class="header"><center>Daily Report System</center></h1>
<?php
echo "Employee: ";
echo $_SESSION["nama"];
echo "<br>";
echo "Tarikh:";
echo date("D dS M, Y");

?>
<div id="txt"></div>
</h1>
</div>
</div>
<div class="left">
<H3></H3>
<font size=2>
<p><a href=" " onClick="top.right.location.replace('menu.php');
return false">Main Menu</a><br> 

<?php
if (($_SESSION['user_user_privilege']=="administrator")) {
?>
<p><a href="#" onClick="top.right.location.replace('search_users.php');
return false">User Account</a><br>

<p><a href="#"  onClick="top.right.location.replace('search_department.php');
return false">Department</a><br>

<p><a href="#"  onClick="top.right.location.replace('search_discaj.php');
return false">Annual Leave</a><br>

<p><a href="#"  onClick="top.right.location.replace('search_tujuan.php');
return false">Fine</a><br>

<!-- <p><a href="#"  onClick="top.right.location.replace('search_pesakit.php');
return false">Kemaskini Maklumat Pesakit</a><br>

<p><a href="#"  onClick="top.right.location.replace('add_bht_c.php');
return false">Add BHT C</a><br> -->

<!-- <p><a href="#"  onClick="top.right.location.replace('search_register.php');
return false">REGISTER</a><br>

<p><a href="#"  onClick="top.right.location.replace('load data/search_byWardBHT.php');
return false">SEARCH BY WARD Pesakit</a><br> -->
-----------------------------------------------------------------
<?php
}
?>

<p><a href="#" onClick="top.right.location.replace('search_report.php');
return false">Report</a><br> 

<p><a href="#" onClick="top.right.location.replace('search_census.php');
return false">Annual Leave Info</a><br> 

<p><a href="#" onClick="top.right.location.replace('upload_census.php');
return false">Upload Daily Report</a><br>

<p><a href="#" onClick="top.right.location.replace('search_bht.php');
return false">Tambah Rekod BHT</a><br>

<p><a href="#" onClick="top.right.location.replace('search_bht_c.php');
return false">Tambah Rekod BHT Susulan</a><br>

<p><a href="#" onClick="top.right.location.replace('upload_register.php');
return false">testUploadExcel</a><br>

<!-- <p><a href="#" onClick="top.right.location.replace('search_lokasi_modal.php');
return false">Penempatan & Pemeriksaan</a><br>

<p><a href="#" onClick="top.right.location.replace('spesifikasi.php');
return false">Spesifikasi & Maklumat</a><br>

<p><a href="#" onClick="top.right.location.replace('penyelenggaraan.php');
return false">Penyelenggaraan</a><br>

<p><a href="#" onClick="top.right.location.replace('rangkaian.php');
return false">Rangkaian</a><br> -->

-----------------------------------------------------------------

<p><a href="#" onClick="top.right.location.replace('laporan.php');
return false">Laporan / Paparan</a><br>

<p><a href="#" onClick="top.right.location.replace('logout.php');
return false">Logout</a><br>



</font>
</Body>
<div class="footer">Hak Cipta: <br></div>
</Html>