<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<meta HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
		<title>Exon9's Online Edge of the Empire Character Portfolio</title>
	</head>
	<body LANG="en-US" DIR="LTR">
		<?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			?>
				<ul>
					<li><a href="leaderboard.php" class="right-list">Characters</a></li>
					<li><a href="profile.php" class="right-list">My Characters</a></li>
					<li><a href="logout.php" class="right-list">Logout</a></li>
				</ul>
			<?php
			} else {
			?>
				<ul>
					<li><a href="leaderboard.php" class="right-list">Characters</a></li>
					<li><a href="login.php" class="right-list">Login</a></li>
					<li><a href="register.php" class="right-list">Register</a></li>
				</ul>
			<?php
			}
		?>
	</body>
</html>
