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
			<h2 align="center">Upload Banci Harian Wad Data into MySQL Database</h2>
			<h3 align="center">Census.csv</h3><br />
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
						<th width="10%">Time</th>
						<th width="25%">Client</th>
						<th width="25%">Job No./Doc No.</th>
						<th width="35%">Description</th>
						<th width="20%">Remarks</th>
						<th width="20%">Assignation</th>
					</tr>
					<?php
		$t = "SELECT * FROM tbl_report ORDER BY id_report DESC";
			$q = $pdo->prepare($t);
			$q->execute();
			while ($t = $q->fetch(PDO::FETCH_OBJ)) 
				{
					?>
										
					<tr>
						<td><?php echo $t->time; ?></td>
						<td><?php echo $t->client; ?></td>
						<td><?php echo $t->job_no; ?></td>
						<td><?php echo $t->description; ?></td>
						<td><?php echo $t->remark; ?></td>
						<td><?php echo $t->assignation; ?></td>
					</tr>		 
			
			
					 			 
<?php
$pdo = NULL;
			}
				?>
					
				</table>
			</div>
            
            <div class="table-responsive">  
                     
                     <div id="live_data"></div>       
                     <form method="post" action="exportCensus.php" >  
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
				url:"upload_census1.php",
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