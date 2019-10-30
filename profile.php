<?php
	session_start();
	//require_once('auth.php');
	include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Aberystwyth Community of Gamers Tournament Software</title>

		<!-- Bootstrap core CSS -->
		<!-- <link href="./css/bootstrap.css" rel="stylesheet">-->
	</head>

	<body>
            <!-- <ul>
                        <li><a href="http://www.abercog.co.uk" class="left-list">ACOG Home</a></li>
			<li><a href="logout.php" class="right-list">Logout</a></li>
                        <li><a href="leaderboard.php" class="right-list">Leaderboard</a></li>
                </ul>
                <div id="wrap">
			<div class="banner-top">
				<img class="img-responsive img-center" src="./images/acog-logo.png" />
			</div>-->


			<div class="container">
				<div class="jumbotron">
				
				<p> You should be logged in now.</p>
					<?php
						/*if (isset($_GET['ID'])==false){
							$userid = $_SESSION['SESS_MEMBER_ID'];
							$result = mysql_query("SELECT * FROM member WHERE mem_id = '$userid'");
							if (mysql_num_rows($result)>0){
								while($row = mysql_fetch_row($result)) {
									$username = $row[3].' '.$row[4];
									echo "\t\t\t";
									echo '<h1>'.$username.'</h1>';
									echo '<h2>'.$row[1].'</h2>';
									$result2 = mysql_query("SELECT * FROM leaderboard_2014 WHERE userid = '$userid'");
									if (mysql_num_rows($result2)>0){
										while($row2 = mysql_fetch_row($result2)) {
											echo '<p>Leaderboard points: '.$row2[2].'</p>';
										}
									}
									echo "<p>Games played:<p>\n";
									$result3 = mysql_query("SELECT * FROM participants WHERE UserID = '$userid'");
									if (mysql_num_rows($result3)>0){
										while($row3 = mysql_fetch_row($result3)) {
											$tournid = $row3[2];
											$result4 = mysql_query("SELECT * FROM tournaments WHERE ID = '$tournid'");
											if (mysql_num_rows($result4)>0){
												while($row4 = mysql_fetch_row($result4)) {
													echo '<p>'.$row4[2].': '.$row3[3].' points</p>';
												}
											}											
										}
									}			
									echo "\n";
								}
							}
						}
						else {
							$userid=$_GET['ID'];
							$result = mysql_query("SELECT * FROM member WHERE mem_id = '$userid'");
							if (mysql_num_rows($result)>0){
								while($row = mysql_fetch_row($result)) {
									$username = $row[3].' '.$row[4];
									echo "\t\t\t";
									echo '<h1>'.$username.'</h1>';
									echo '<h2>'.$row[1].'</h2>';
									$result2 = mysql_query("SELECT * FROM leaderboard_2014 WHERE userid = '$userid'");
									if (mysql_num_rows($result2)>0){
										while($row2 = mysql_fetch_row($result2)) {
											echo '<p>Leaderboard points: '.$row2[2].'</p>';
										}
									}
									echo "<p>Games played:<p>\n";
									$result3 = mysql_query("SELECT * FROM participants WHERE UserID = '$userid'");
									if (mysql_num_rows($result3)>0){
										while($row3 = mysql_fetch_row($result3)) {
											$tournid = $row3[2];
											$result4 = mysql_query("SELECT * FROM tournaments WHERE ID = '$tournid'");
											if (mysql_num_rows($result4)>0){
												while($row4 = mysql_fetch_row($result4)) {
													echo '<p>'.$row4[2].': '.$row3[3].' points</p>';
												}
											}											
										}
									}
									echo "\n";
								}
							}
						}*/
					?>
				</div>
			</div>
		</div>
	</body>
</html>
