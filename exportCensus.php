<?php  
 $connect = mysqli_connect("localhost", "root", "", "newbht");  
 $output = '';  
 if(isset($_POST["export_excel"]))  
 {  
      $sql = "SELECT * FROM tbl_census ORDER BY id_census DESC";  
      $result = mysqli_query($connect, $sql);  
      if(mysqli_num_rows($result) > 0)  
      {  
           $output .= '  
                <table class="table" bordered="1">  
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
           while($row = mysqli_fetch_array($result))  
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
						<td>'.$row["jumlah"].'</td></td>
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