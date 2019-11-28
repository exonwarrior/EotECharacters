<?php
	include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EotE User Registration</title>
		<!-- Bootstrap core CSS -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>

	<body>
		<!-- Fixed navbar repeated code because we need to change active page. -->
		<div id="wrap">
			<div class="container">
                <h2>Register</h2>
				<div class="jumbotron">
					<?php
						// define variables and set to empty values
						$emailErr = $usernameErr = $passwordErr = $conpasswordErr = "";
						$name = $email = $gender = $comment = $website = "";
						$emailPattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
						
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if (empty($_POST["username"])) {
								$usernameErr = "Username is required";
							} else {
								$username = test_input($_POST["username"]);
								if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
									$usernameErr = "Only letters and numbers allowed";
								}
								$result=mysqli_query($bd, "SELECT username FROM exon_player WHERE username='$username'");
								if(mysqli_num_rows($result)>=1) {
									$usernameErr = "Username exists";
								}
							}
							if (empty($_POST["email"])) {
								$emailErr = "Email is required";
							} else {
								$email = test_input($_POST["email"]);
								if (!preg_match($emailPattern,$email)) {
									$emailErr = "Invalid email format"; 
								}
								$result=mysqli_query($bd,"SELECT email FROM exon_player WHERE email='$email'");
								if(mysqli_num_rows($result)>=1) {
									$emailErr = "Email already in use";
								}
							}
							if (empty($_POST["password"])) {
								$passwordErr = "Password is required";
							} else {
								$password = test_input($_POST["password"]);
								if (valid_pass($password)==false) {
									$passwordErr = "Password must contain a number, an uppercase character and be at least 8 characters long";
								}
							}
							if (empty($_POST["conpassword"])) {
								$conpasswordErr = "Please confirm password";
							} else {
								$conpassword = test_input($_POST["conpassword"]);
								if ($password != $conpassword) {
									$conpasswordErr = "Passwords do not match";
								}
							}
							if($emailErr == "" && $usernameErr == "" && $passwordErr == "" && $conpasswordErr == ""){
								echo "Check it";
								$email=$_POST['email'];
								$username=$_POST['username'];
								$password=$_POST['password'];
								$encrypt_pass=md5($password);								
								$sql = "INSERT INTO exon_player (USERNAME, EMAIL, PASSWORDHASH) VALUES ('" . $username . "','" . $email . "','" . $encrypt_pass . "')";
								$result = mysqli_query($db,$sql) or die ("Error in query: $query. ".mysqli_error());
								$sql = "SELECT DBKey FROM exon_player WHERE Username ='$username'";
								$result = mysqli_query($db,$sql);
								if (mysqli_num_rows($result)>0){
									while($row = mysqli_fetch_row($result)) {
										$userid=$row[0];
									}
								}								
								header("Location: login.php?remarks=success");
								mysqli_close($db);
							}
						}
						function test_input($data) {
						   $data = trim($data);
						   $data = stripslashes($data);
						   $data = htmlspecialchars($data);
						   return $data;
						}
						function valid_pass($candidate) {
							//valid_pass function provided by user 'dawg' on http://stackoverflow.com/questions/2637896/php-regular-expression-for-strong-password-validation
							$r1='/[A-Z]/';  //Uppercase
							$r2='/[a-z]/';  //lowercase
							$r3='/[0-9]/';  //numbers
							if(preg_match_all($r1,$candidate, $o)<1) return FALSE;
							if(preg_match_all($r2,$candidate, $o)<1) return FALSE;
							if(preg_match_all($r3,$candidate, $o)<1) return FALSE;
							if(strlen($candidate)<8) return FALSE;
							return TRUE;
						}
					?>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                        <div class="form-group row">
                            <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputUsername3" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword4" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" id="inputPassword4" placeholder="Confirm Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
				</div>
			</div>
		</div>
	</body>
</html>
