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

    //Define variables and set to empty
     $usernameErr = $passwordErr = "";

	//Validation error flag
	$errflag = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
			$usernameErr = "Username is required";
        } else {
            $username = test_input($_POST["username"]);
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }
    }

	//If there are input validations, redirect back to the login form
	if($usernameErr != "" && $passwordErr != "") {
		$_SESSION['ERRMSG_ARR'] = $usernameErr . $passwordErr;
		session_write_close();
		header("location: login.php");
		exit();
	}

	//Create query
	$encrypt_pass=md5($password);
	$sql = "SELECT * FROM exon_player WHERE Username='" . $username . "' AND PasswordHash='" . $encrypt_pass . "'";
	$result = mysqli_query($bd, $sql);

	//Check whether the query was successful or not
	if($result) {
		if(mysqli_num_rows($result)>0) {
			//Login Successful
			session_regenerate_id();
			$exon_player = mysqli_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $exon_player['dbkey'];
			$_SESSION['SESS_USERNAME'] = $exon_player['username'];
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
    } else {
		die("Query failed");
	}

    function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

    //Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = trim($str);
		$str = stripslashes($str);
		return mysqli_real_escape_string($bd,$str);
	}
?>
