<?php
	//Start session
	session_start();
	require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Exon9's Online Edge of the Empire Character Portfolio</title>
		<style>
			.error {color: #FF0000;}
		</style>
		<!-- Bootstrap core CSS -->
		<link href="./css/bootstrap.css" rel="stylesheet">
	</head>
	<body>
		<!-- Fixed navbar repeated code because we need to change active page. -->
		<div id="wrap">
			<div class="banner-top">
				<img class="img-responsive img-center" src="http://i.imgur.com/CXMCO0r.jpg?1" width="100%"/>
			</div>

			<div class="container">
				<div class="jumbotron">
					<form name="newCharForm" action="newChar_exec.php" method="post">
						<table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
							<tr>
								<td colspan="2">
								<!--the code bellow is used to display the message of the input validation-->
								<?php
									if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
										echo '<ul class="err">';
										foreach($_SESSION['ERRMSG_ARR'] as $msg) {
											echo '<li>',$msg,'</li>'; 
										}
										echo '</ul>';
										unset($_SESSION['ERRMSG_ARR']);
									}
								?>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
