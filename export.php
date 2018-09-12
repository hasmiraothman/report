<?php
 $connect = mysqli_connect("localhost", "root", "", "newbht");  
 $output = '';  
 if(isset($_POST["export_excel"]))  
 {  
      $sql = "SELECT * FROM tbl_register ORDER BY id_dpesakit DESC";  
      $result = mysqli_query($connect, $sql);  
      if(mysqli_num_rows($result) > 0)  
      {  
           $output .= '  
                <table class="table" bordered="1">  
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
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
						<td>'.$row["id_dpesakit"].'</td>
						<td>'.$row["tarikh_daftar"].'</td>
						<td>'.$row["nama_pesakit"].'</td>
						<td>'.$row["ic_pesakit"].'</td>
						<td>'.$row["no_rawatan"].'</td>
						<td>'.$row["alamat_pesakit"].'</td>
						<td>'.$row["nama_kedatangan"].'</td>
						<td>'.$row["nama_kategori"].'</td>
						<td>'.$row["nama_rujukan"].'</td>
						<td>'.$row["nama_disiplin"].'</td>
						<td>'.$row["nama_assessment"].'</td>
						<td>'.$row["nama_diagnosis"].'</td>
						<td>'.$row["tarikh_rawatan"].'</td>
						<td>'.$row["nama"].'</td>
						<td>'.$row["catatan_pesakit"].'</td>
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