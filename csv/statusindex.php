<?php
$connect = mysqli_connect("localhost", "root", "", "newbht");
$query = "SELECT * FROM tbl_census ORDER BY id_census desc";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Testing</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	</head>
	<body>
		<br /><br />
		<div class="container" style="width:900px;">
			<h2 align="center">Import CSV File Data into MySQL Database using PHP & Ajax</h2>
			<h3 align="center">Employee Data</h3><br />
			<form id="upload_csv" method="post" enctype="multipart/form-data">
				<div class="col-md-3">
					<br />
					<label>Add More Data</label>
				</div>
				<div class="col-md-4">
					<input type="file" name="try_file" style="margin-top:15px;" />
				</div>
				<div class="col-md-5">
					<input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
				</div>
				<div style="clear:both"></div>
			</form>
			<br /><br /><br />
			<div class="table-responsive" id="try_table">
				<table class="table table-bordered">
					<tr>
						<th width="5%">ID</th>
                        <th width="20%">Tarikh Census</th>
						<th width="20%">WAD</th>
						<th width="35%">DAMA</th>
						<th width="10%">MATI</th>
						<th width="20%">HIDUP</th>
						<th width="5%">TRANSFER</th>
						<th width="5%">Jumlah</th>
                    </tr>
					<?php
					while($row = mysqli_fetch_array($result))
					{
					?>
					<tr>
						<td><?php echo $row["id_census"]; ?></td>
                        <td><?php echo $row["tarikh_census"]; ?></td>
						<td><?php echo $row["wad"]; ?></td>
						<td><?php echo $row["DAMA"]; ?></td>
						<td><?php echo $row["mati"]; ?></td>
						<td><?php echo $row["hidup"]; ?></td>
						<td><?php echo $row["transfer"]; ?></td>
						<td><?php echo $row["jumlah"]; ?></td>
					</tr>
					<?php	
					}
					?>
				</table>
			</div>
            
            <div class="table-responsive">  
                     
                     <div id="live_data"></div>       
                     <form method="post" action="excel.php" >  
                          <input type="submit" name="export_excel" class="btn btn-success" value="Export to Excel"/>  <br	/><br	/>
                     </form>  
                </div>  
            
		</div>
        
         
        
        
        
	</body>
</html>

<script>
	$(document).ready(function(){
		$('#upload_csv').on('submit', function(e){
			e.preventDefault();
			$.ajax({
				url:"statusimport.php",
				method:"POST",
				data:new FormData(this),
				contentType:false,
				cache:false,
				processData:false,
				success:function(data){
					if(data == 'Error1')
					{
						alert("Invalid File");
					}
					else if(data == "Error2")
					{
						alert("Please Select File");
					}
					else
					{
						$('#try_table').html(data);
					}
				}
			});
		});
	});
	
</script>


