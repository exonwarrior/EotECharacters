<?php
$mysql_hostname = "localhost";
$mysql_user = "eote";
$mysql_password = "C1oudbur5t";
$mysql_database = "edge_of_the_empire";

$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

if(!$bd) {
	die("Could not connect to database: " . mysqli_connect_error());
} else {
	echo "Connected to database: " . $mysql_database . ".";
}
?>
