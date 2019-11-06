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
	//delete the respective id
	$result = mysql_query("DELETE FROM category WHERE cat_id = '$delete_id'");
	if($result)
	{
		//if success direct to list of category page passing msg=1 to show success message.
		header("Location: list_category.php?msg=1");
	}
	else
	{
		//if success direct to list of category page passing msg=2 to show error message.
		header("Location: list_category.php?msg=2");
	}
}

?>