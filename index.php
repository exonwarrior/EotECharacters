<?php
session_start();
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Exon9's Online Edge of the Empire Character Portfolio</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<!-- Brand -->
			<a class="navbar-brand" href="#">
				<img src="img/logo_square.jpg" alt="EotE logo" style="width:40px;">
			</a>

			<!-- Links -->
			<ul class="navbar-nav">
			<?php	
				if(isset($_SESSION['login_user'])) {
			?> 
				<li class="nav-item">
					<a class="nav-link" href="profile.php">My Characters</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="newcharacter.php">New character</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			<?php
				} else {
			?>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="register.php">Register</a>
				</li>

			<?php
				}
			?>
				
			</ul>
		</nav>
	</body>
</html>
