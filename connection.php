<?php
$mysql_hostname = "localhost";
$mysql_user = "handyman_tourn";
$mysql_password = "3213560921*+*";
$mysql_database = "handyman_tourn";
$prefix = "";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect database");
mysql_select_db($mysql_database, $bd) or die("Could not select database");
?>
