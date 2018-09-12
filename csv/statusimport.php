<?php
//import.php
if(!empty($_FILES['try_file']['name']))
{
	$connect = mysqli_connect("localhost", "root", "", "newbht");
	$output = "";
	$allowed_ext = array("csv");
	$extension = end(explode(".", $_FILES["try_file"]["name"]));
	if(in_array($extension, $allowed_ext))
	{
		$file_data = fopen($_FILES["try_file"]["tmp_name"], "r");
		fgetcsv($file_data);
		while($row = fgetcsv($file_data))
		{
			$wad = mysqli_real_escape_string($connect, $row[0]);
			$dama = mysqli_real_escape_string($connect, $row[1]);
			$mati = mysqli_real_escape_string($connect, $row[2]);
			$hidup = mysqli_real_escape_string($connect, $row[3]);
 			$transfer = mysqli_real_escape_string($connect, $row[4]);
			$jumlah = mysqli_real_escape_string($connect, $row[5]);
			$query = "
				INSERT INTO tbl_try
				(wad, dama, mati, hidup, transfer, jumlah)
				VALUES ('$wad', '$dama', '$mati', '$hidup', '$transfer', '$jumlah')
			";
			mysqli_query($connect, $query);
		}
		$select = "SELECT * FROM tbl_try ORDER BY id DESC";
		$result = mysqli_query($connect, $select);
		$output .= '
			<table class="table table-bordered">
				<tr>
					<th width="5%">ID</th>
					<th width="20%">Wad</th>
					<th width="35%">Dama</th>
					<th width="10%">Mati</th>
					<th width="20%">Hidup</th>
					<th width="5%">Transfer</th>
					<th width="5%">Jumlah</th>
				</tr>
		';
		while($row = mysqli_fetch_array($result))
		{
			$output .= '
				<tr>
					<td>'.$row["id"].'</td>
					<td>'.$row["wad"].'</td>
					<td>'.$row["dama"].'</td>
					<td>'.$row["mati"].'</td>
					<td>'.$row["hidup"].'</td>
					<td>'.$row["tranfer"].'</td>
					<td>'.$row["jumlah"].'</td>
				</tr>
			';
		}
		$output .= "</table>";
		echo $output;
	}
	else
	{
		echo "Error1";
	}
}
else
{
	echo 'Error2';
}
?>