<?php
$mysql_hostname = "localhost";
$mysql_user = "eote";
$mysql_password = "C1oudbur5t";
$mysql_database = "edge_of_the_empire";
//echo "Yay";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password);
//echo "Variables: " . $mysql_hostname . " " . $mysql_user . " " . $mysql_password . " " . $mysql_database . " " . $mysql_socket;
//$bd = mysqli_connect($mysql_user, $mysql_password);
//$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
if(!$bd) {
	die("Could not connect to database: " . mysqli_connect_error());
}
echo nl2br("Connected. \n Selecting database: ") . $mysql_database . nl2br("\n");
mysqli_select_db($bd, $mysql_database)or die("Could not select database");
echo "Selected database: " . $mysql_database . "\n";
?>
