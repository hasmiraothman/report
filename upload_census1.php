<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}
date_default_timezone_set("Asia/Kuala_Lumpur");

//import.php
if(!empty($_FILES['employee_file']['name']))
{
$connect = mysqli_connect("localhost", "root", "", "newbht");
$output = "";
$allowed_ext = array("csv");
$extension = end(explode(".", $_FILES["employee_file"]["name"]));
if(in_array($extension, $allowed_ext))
{
	$file_data = fopen ($_FILES["employee_file"]["tmp_name"], "r");
	fgetcsv($file_data);
	while ($row = fgetcsv($file_data))
	{
	$tarikh_census=mysqli_real_escape_string($connect, $row[0]);
	$wad=mysqli_real_escape_string($connect, $row[1]);
	$discaj=mysqli_real_escape_string($connect, $row[2]);
	$mati=mysqli_real_escape_string($connect, $row[3]);
	$absconded=mysqli_real_escape_string($connect, $row[4]);
	$DAMA=mysqli_real_escape_string($connect, $row[5]);
	$transfer=mysqli_real_escape_string($connect, $row[6]);
	$hidup=mysqli_real_escape_string($connect, $row[7]);
	$jumlah=mysqli_real_escape_string($connect, $row[8]);
	
	
		$query = "
		INSERT INTO tbl_census
		(tarikh_census, wad, discaj, mati, absconded, DAMA, transfer, hidup, jumlah, baki)
		VALUES ('$tarikh_census', '$wad', '$discaj', '$mati', '$absconded', 
		'$DAMA', '$transfer', '$hidup', '$jumlah', '$jumlah')
		";
		mysqli_query ($connect, $query);
		}
		$select = "SELECT * FROM tbl_census ORDER BY id_census DESC";
		$result = mysqli_query ($connect, $select);
		$output .= '<table class="table table-bordered">
		<tr>
			<th width="10%">No</th>
			<th width="25%">Tarikh Census</th>
			<th width="15%">Wad</th>
			<th width="10%">Balik Rumah</th>
			<th width="5%">Mati</th>
			<th width="10%">Absconded</th>
			<th width="5%">DAMA</th>
			<th width="10%">Transfer</th>
			<th width="10%">Hidup</th>
			<th width="10%">Jumlah</th>
			</tr>
			';
		while ($row=mysqli_fetch_array($result))
		{
			$output .= '
				<tr>
					<td>'.$row["id_census"].'</td>
					<td>'.$row["tarikh_census"].'</td>
					<td>'.$row["wad"].'</td>
					<td>'.$row["discaj"].'</td>
					<td>'.$row["mati"].'</td>
					<td>'.$row["absconded"].'</td>
					<td>'.$row["DAMA"].'</td>
					<td>'.$row["transfer"].'</td>
					<td>'.$row["hidup"].'</td>
					<td>'.$row["jumlah"].'</td>
				</tr>
				';
		}
	$output  .="</table>";
	echo $output;
	}
	

else
{
	echo "Error1";
}
}
else
{
	echo "Error2";
}
?>