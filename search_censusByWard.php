<?php
include("connect.php");

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

$tableContent = '';
$start = '';
$selectStmt = $con->prepare('SELECT * FROM tbl_census');
$selectStmt->execute();
$users = $selectStmt->fetchAll();

foreach ($users as $user)
{
    $tableContent = $tableContent.'<tr>'.
            '<td>'.$user['id_census'].'</td>'
            .'<td>'.$user['wad'].'</td>'
            .'<td>'.$user['DAMA'].'</td>'
            .'<td>'.$user['mati'].'</td>';
}

if(isset($_POST['search']))
{
$start = $_POST['start'];
$tableContent = '';
$selectStmt = $con->prepare('SELECT * FROM tbl_census WHERE wad like :start');
$selectStmt->execute(array(
        
         ':start'=>$start.'%'
    
));
$users = $selectStmt->fetchAll();

foreach ($users as $user)
{
    $tableContent = $tableContent.'<tr>'.
            '<td>'.$user['id_census'].'</td>'
            .'<td>'.$user['wad'].'</td>'
            .'<td>'.$user['DAMA'].'</td>'
            .'<td>'.$user['mati'].'</td>';
}
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Search & Display Using Selected Values</title>  
        <style>
            table,tr,td
            {
               border: 1px solid #000; 
            }
            
            td{
                background-color: #ddd;
            }
        </style>   
    </head>
    <body>
        
        <form action="search_censusByWard.php" method="POST">
            <!-- 
For The First Time The Table Will Be Populated With All Data
But When You Choose An Option From The Select Options And Click The Find Button, The Table Will Be Populated With specific Data 
             -->
            <select name="start">
               <option value="showAll" selected="selected">Show All ward</option>
        <?php
        require_once 'config.php';
        
        $stmt = $dbcon->prepare('SELECT * FROM tbl_wad');
        $stmt->execute();
        
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            ?>
            <option value="<?php echo $wad; ?>"><?php echo $wad; ?></option>
            <?php
        }
        ?>
            </select>
            
            <input type="submit" name="search" value="Find">
            
            <table>
                <tr>
                    <td>#ID</td>
                    <td>wad</td>
                    <td>DAMA</td>
                    <td>mati</td>
                </tr>
                
                <?php
                
                echo $tableContent;
                
                ?>
                
            </table>
            
        </form>
        
    </body>    
</html>