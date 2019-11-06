<?php
session_start();
//check if user loggedin
if(empty($_SESSION['username123']))
{
	header("Location: index.php");
}
else
{
	include("database.php");
	$delete_id = $_GET['id'];
	//update the respective product id which is to sell to detuct it from item list
	$result = mysql_query("UPDATE product SET sold='1' WHERE prod_id = '$delete_id'");
	if($result)
	{
		//if success direct to list of sell product page passing msg=1 to show success message.
		header("Location: sell_product.php?msg=1");
	}
	else
	{
		//if success direct to list of sell product page passing msg=2 to show error message.
		header("Location: sell_product.php?msg=2");
	}
}

?>