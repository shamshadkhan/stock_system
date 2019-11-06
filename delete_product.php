<?php
session_start();
if(empty($_SESSION['username123']))
{
	header("Location: index.php");
}
else
{
	include("database.php");
	$delete_id = $_GET['id'];
	//delete the respective id
	$result = mysql_query("DELETE FROM product WHERE prod_id = '$delete_id'");
	if($result)
	{
		//if success direct to list of product page passing msg=1 to show success message.
		header("Location: list_product.php?msg=1");
	}
	else
	{
		//if success direct to list of product page passing msg=2 to show error message.
		header("Location: list_product.php?msg=2");
	}
}

?>