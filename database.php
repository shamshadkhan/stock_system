<?php
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database_name = 'project';
$sql_connection = mysql_connect($host_name, $user_name, $password) or die(mysql_error());
mysql_select_db($database_name, $sql_connection);

?>