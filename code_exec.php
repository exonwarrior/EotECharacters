<?php
session_start();
require_once('connection.php');
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$encrypt_pass=md5($password);
mysql_query("INSERT INTO member(fname, lname, email, username, password)VALUES('$fname', '$lname', '$email', '$username', '$encrypt_pass')");
$result = mysql_query("SELECT mem_id FROM member WHERE username ='$username'");
if (mysql_num_rows($result)>0){
	while($row = mysql_fetch_row($result)) {
		$userid=$row[0];
	}
}
mysql_close($con);
require_once('lead_con.php');
$fullname=$fname.' '.$lname;
$points = 0;
mysql_query("INSERT INTO leaderboard_2014(userid, Name, Points)VALUES('$userid', '$fullname', '$points')");
header("Location: login.php?remarks=success");
mysql_close($con);
?>
