<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Exon9's Online Edge of the Empire Character Portfolio</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>

	<body>
		<!-- Fixed navbar repeated code because we need to change active page. -->
		<div id="wrap">
			<div class="container">
				<div class="jumbotron">
					<?php
						$mysql_hostname = "localhost";
						$mysql_user = "eote";
						$mysql_password = "C1oudbur5t";
						$mysql_database = "edge_of_the_empire";
						$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database);
						
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
								mysqli_query($bd,$sql);
								$sql = "SELECT DBKey FROM exon_player WHERE Username ='$username'";
								$result = mysqli_query($bd,$sql);
								if (mysqli_num_rows($result)>0){
									while($row = mysqli_fetch_row($result)) {
										$userid=$row[0];
									}
								}								
								header("Location: login.php?remarks=success");
								mysqli_close($bd);
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
					<div align="center">
						<h2>Register Here</h2>
						<p><span class="error">* required field.</span></p>
					</div>
					<form name="reg" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
						<table width="750" border="0" align="center" cellpadding="2" cellspacing="0">
							<tr>
								<td width="180"><div align="right">Email:</div></td>
								<td width="170"><input type="test" name="email" value="<?php echo $email;?>" /></td>
								<?php echo'<td><span class="error">*  '.$emailErr.'</span></td>';?>
							</tr>
							<tr>
								<td width="180"><div align="right">Username:</div></td>
								<td width="170"><input type="text" name="username" value="<?php echo $username;?>" /></td>
								<?php echo'<td><span class="error">* '.$usernameErr.'</span></td>';?>
							</tr>
							<tr>
								<td width="180"><div align="right">Password:</div></td>
								<td width="170"><input type="password" name="password" /></td>
								<?php echo'<td><span class="error">* '.$passwordErr.'</span></td>';?>
							</tr>
							<tr>
								<td width="180"><div align="right">Cofirm Password:</div></td>
								<td width="170"><input type="password" name="conpassword" /></td>
								<?php echo'<td><span class="error">* '.$conpasswordErr.'</span></td>';?>
							</tr>
							<tr>
								<td><div align="right"></div></td>
								<td><input name="submit" type="submit" value="Submit" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
