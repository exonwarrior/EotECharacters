<?php
	session_start();
	//require_once('auth.php');
	include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>EotE User Profile</title>

		<!-- Bootstrap core CSS -->
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
							<li class="nav-item">
					<a class="nav-link" href="index.php">Main page</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</nav>
	
        <div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="jumbotron">
					<?php
						if(!isset($_SESSION['login_user'])) {
							header("Location: login.php?location=profile.php");
						}
						$playerKey = $_SESSION['user_key'];
						//echo $_SESSION['login_user'] . " " . $_SESSION['user_key'];
						echo "<h1>".$_SESSION['login_user']."'s characters</h1>";
					?>

						<table class="table table-hover">
							<thead>
								<tr>
									<th><div class="col-sm-2">Name</div></th>
									<th><div class="col-sm-2">Species</div></th>
									<th><div class="col-sm-2">Career</div></th>
									<th><div class="col-sm-2">Specialization</div></th>
									<th><div class="col-sm-2">Total Experience</div></th>
									<th><div class="col-sm-2"></div></th>
								</tr>
							</thead>
							<tbody>
							<?php
								$query = "select exon_character.Name, SPECIES.Name, CAREER.Name,
										SPEC.Name, exon_character.Experience, exon_character.DBKey from exon_character
										JOIN exon_species SPECIES on SPECIES.DBKey = exon_character.DBParentSpeciesKey
										JOIN exon_character_specialization CSPEC on CSPEC.DBParentCharacterKey = exon_character.DBKey
										JOIN exon_specialization SPEC on SPEC.DBKey = CSPEC.DBParentSpecializationKey
										JOIN exon_character_career CCAR on CCAR.DBParentCharacterKey = exon_character.DBKey
										JOIN exon_career CAREER on CAREER.DBKey = CCAR.DBParentCareerKey
										where exon_character.DBParentPlayerKey = $playerKey";
							$result = mysqli_query($db,$query) or die ("Error in query: $query. ".mysqli_error());
							//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
							if (mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_row($result)) {
									$charName = $row[0];
									$charSpecies = $row[1];
									$charCareer = $row[2];
									$charSpecial = $row[3];
									$charExperience = $row[4];
									$charKey = $row[5];
									echo "<tr>";
									echo "<td class=\"align-middle\"><div class=\"col-sm-2\">$charName</div></td>";
									echo "<td class=\"align-middle\"><div class=\"col-sm-2\">$charSpecies</div></td>";
									echo "<td class=\"align-middle\"><div class=\"col-sm-2\">$charCareer</div></td>";
									echo "<td class=\"align-middle\"><div class=\"col-sm-2\">$charSpecial</div></td>";
									echo "<td class=\"align-middle\"><div class=\"col-sm-2\">$charExperience</div></td>";
									echo "<td><div class=\"col-sm-2\"><div class=\"btn-group-vertical\">
										  <a href=\"character.php?char_id=$charKey\" class=\"btn btn-info role=\"button\">View</a>
										  <button type=\"button\" class=\"btn btn-success btn-sm\">Edit</button>
										  <button type=\"button\" class=\"btn btn-danger btn-sm\">Delete</button>
											</div></div></td>";
									echo "</tr>";
								}
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
        </div>
	</body>
</html>
