<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}
date_default_timezone_set("Asia/Kuala_Lumpur");

?>

<html>

<head>
<link rel="stylesheet" href="include/input.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
</head>
	<body>
		<br /><br />
		<div class="container" style="width:900px;">
			<h2 align="center">Upload Metadata Pesakit into MySQL Database</h2>
			<h3 align="center">Metadata Pesakit.csv</h3><br />
			<form id="upload_csv" method="post" enctype="multipart/form-data">
				<div class="col-md-3">
					<br />
					<label>Add More Data</label>
				</div>
				<div class="col-md-4">
					<input type="file" name="employee_file" style="margin-top:15px;" />
				</div>
				<div class="col-md-5">
					<input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
				</div>
				<div style="clear:both"></div>
			</form>
			<br /><br /><br />
			<div class="table-responsive" id="employee_table">
				<table class="table table-bordered">
					<tr>
						<th width="15%">ID Pesakit</th>
						<th width="5%">Tarikh Daftar</th>
						<th width="25%">Nama Pesakit</th>
						<th width="10%">NRIC Pesakit</th>
						<th width="5%">No. Siri Rawatan</th>
						<th width="5%">Alamat Pesakit</th>
						<th width="5%">Kedatangan</th>
						<th width="5%">Kategori Pesakit</th>
                        <th width="5%">Punca Rujukan</th>
						<th width="5%">Disiplin</th>
						<th width="5%">Assessment And Training</th>
						<th width="5%">Diagnosis</th>
						<th width="5%">Tarikh Rawatan</th>
						<th width="5%">Dikemaskini Oleh</th>
						<th width="5%">Catatan Pesakit</th>
					</tr>
					<?php
		$t = "SELECT * FROM tbl_register ORDER BY id_dpesakit DESC";
			$q = $pdo->prepare($t);
			$q->execute();
			while ($t = $q->fetch(PDO::FETCH_OBJ)) 
				{
				?>
										
				<tr>
					<td><?php echo $t->id_dpesakit; ?></td>
					<td><?php echo $t->tarikh_daftar; ?></td>
					<td><?php echo $t->nama_pesakit; ?></td>
					<td><?php echo $t->ic_pesakit; ?></td>
					<td><?php echo $t->no_rawatan; ?></td>
					<td><?php echo $t->alamat_pesakit; ?></td>
					<td><?php echo $t->nama_kedatangan; ?></td>
					<td><?php echo $t->nama_kategori; ?></td>
                    <td><?php echo $t->nama_rujukan; ?></td>
					<td><?php echo $t->nama_disiplin; ?></td>
					<td><?php echo $t->nama_assessment; ?></td>
					<td><?php echo $t->nama_diagnosis; ?></td>
					<td><?php echo $t->tarikh_rawatan; ?></td>
					<td><?php echo $t->nama; ?></td>
                    <td><?php echo $t->catatan_pesakit; ?></td
				</tr>		 
					 			 
<?php
$pdo = NULL;
			}
				?>
					
				</table>
			</div>
			
			<div class="table-responsive">  
                     
                     <div id="live_data"></div>       
                     <form method="post" action="export.php" >  
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
				url:"upload_register2.php",
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
						$('#employee_table').html(data);
					}
				}
			});
		});
	});
	
</script>