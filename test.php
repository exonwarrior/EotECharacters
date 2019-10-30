<?php

require_once('connection.php');

$email = "drhaenze@gmail.com";
$result = mysqli_query("SELECT * FROM exon_player WHERE email='$email'");

while($row = mysqli_fetch_array($result))
    {
		print_r($row);
    } 
?>