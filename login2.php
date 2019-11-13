<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    //echo "Connected to DB: ".DB_DATABASE;

    if(empty($_POST['username'])){
	    $error = "Username is empty";
    }
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']);
    $encrypt_pass = md5($mypassword);

    //echo "User: " . $myusername . "Pass: " . $mypassword . "Encrypt: " . $encrypt_pass;

    $sql = "SELECT DBKey FROM exon_player WHERE Username='" . $myusername . "' AND PasswordHash='" . $encrypt_pass . "'";
    //echo $sql;
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    printf ("%s (%s)\n", $row["DBKey"]);
    $active = $row['active'];

    $count = mysqli_num_rows($result);

    //echo $count;

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
	$_SESSION['user_key'] = $row["DBKey"];
        $_SESSION['login_user'] = $myusername;
        header("location: profile.php");
    }else {
	if(empty($_POST['username'])){
		$error = "Username missing";
	}
	else if (empty($_POST['password'])){
		$error = "Password missing";
	}
        else{
		$error = "Your Login Name or Password is invalid";
	}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 
    <title>Login Page</title>

    <style type="text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
    </style>

</head>

<body bgcolor="#FFFFFF">
<?php
    echo '<input type="hidden" name="location" value="';
    if(isset($_GET['location'])) {
        echo htmlspecialchars($_GET['location']);
    }
    echo '" />';
?>

    <div align="center">
        <div style="width:300px; border: solid 1px #333333; " align="left">
            <div style="background-color:#333333; color:#FFFFFF; padding:3px;">
                <b>Login</b>
            </div>

            <div style="margin:30px">

                <form action="" method="post">
                    <label>UserName  :</label>
                    <input type="text" name="username" class="box" />
                    <br />
                    <br />
                    <label>Password  :</label>
                    <input type="password" name="password" class="box" />
                    <br />
                    <br />
                    <input type="submit" value=" Submit " />
                    <br />
                </form>

                <div style="font-size:11px; color:#cc0000; margin-top:10px">
                    <?php echo $error; ?>
                </div>

            </div>

        </div>

    </div>

</body>
</html>
