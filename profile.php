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
		<!-- Old CSS -->
		<!--<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/fontello.css">
		<script src="//use.edgefonts.net/advent-pro.js"></script>-->
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
			<div class="jumbotron col-sm-12">
				<?php
					if(!isset($_SESSION['login_user'])) {
						header("Location: login.php?location=profile.php");
					}
					$playerKey = $_SESSION['user_key'];
					//echo $_SESSION['login_user'] . " " . $_SESSION['user_key'];
					echo "<h1>".$_SESSION['login_user']."'s characters</h1>";
				?>
				<div class="row">
					<?php
						$query = "select exon_character.Name, SPECIES.Name, CAREER.Name,
								SPEC.Name, exon_character.Experience, exon_character.DBKey, exon_character.Image from exon_character
								JOIN exon_species SPECIES on SPECIES.DBKey = exon_character.DBParentSpeciesKey
								JOIN exon_character_specialization CSPEC on CSPEC.DBParentCharacterKey = exon_character.DBKey
								JOIN exon_specialization SPEC on SPEC.DBKey = CSPEC.DBParentSpecializationKey
								JOIN exon_character_career CCAR on CCAR.DBParentCharacterKey = exon_character.DBKey
								JOIN exon_career CAREER on CAREER.DBKey = CCAR.DBParentCareerKey
								where exon_character.DBParentPlayerKey = $playerKey";
					$result = mysqli_query($db,$query) or die ("Error in query: $query. ".mysqli_error());
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_row($result)) {
							$charName = $row[0];
							$charSpecies = $row[1];
							$charCareer = $row[2];
							$charSpecial = $row[3];
							$charExperience = $row[4];
							$charKey = $row[5];
							$charImage = $row[6];
							echo "<div class=\"col-sm-4\">";
								echo "<div class=\"card\">";
									echo '<img class="card-img-top img-thumbnail" src="data:image/png;base64,'.base64_encode( $charImage ).'"/>';
									echo "<div class=\"card body\">";
										echo "<h4 class=\"card-title\">$charName</h4>";
										echo "<table class=\"table table-hover table-sm\">";
											echo "<tbody>";
												echo "<tr><td style=\"text-align:left\">Species</td>";
												echo "<td style=\"text-align:right\">$charSpecies</td></tr>";
												echo "<tr><td style=\"text-align:left\">Career</td>";
												echo "<td style=\"text-align:right\">$charCareer</td></tr>";
												echo "<tr><td style=\"text-align:left\">Specialization</td>";
												echo "<td style=\"text-align:right\">$charSpecial</td></tr>";
												echo "<tr><td style=\"text-align:left\">Experience</td>";
												echo "<td style=\"text-align:right\">$charExperience</td></tr>";
											echo "</tbody>";
										echo "</table>";
										echo "<div class=\"d-flex justify-content-center\">
												<div class=\"btn-group-lg\">
													<a href=\"character.php?char_id=$charKey\" class=\"btn btn-info role=\"button\">View</a>
													<button type=\"button\" class=\"btn btn-success btn-sm\">Edit</button>
													<button type=\"button\" class=\"btn btn-danger btn-sm\">Delete</button>
												</div>
											</div>";				
									echo "</div>";
								echo "</div>";
							echo "</div>";
						}
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
