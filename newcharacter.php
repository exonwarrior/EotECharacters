<?php
	//Start session
	session_start();
	include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>

		<title>Exon9's Online Edge of the Empire Character Portfolio</title>
		<!-- Bootstrap core CSS -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="./bootstrap/js/bootstrap.min.js"></script>
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
                                    if(!isset($_SESSION['login_user'])) {
                                        header("Location: login2.php?location=newcharacter.php");
                                    }

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
								<td><select name="charSpecies" class="custome-select mb-3">
								<option selected>Species</option>
								<?php
									$speciesName = "";
									//Select Available species from exon_species
									$query = "SELECT * FROM exon_species";

									// execute above query 
									$result = mysqli_query($db,$query) or die ("Error in query: $query. ".mysqli_error());

									// see if any rows were returned 
									if (mysqli_num_rows($result) > 0) {
										while($row = mysqli_fetch_row($result)) {
											$speciesKey = $row[0];
											$speciesName = $row[1];
											echo '<option value="SpeciesKey='.$speciesKey.'">'.$speciesName.'</option>';
										}
									}
								?>
								</select></td>
							</tr>
							<tr>
								<td width="120"><div align="right">Career</div></td>
								<td><select name="charCareer">
								<?php
									$careerName = "";
									//Select Available species from exon_career
									$query = "SELECT * FROM exon_career";

									// execute above query 
									$result = mysqli_query($db,$query) or die ("Error in query: $query. ".mysqli_error());

									// see if any rows were returned 
									if (mysqli_num_rows($result) > 0) {
										while($row = mysqli_fetch_row($result)) {
											$careerKey = $row[0];
											$careerName = $row[1];
											echo '<option value="CareerKey='.$careerKey.'">'.$careerName.'</option>';
										}
									}
								?>
								</select></td>
							</tr>
							
							<tr>
								<td width="120"><div align="right">Specialization</div></td>
								<td><select name="charSpecialization">
								<?php
									$specializationName = "";
									//Select Available Specializations from exon_specialization
									$query = "SELECT * FROM exon_specialization";

									// execute above query 
									$result = mysqli_query($db,$query) or die ("Error in query: $query. ".mysqli_error());

									// see if any rows were returned 
									if (mysqli_num_rows($result) > 0) {
										while($row = mysqli_fetch_row($result)) {
											$specializationKey = $row[0];
											$specializationName = $row[2];
											echo '<option value="SpecKey='.$specializationKey.'">'.$specializationName.'</option>';
										}
									}
								?>
								</select></td>
							</tr>
							
							<tr>
								<td width="116"><div align="right">Gender</div></td>
								<td><select name="charGender">
									<option value="M">Male</option>
									<option value="F">Female</option>
									<option value="O">Other</option>
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
								<td><input name="CreateChar" type="submit" value="Create Character" /></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
