<?php
	//Start session
	session_start();

	//Include database connection details
	$mysql_hostname = "localhost";
	$mysql_user = "eote";
	$mysql_password = "C1oudbur5t";
	$mysql_database = "edge_of_the_empire";
	$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);

	//Array to store validation errors
	$errmsg_arr = array();

	//Validation error flag
	$errflag = false;

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = trim($str);
		$str = stripslashes($str);
		return mysqli_real_escape_string($bd,$str);
	}

	//Sanitize the POST values
	$username = $_POST['username'];//clean($_POST['username']);
	$password = $_POST['password'];//clean($_POST['password']);

	//Input Validations
	if($username == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}

	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login.php");
		exit();
	}

	//Create query
	$encrypt_pass=md5($password);
	$sql = "SELECT * FROM exon_player WHERE Username='" . $username . "' AND PasswordHash='" . $encrypt_pass . "'";
	$result = mysqli_query($bd, $sql);

	//Check whether the query was successful or not
	//if($result) {
		//echo "Result not null";
		if(mysqli_num_rows($result) > 0) {
			//Login Successful
			session_regenerate_id();
			$exon_player = mysqli_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $exon_player['mem_id'];
			//$_SESSION['SESS_FIRST_NAME'] = $exon_player['username'];
			//$_SESSION['SESS_LAST_NAME'] = $exon_player['password'];
			$_SESSION['loggedin'] = true;
			session_write_close();
			header("location: profile.php");
			exit();
		}else {
			//Login failed
			$errmsg_arr[] = 'user name and password not found';
			$errflag = true;
			if($errflag) {
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("location: login.php");
				exit();
			}
		}
	//} else {
//		die("Query failed");
//	}
?>
