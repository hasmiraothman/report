<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p><a href="index.php">Back to continue your adding data</a></p>
</form>

<p>&nbsp;</p>
<p>
  <?php
session_start();
if(!isset($_SESSION["nama"]))
{header("Location:index.html");}
if(!isset($_SESSION["tahap"]))
{header("Location:index.html");}

if(isset($_POST["submit"]))
{
	if(isset($_SESSION["nama"]))
	{
		$item_array_id = array_column($_SESSION["nama"], "product_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["cart"]);
			$item_array = array(
			'product_id' => $_GET["id"],
			'item_name' => $_POST["hidden_name"],
			'product_price' => $_POST["hidden_price"],
			'item_quantity' => $_POST["quantity"]
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="index.php"</script>';
		}
		else
		{
			echo '<script>alert("Products already added to cart")</script>';
			echo '<script>window.location="index.php"</script>';
		}
	}
	else
	{
		$item_array = array(
		'product_id' => $_GET["id"],
		'item_name' => $_POST["hidden_name"],
		'product_price' => $_POST["hidden_price"],
		'item_quantity'=> $_POST["quantity"]
		);
		$_SESSION["cart"][0] = $item_array;
	}
}
if(isset($_GET["action"])) 
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["cart"] as $keys => $values)
		{
			if($values["product_id"] == $_GET["id"])
			{
				unset($_SESSION["cart"][$keys]);
				echo '<script>alert("Product has been removed")</script>';
				echo '<script>window.location="index.php</script>';
			}
		}
	}
}

?>
</p>
<p>&nbsp; </p>
