<?php
	//Start session
	session_start();
    include('config.php');
	//Unset the variables stored in session
	unset($_SESSION['SESS_PLAYER_ID']);
    if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form
    //echo "Connected to DB: ".DB_DATABASE;

        $redirect = NULL;
        if($_GET['location'] != '') {
            $redirect = $_GET['location'];
        }

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
            if($redirect) {
                header("Location:". $redirect);
            } else {
                header("Location:profile.php");
            }
            exit();
        } else {
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
    <title>Exon9's Online Edge of the Empire Character Portfolio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fontello.css">
    <script src="//use.edgefonts.net/advent-pro.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    echo '<input type="hidden" name="location" value="';
    if(isset($_GET['location'])) {
        echo htmlspecialchars($_GET['location']);
    }
    echo '" />';
    ?>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">
            <img src="img/logo_square.jpg" alt="EotE logo" style="width:40px;">
        </a>
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Main page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">Sign Up</a>
            </li>
        </ul>
    </nav>


			<div class="container">
				<div class="jumbotron">
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
				</div>
			</div>
		</div>
	</body>
</html>
