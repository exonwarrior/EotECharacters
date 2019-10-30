<?php

//require_once('connection.php');
//define("DB_SERVER", $bd);

$mysql_hostname = "localhost";
$mysql_user = "eote";
$mysql_password = "C1oudbur5t";
$mysql_database = "edge_of_the_empire";
//echo "Yay";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);


$email = "drhaenze@gmail.com";
$username = "exon2";
$password = "C1oudbur5t";
$encrypt_pass=md5($password);
$sql = "SELECT * FROM exon_player WHERE Username='" . $username . "' AND PasswordHash='" . $encrypt_pass . "'";
$result = mysqli_query($bd, $sql);

/*echo "inserting new";
//$sql = "INSERT INTO exon_player (USERNAME, EMAIL, PASSWORDHASH) VALUES ('" . $username . "','" . $email . "','" . $pass . "')";

mysqli_query($bd,$sql);

$sql = "SELECT * FROM exon_player WHERE email='" . $email . "'";
$result = mysqli_query($bd,$sql);

if(!$result){
	echo "No results";
}
*/
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
        echo "id: " . $row[1]. " - Name: " . $row[2];
    }
} else {
    echo "0 results";
}

/*while($row = mysqli_fetch_array($result))
    {
		echo "while";
		print_r($row) . "\n";
    }*/
echo "\nResult printed";

//echo "inserting new";
//$sql = "INSERT INTO exon_player (USERNAME, EMAIL, PASSWORDHASH) VALUES ('".$username."','".$email."','".$pass."')";
?>
