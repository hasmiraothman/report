<?php
//import.php
if(!empty($_FILES['casenote_file']['name']))
{
	$connect = mysqli_connect("localhost", "root", "", "newbht");
	$output = "";
	$allowed_ext = array("csv");
	$extension = end(explode(".", $_FILES["casenote_file"]["name"]));
	if(in_array($extension, $allowed_ext))
	{
		$file_data = fopen($_FILES["casenote_file"]["tmp_name"], "r");
		fgetcsv($file_data);
		while($row = fgetcsv($file_data))
		{
			$wad = mysqli_real_escape_string($connect, $row[0]);
			$tarikh_terima = mysqli_real_escape_string($connect, $row[1]);
			$tarikh_pinjam = mysqli_real_escape_string($connect, $row[2]);
			$tarikh_hantar = mysqli_real_escape_string($connect, $row[3]);
 			$discharge = mysqli_real_escape_string($connect, $row[4]);
			$mati = mysqli_real_escape_string($connect, $row[5]);
			$dama = mysqli_real_escape_string($connect, $row[6]);
			$polis = mysqli_real_escape_string($connect, $row[7]);
			$hidup = mysqli_real_escape_string($connect, $row[8]);
			$jumlah_hantar = mysqli_real_escape_string($connect, $row[9]);
			$jumlah_sebenar = mysqli_real_escape_string($connect, $row[10]);
			$jumlah_hari = mysqli_real_escape_string($connect, $row[11]);
			$query = "
				INSERT INTO tbl_casenote
				(wad, tarikh_terima, tarikh_pinjam, tarikh_hantar, discharge, mati, dama, polis, hidup, jumlah_hantar, jumlah_sebenar, jumlah_hari)
				VALUES ('$wad', '$tarikh_terima', '$tarikh_pinjam', '$tarikh_hantar', '$discharge', '$mati', '$dama', '$polis', '$hidup', '$jumlah_hantar',
				'$jumlah_sebenar','$jumlah_hari')
			";
			mysqli_query($connect, $query);
		}
		$select = "SELECT * FROM tbl_casenote ORDER BY id DESC";
		$result = mysqli_query($connect, $select);
		$output .= '
			<table class="table table-bordered">
				<tr>
					<th width="5%">ID</th>
                    <th width="5%">WAD</th>
                    <th width="5%">TARIKH TERIMA</th>
					<th width="5%">TARIKH PINJAM</th>
                    <th width="5%">TARIKH HANTAR</th>
					<th width="10%">BALIK RUMAH</th>
					<th width="10%">MATI</th>
					<th width="10%">DAMA</th>
					<th width="10%">POLIS</th>
					<th width="10%">HIDUP</th>
                    <th width="10%">JUMLAH YANG DIHANTAR</th>
					<th width="10%">JUMLAH SEBENAR</th>
                    <th width="10%">JUMLAH HARI</th>
				</tr>
		';
		while($row = mysqli_fetch_array($result))
		{
			$output .= '
				<tr>
					<td><?php echo $row["id"]; ?></td>
					<td><?php echo $row["wad"]; ?></td>
					<td><?php echo $row["tarikh_terima"]; ?></td>
					<td><?php echo $row["tarikh_pinjam"]; ?></td>
                    <td><?php echo $row["tarikh_hantar"]; ?></td>
                    <td><?php echo $row["discharge"]; ?></td>
                    <td><?php echo $row["mati"]; ?></td>
					<td><?php echo $row["dama"]; ?></td>
					<td><?php echo $row["polis"]; ?></td>
                    <td><?php echo $row["hidup"]; ?></td>
                    <td><?php echo $row["jumlah_hantar"]; ?></td>
					<td><?php echo $row["jumlah_sebenar"]; ?></td>
                    <td><?php echo $row["jumlah_hari"]; ?></td>
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