<?php  
 $connect = mysqli_connect("localhost", "root", "", "newbht");  
 $output = '';  
 if(isset($_POST["export_excel"]))  
 {  
      $sql = "SELECT * FROM tbl_cencus ORDER BY id_census DESC";  
      $result = mysqli_query($connect, $sql);  
      if(mysqli_num_rows($result) > 0)  
      {  
           $output .= '  
                <table class="table" bordered="1">  
                   <tr>
						<th width="5%">ID</th>
                        <th width="20%">Tarikh Census</th>
						<th width="20%">WAD</th>
						<th width="35%">DAMA</th>
						<th width="10%">MATI</th>
						<th width="20%">HIDUP</th>
						<th width="5%">TRANSFER</th>
						<th width="5%">Jumlah</th>>
					</tr> 
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
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
                ';  
           }  
           $output .= '</table>';  
           header("Content-Type: application/xls");   
           header("Content-Disposition: attachment; filename=download.xls");  
           echo $output;  
      }  
 }  
 ?>  