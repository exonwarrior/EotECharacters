<?php
	//Start session
	session_start();
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
				<img class="img-responsive img-center" src="http://i.imgur.com/CXMCO0r.jpg?1" />
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

							<tr>
								<td width="116"><div align="right">Character Name</div></td>
								<td width="177"><input name="charName" type="text" /></td>
							</tr>

							<tr>
								<td><div align="right">Character Species</div></td>
								<td><select>
								  <option value="volvo">Volvo</option>
								  <option value="saab">Saab</option>
								  <option value="opel">Opel</option>
								  <option value="audi">Audi</option>
								</select></td>
							</tr>

							<tr>
								<td><div align="right"></div></td>
								<td><input name="" type="submit" value="CreateChar" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
