<?php
session_start();
include('config.php');

function nvl($val, $replace)
{
    if( is_null($val) || $val === '' )  return $replace;
    else                                return $val;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Exon9's Online Edge of the Empire Character Portfolio</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="//use.edgefonts.net/advent-pro.js"></script>
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
					<a class="nav-link" href="profile.php">My Characters</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</nav>

    <?php
        if(!isset($_SESSION['login_user'])) {
            header("Location: login.php?location=character.php?char_id=" . $_SESSION['char_key']);
        }
        $playerKey = $_SESSION['user_key'];
        //initializing variables
        $playerName = "";
        $characterKey = "";
        $characterKey = htmlspecialchars($_GET["char_id"]);
        $name = "";
        $speciesKey = "";
        $speciesName = "";
        $speciesWounds = "";
        $speciesStrain = "";
        $gender = "";
        $age = "";
        $height = "";
        $build = "";
        $hair = "";
        $eyes = "";
        $features = "";
        $brawn = "";
        $agility = "";
        $intellect = "";
        $cunning = "";
        $willpower = "";
        $presence = "";
        $imageURL = "";
        $xpTotal = "";
        $xpAvailable = "";
        $credits = "";
        $wounds = "";
        $strain = "";
        $defenseMelee = 0;
        $defenseRanged = 0;
        $soakBonus = 0;
        $armorKey = "";
        $armorType = "";
        $armorModel = "";
        $armorDefense = "";
        $armorSoak = "";

        // create query
        $query = "SELECT exon_character.*, CAREER.Name, SPECIALIZATION.Name FROM exon_character 
					join exon_character_career CCAREER on CCAREER.dbparentcharacterkey = exon_character.DBKEY
					join exon_career CAREER on CAREER.DBKey = CCAREER.DBPARENTCAREERKEY
					join exon_character_specialization CSPECIAL on CSPECIAL.dbparentcharacterkey = exon_character.DBKEY
					join exon_specialization SPECIALIZATION on SPECIALIZATION.DBKey = CSPECIAL.DBPARENTSPECIALIZATIONKEY
					where exon_character.dbkey = '$characterKey'";

        // execute query
        $result = mysqli_query($db,$query) or die ("Error in query: $query. ".mysqli_error());

        // see if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_row($result)) {
                $characterKey = $row[0];
                $playerKey = $row[1];
                $name = $row[3];
                $speciesKey = $row[2];
                $gender = $row[4];
                $age = $row[5];
                $height = $row[6];
                $build = $row[7];
                $hair = $row[8];
                $eyes = $row[9];
                $features = $row[10];
                //$credits = $row[11];
                $wounds = $row[17];
                $strain = $row[19];
                $brawn = $row[11];
                $agility = $row[12];
                $intellect = $row[13];
                $cunning = $row[14];
                $willpower = $row[15];
                $presence = $row[16];
                //$xpTotal = $row[20];
                $xpAvailable = $row[21];
				$charImage = $row[23];
                $characterCareer = $row[24];
				$characterSpecial = $row[25];
            }
        }
    ?>
        <div class="container">
           <h1><?php echo $name;?></h1>
			<div class="row">
				<div class="col-sm-4">      
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>Species</td>
								<td><?php echo $speciesKey;?></td>
							</tr>
							<tr>
								<td>Career</td>
								<td><?php echo $characterCareer;?></td>
							</tr>
							<tr>
								<td>Specialization</td>
								<td><?php echo $characterSpecial;?></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td><?php echo $gender;?></td>
							</tr>
							<tr>
								<td>Age</td>
								<td><?php echo $age;?></td>
							</tr>
							<tr>
								<td>Height</td>
								<td><?php echo $height;?> cm</td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="col-sm-4">      
					<table class="table table-hover">
						<tbody>
							<tr>
								<td>Hair</td>
								<td><?php echo $hair;?></td>
							</tr>
							<tr>
								<td>Eyes</td>
								<td><?php echo $eyes;?></td>
							</tr>
							<tr>
								<td>Notable features</td>
								<td><?php echo $features;?></td>
							</tr>
							<tr>
								<td>Build</td>
								<td><?php echo $build;?></td>
							</tr>
							<tr>
								<td>Player</td>
								<td><?php echo $playerName;?></td>
							</tr>
						</tbody>
					</table>
				</div>
				
				<div class="col-sm-4">
					<?php echo '<img class="img-fluid img-thumbnail" src="data:image/png;base64,'.base64_encode( $charImage ).'"/>';?>
				</div>
			</div>
		</div>

        <div class="container">
            <h2>Characteristics</h2>
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th style="text-align:center">Brawn</th>
                                <th style="text-align:center">Agility</th>
                                <th style="text-align:center">Intellect</th>
                                <th style="text-align:center">Cunning</th>
                                <th style="text-align:center">Willpower</th>
                                <th style="text-align:center">Presence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center"><?php echo $brawn;?></td>
                                <td style="text-align:center"><?php echo $agility;?></td>
                                <td style="text-align:center"><?php echo $intellect;?></td>
                                <td style="text-align:center"><?php echo $cunning;?></td>
                                <td style="text-align:center"><?php echo $willpower;?></td>
                                <td style="text-align:center"><?php echo $presence;?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

		<div class="container">
			<h2>Skills</h2>
			<div class="row">
				<div class="col-sm-6">   
					<h4>General Skills</h4>
					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th style="text-align:left">Skill</td>
								<th style="text-align:center">Career</td>
								<th style="text-align:center">Rank</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align:left">Astrogation (Intellect)</td>
								<td style="text-align:center">Yes</td>
								<td style="text-align:center">2</td>
							</tr>
							<tr>
								<td style="text-align:left">Athletics (Brawn)</td>
								<td style="text-align:center">No</td>
								<td style="text-align:center">0</td>
							</tr>
							<tr>
								<td style="text-align:left">Charm (Presence)</td>
								<td style="text-align:center">No</td>
								<td style="text-align:center">0</td>
							</tr>
							<tr>
								<td style="text-align:left">Coercion (Willpower)</td>
								<td style="text-align:center">No</td>
								<td style="text-align:center">1</td>
							</tr>
							<tr>
								<td style="text-align:left">Computers (Intellect)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Cool (Presence)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Coordination (Agility)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Deception (Cunning)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Discipline (Willpower)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Leadership (Presence)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Mechanics (Intellect)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Medicine (Intellect)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Negotiate (Presence)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Perception (Cunning)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Piloting (Planetary) (Agility)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Piloting (Space) (Agility)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Resilience (Brawn)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Skullduggery (Cunning)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Stealth (Agility)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Streetwise (Cunning)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Survival (Cunning)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Vigilance (Willpower)</td><td style="text-align:center">No</td><td style="text-align:center">0</td></tr>					</tbody>
					</table>
				</div>
				<div class="col-sm-6">   
					<h4>Combat Skills</h4>
					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th class="col1">Skill</td>
								<th class="col3">Rank</td>
							</tr>
						</thead>
						<tbody>
						<tr><td style="text-align:left">Brawl (Brawn)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Gunnery (Agility)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Melee (Brawn)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Ranged (Heavy) (Agility)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Ranged (Light) (Agility)</td><td style="text-align:center">0</td></tr>					</tbody>
					</table>

					<h4>Knowledge Skills</h4>
					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th class="col1">Skill</td>
								<th class="col3">Rank</td>
							</tr>
						</thead>
						<tbody>
							<tr><td style="text-align:left">Core Worlds (Intellect)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Education (Intellect)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Lore (Intellect)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Outer Rim (Intellect)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Underworld (Intellect)</td><td style="text-align:center">0</td></tr><tr><td style="text-align:left">Xenology (Intellect)</td><td style="text-align:center">0</td></tr>				</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<div class="container">
			<h2>Talents</h2>
			<div class="row">
				<div class="col-sm-12 table-responsive">
					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th style="text-align:left">Talent</td>
								<th style="text-align:center">Activation</td>
								<th style="text-align:center">Rank</td>
								<th style="text-align:right">Description</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align:left">Anatomy Lessons</td>
								<td style="text-align:center">Active (Incidental)</td>
								<td style="text-align:center">0</td>
								<td style="text-align:right">Can do cool shit</td>
							</tr>
					</table>
				</div>
			</div>
		</div>
		
		<div class="container">
			<h2>Weapons</h2>
			<div class="row">
				<div class="col-sm-12 table-responsive">
					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th class="col1">Weapon</td>
								<th class="col2">Skill</td>
								<th class="col3">Damage</td>
								<th class="col3">Range</td>
								<th class="col3">Crit</td>
								<th class="col3">Special</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align:left">Blurrg-1120</td>
								<td style="text-align:center">Ranged (Light)</td>
								<td style="text-align:center">5</td>
								<td style="text-align:center">Short</td>
								<td style="text-align:center">4</td>
								<td style="text-align:right">Can do cooler shit</td>
							</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">   
					<h3>Armor</h3>
					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th class="col1">Model</td>
								<th class="col1">Soak</td>
								<th class="col2">Melee Defense</td>
								<th class="col3">Ranged Defense</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align:left">Armor</td>
								<td style="text-align:center">2</td>
								<td style="text-align:right">1</td>
								<td style="text-align:right">1</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-sm-6">   
					<h3>Inventory</h3>
					<table class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th class="col1">Name</td>
								<th class="col3">Description</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td style="text-align:left">Comlink</td>
								<td style="text-align:center">Talks to people</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>