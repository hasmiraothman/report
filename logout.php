<?PHP

session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

//destroy session in logout
session_start();
session_destroy();
session_write_close();  
header('Location:index.html');  
exit; 
?>