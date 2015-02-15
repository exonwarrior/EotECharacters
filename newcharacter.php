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

							<tr>
								<td width="116"><div align="right">Name</div></td>
								<td width="177"><input name="charName" type="text" /></td>
							</tr>

							<tr>
								<td width="120"><div align="right">Species</div></td>
								<td><select>
								<?php
									$speciesName = "";
									//Select Available species from exon_species
									$query = "SELECT * FROM exon_species";

									// execute above query 
									$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

									// see if any rows were returned 
									if (mysql_num_rows($result) > 0) {
										while($row = mysql_fetch_row($result)) {
											$speciesKey = $row[0];
											$speciesName = $row[1];
											echo '<option value="'.$speciesKey.'">'.$speciesName.'</option>';
										}
									}
								?>
								</select></td>
							</tr>
							
							<tr>
								<td width="120"><div align="right">Career</div></td>
								<td><select>
								<?php
									$careerName = "";
									//Select Available species from exon_species
									$query = "SELECT * FROM exon_career";

									// execute above query 
									$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

									// see if any rows were returned 
									if (mysql_num_rows($result) > 0) {
										while($row = mysql_fetch_row($result)) {
											$careerKey = $row[0];
											$careerName = $row[1];
											echo '<option value="'.$careerKey.'">'.$careerName.'</option>';
										}
									}
								?>
								</select></td>
							</tr>
							
							<tr>
								<td width="120"><div align="right">Specialization</div></td>
								<td><select>
								<?php
									$specializationName = "";
									//Select Available species from exon_specialization
									$query = "SELECT * FROM exon_specialization";

									// execute above query 
									$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

									// see if any rows were returned 
									if (mysql_num_rows($result) > 0) {
										while($row = mysql_fetch_row($result)) {
											$specializationKey = $row[0];
											$specializationName = $row[1];
											echo '<option value="'.$specializationKey.'">'.$specializationName.'</option>';
										}
									}
								?>
								</select></td>
							</tr>
							
							<tr>
								<td width="116"><div align="right">Gender</div></td>
								<td><select>
									<option value="male">Male</option>
									<option value="female">Female</option>
									<option value="other">Other</option>
								</select></td>
							</tr>
							<!-- TODO for Age and height - number verification -->
							<tr>
								<td width="116"><div align="right">Age</div></td>
								<td width="177"><input name="charAge" type="text" /></td>
							</tr>
							
							<tr>
								<td width="116"><div align="right">Height</div></td>
								<td width="177"><input name="charHeight" type="text" /></td>
							</tr>
							
							<tr>
								<td width="116"><div align="right">Hair</div></td>
								<td width="177"><input name="charHair" type="text" /></td>
							</tr>
							
							<tr>
								<td width="116"><div align="right">Eyes</div></td>
								<td width="177"><input name="charEyes" type="text" /></td>
							</tr>
							
							<tr>
								<td width="116"><div align="right">Notable Features</div></td>
								<td width="177"><input name="charFeatures" type="text" /></td>
							</tr>
							
							<tr>
								<td width="116"><div align="right">Build</div></td>
								<td width="177"><input name="charBuild" type="text" /></td>
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
