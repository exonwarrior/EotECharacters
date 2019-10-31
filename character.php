<?php
include('config.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dossier</title>
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/fontello.css">
		<script src="//use.edgefonts.net/advent-pro.js"></script>
		<meta name="viewport" content="width=device-width initial-scale=1.0, user-scalable=no">
	</head>
	<body>
		<div class="charListContainer">
			<div class="characterList">
				<h2>Characters</h2>
				<div class="characters">
					<?php
						//initializing variables
						$playerKey = "";
						$playerName = "";
						$characterKey = "";
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
						$armorType = "";
						$armorModel = "";
						$armorDefense = "";
						$armorSoak = "";

						// create query 
						$query = "SELECT * FROM exon_character";

						// execute query 
						$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

						// see if any rows were returned 
						if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
								$characterKey = $row[0];
								$playerKey = $row[1];
								$name = $row[2];
								$speciesKey = $row[3];
								$gender = $row[4];
								$age = $row[5];
								$height = $row[6];
								$build = $row[7];
								$hair = $row[8];
								$eyes = $row[9];
								$features = $row[10];
								$credits = $row[11];
								$wounds = $row[12];
								$strain = $row[13];
								$brawn = $row[14];
								$agility = $row[15];
								$intellect = $row[16];
								$cunning = $row[17];
								$willpower = $row[18];
								$presence = $row[19];
								$xpTotal = $row[20];
								$xpAvailable = $row[21];
								$imageURL = $row[22];
								echo '<div class="characterListName">'.$name.'</div>';
							}
						}
						// create query from exon_character_talent
						$query1 = "SELECT * FROM exon_armor WHERE DBParentCharacterKey='$characterKey'";

						// execute query 
						$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

						// see if any rows were returned 
						if (mysql_num_rows($result1) > 0) {
							while($row1 = mysql_fetch_row($result1)) {
								$armorType = $row1[2];
								$armorModel = $row1[3];
								$armorDefense = $row1[4];
								$armorSoak = $row1[5];
								$soakBonus = $armorSoak;
								$defenseMelee = $armorDefense;
								$defenseRanged = $armorDefense;
							}
						}
					?>
					<!--<button {{action 'createCharacter'}} class="icon-plus"></button>-->
				</div>
			</div>
		</div>
		<header class="characterInfo">
			<table class="inlineBlock">
				<tbody>
					<tr>
						<td class="fieldLabel col1">Species</td>
						<td class="field col2">
							<?php
							// create query 
							$query = "SELECT * FROM exon_species WHERE DBKey ='$speciesKey'";

							// execute query 
							$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

							// see if any rows were returned 
							if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
							$speciesName = $row[1];
							$speciesWounds = $row[8];
							$speciesStrain = $row[9];
							}
							}
							echo $speciesName;?>
						</td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Career</td>
						<td class="field col2">
							<?php
							//Initializing extra variables for player<->career matching
							$careerKey = "";
							$careerName = "";

							// create query to find Career Key from exon_character_career (stores pairs of Character and Career Keys)
							$query = "SELECT DBParentCareerKey FROM exon_character_career WHERE DBParentCharacterKey ='$characterKey'";

							// execute above query 
							$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

							// see if any rows were returned 
							if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
							$careerKey = $row[0];
							}
							}

							// create query to find Career Name from exon_career, based on previously selected DBParentCareerKey
							$query = "SELECT Name FROM exon_career WHERE DBKey ='$careerKey'";

							// execute above query 
							$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

							// see if any rows were returned 
							if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
							$careerName = $row[0];
							}
							}

							echo $careerName;
							?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Specialization</td>
						<td class="field col2">
							<?php
							//Initializing extra variables for player<->specialization matching
							$specKey = "";
							$specName = "";

							// create query to find Career Key from exon_character_career (stores pairs of Character and Career Keys)
							$query = "SELECT DBParentSpecializationKey FROM exon_character_specialization WHERE DBParentCharacterKey ='$characterKey'";

							// execute above query 
							$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

							// see if any rows were returned 
							if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
							$specKey = $row[0];
							}
							}

							// create query to find Career Name from exon_career, based on previously selected DBParentCareerKey
							$query = "SELECT Name FROM exon_specialization WHERE DBKey ='$specKey'";

							// execute above query 
							$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

							// see if any rows were returned 
							if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
							$specName = $row[0];
							}
							}

							echo $specName;
							?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Gender</td>
						<td class="field col2"><?php echo $gender;?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Age</td>
						<td class="field col2"><?php echo $age;?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Height</td>
						<td class="field col2"><?php echo $height.' cm';?></td>
					</tr>
				</tbody>
			</table>
			<table class="inlineBlock">
				<tbody>
					<tr>
						<td class="fieldLabel col1">Hair</td>
						<td class="field col2"><?php echo $hair;?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Eyes</td>
						<td class="field col2"><?php echo $eyes;?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Notable Features</td>
						<td class="field col2"><?php echo $features;?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Build</td>
						<td class="field col2"><?php echo $build;?></td>
					</tr>
					<tr>
						<td class="fieldLabel col1">Player</td>
						<td class="field col2">
							<?php
							// create query 
							$query = "SELECT * FROM exon_player WHERE DBKey ='$playerKey'";

							// execute query 
							$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

							// see if any rows were returned 
							if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
							$playerName = $row[1];
							}
							}
							echo $playerName;?>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="characterBadge inlineBlock">
				<?php echo '<img src="'.$imageURL.'" alt="" class="">'?>
				<h1 class="">
				<?php echo $name;?>
				</h1>
			</div>
		</header>

		<div class="character">
			<div class="characterStats">
				<h1>Current Stats</h1>
				<div class="statBox dual">
					<div class="row statRow">
						<div class="statLeft current"><?php echo $wounds;?>
							<div class="statBoxLabel">
								<button {{action 'addToStat' "woundsCurrent" 1}}>[+]</button> 
								Current 
								<button {{action 'addToStat' "woundsCurrent" -1}}>[-]</button>
							</div>
						</div>
						<div class="statRight threshold"><?php echo ($speciesWounds+$brawn);?>
							<div class="statBoxLabel">
								<button {{action 'addToStat' "woundsThreshold" 1}}>[+]</button> 
								Threshold 
								<button {{action 'addToStat' "woundsThreshold" -1}}>[-]</button>
							</div>
						</div>
					</div>
					<div class="statRow bottom">
						<div class="statLabel">Wounds
						</div>
					</div>
				</div>
				<div class="statBox dual">
					<div class="row statRow">
					<div class="statLeft current"><?php echo $strain;?>
						<div class="statBoxLabel">
							<button {{action 'addToStat' "strainCurrent" 1}}>[+]</button> 
							Current 
							<button {{action 'addToStat' "strainCurrent" -1}}>[-]</button>
						</div>
					</div>
					<div class="statRight threshold"><?php echo ($speciesStrain+$brawn);?>
						<div class="statBoxLabel">
							<button {{action 'addToStat' "strainThreshold" 1}}>[+]</button> 
							Threshold 
							<button {{action 'addToStat' "strainThreshold" -1}}>[-]</button>
						</div>
					</div>
					</div>
					<div class="statRow bottom">
					<div class="statLabel">Strain
					</div>
				</div>
			</div>
			<div class="statBox dual">
				<div class="row statRow">
					<div class="statLeft ranged"><?php echo $defenseRanged;?>
						<div class="statBoxLabel">
							<button {{action 'addToStat' "defenseRanged" 1}}>[+]</button> 
							Ranged 
							<button {{action 'addToStat' "defenseRanged" -1}}>[-]</button>
						</div>
					</div>
					<div class="statRight melee"><?php echo $defenseMelee;?>
						<div class="statBoxLabel">
							<button {{action 'addToStat' "defenseMelee" 1}}>[+]</button> 
							Melee 
							<button {{action 'addToStat' "defenseMelee" -1}}>[-]</button>
						</div>
					</div>
				</div>
				<div class="statRow bottom">
					<div class="statLabel">Defense
					</div>
				</div>
			</div>
			<div class="statBox solo">
				<div class="row statRow">
					<div class="statLeft"><?php echo ($brawn+$soakBonus);?>
						<div class="statBoxLabel">Brawn+Bonus
						</div>
					</div>
				</div>
				<div class="statRow bottom">
					<div class="statLabel">
						Soak
					</div>
				</div>
			</div>
		  </div> 
		<div class="characterCharacteristics">
			<div class="characteristicBox">
				<div class="characteristicValue"><?php echo $brawn;?></div>
				<div class="characteristicLabel">Brawn</div>
			</div>
			<div class="characteristicBox">
				<div class="characteristicValue"><?php echo $agility;?></div>
				<div class="characteristicLabel">Agility</div>
			</div>
			<div class="characteristicBox">
				<div class="characteristicValue"><?php echo $intellect;?></div>
				<div class="characteristicLabel">Intellect</div>
			</div>
			<div class="characteristicBox">
				<div class="characteristicValue"><?php echo $cunning;?></div>
				<div class="characteristicLabel">Cunning</div>
			</div>
			<div class="characteristicBox">
				<div class="characteristicValue"><?php echo $willpower;?></div>
				<div class="characteristicLabel">Willpower</div>
			</div>
			<div class="characteristicBox">
				<div class="characteristicValue"><?php echo $presence;?></div>
				<div class="characteristicLabel">Presence</div>
			</div>
		</div>
		<div class="characterSkills">
			<h1>Skills</h1>
			<div class="characterGeneralSkills contentBlock">
				<h2>General Skills</h2>
				<table class="">
					<thead>
						<tr>
							<td class="col1">Skill</td>
							<!--<td class="col2 adjustRank"></td>-->
							<td class="col3">Rank</td>
							<!--<td class="col4">Dice Pool</td>-->
						</tr>
					</thead>
					<tbody>
						<?php
							//initializing variables needed to display skills
							$skillKey1 = "";//DBKey from exon_skill
							$skillKey2 = "";//DBParentSkillKey from exon_character_skill
							$skillName = "";
							$skillType = "";
							$skillCharacteristic = "";
							$skillRank = "";
							$skillCombined = "";

							// create queries - first of all skills, then of player skills
							$query1 = "SELECT * FROM exon_skill WHERE Type='General'";
							$query2 = "SELECT * FROM exon_character_skill WHERE DBParentCharacterKey='$characterKey'";

							// execute query 
							$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

							// see if any rows were returned 
							if (mysql_num_rows($result1) > 0) {
								while($row1 = mysql_fetch_row($result1)) {
									$result2 = mysql_query($query2) or die ("Error in query: $query2. ".mysql_error()); 
									$skillKey1 = $row1[0];
									$skillRank = 0;
									while($row2 = mysql_fetch_row($result2)){
										$skillKey2 = $row2[2];
										if($skillKey1 == $skillKey2){						
											$skillRank = $row2[4];
											break 1;
										}
									}
									$skillName = $row1[1];
									$skillCharacteristic = $row1[2];
									$skillCombined = $skillName.' ('.$skillCharacteristic.')';					
									echo '<tr>';
									echo '<td style="text-align:left">'.$skillCombined.'</td>';
									echo '<td style="text-align:center">'.$skillRank.'</td>';
									echo '</tr>';
								}
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="characterOtherSkills contentBlock">
				<h2>Combat Skills</h2>
				<table class="">
					<thead>
						<tr>
							<td class="col1">Skill</td>
							<!--<td class="col2 adjustRank"></td>-->
							<td class="col3">Rank</td>
							<!--<td class="col4">Dice Pool</td>-->
						</tr>
					</thead>
					<tbody>
						<?php
							//initializing variables needed to display skills
							$skillKey1 = "";//DBKey from exon_skill
							$skillKey2 = "";//DBParentSkillKey from exon_character_skill
							$skillName = "";
							$skillType = "";
							$skillCharacteristic = "";
							$skillRank = "";
							$skillCombined = "";

							// create queries - first of all skills, then of player skills
							$query1 = "SELECT * FROM exon_skill WHERE Type='Combat'";
							$query2 = "SELECT * FROM exon_character_skill WHERE DBParentCharacterKey='$characterKey'";

							// execute query 
							$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

							// see if any rows were returned 
							if (mysql_num_rows($result1) > 0) {
								while($row1 = mysql_fetch_row($result1)) {
									$result2 = mysql_query($query2) or die ("Error in query: $query2. ".mysql_error()); 
									$skillKey1 = $row1[0];
									$skillRank = 0;
									while($row2 = mysql_fetch_row($result2)){
										$skillKey2 = $row2[2];
										if($skillKey1 == $skillKey2){						
											$skillRank = $row2[4];
											break 1;
										}
									}
									$skillName = $row1[1];
									$skillCharacteristic = $row1[2];
									$skillCombined = $skillName.' ('.$skillCharacteristic.')';					
									echo '<tr>';
									echo '<td style="text-align:left">'.$skillCombined.'</td>';
									echo '<td style="text-align:center">'.$skillRank.'</td>';
									echo '</tr>';
								}
							}
						?>
					</tbody>
				</table>

			<h2>Knowledge Skills</h2>
			<table class="">
				<thead>
					<tr>
						<td class="col1">Skill</td>
						<!--<td class="col2 adjustRank"></td>-->
						<td class="col3">Rank</td>
						<!--<td class="col4">Dice Pool</td>-->
					</tr>
				</thead>
				<tbody>
				<?php
					 //initializing variables needed to display skills
					$skillKey1 = "";//DBKey from exon_skill
					$skillKey2 = "";//DBParentSkillKey from exon_character_skill
					$skillName = "";
					$skillType = "";
					$skillCharacteristic = "";
					$skillRank = "";
					$skillCombined = "";

					// create queries - first of all skills, then of player skills
					$query1 = "SELECT * FROM exon_skill WHERE Type='Knowledge'";
					$query2 = "SELECT * FROM exon_character_skill WHERE DBParentCharacterKey='$characterKey'";

					// execute query 
					$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

					// see if any rows were returned 
					if (mysql_num_rows($result1) > 0) {
						while($row1 = mysql_fetch_row($result1)) {
							$result2 = mysql_query($query2) or die ("Error in query: $query2. ".mysql_error()); 
							$skillKey1 = $row1[0];
							$skillRank = 0;
							while($row2 = mysql_fetch_row($result2)){
								$skillKey2 = $row2[2];
								if($skillKey1 == $skillKey2){						
									$skillRank = $row2[4];
									break 1;
								}
							}
							$skillName = $row1[1];
							$skillCharacteristic = $row1[2];
							$skillCombined = $skillName.' ('.$skillCharacteristic.')';					
							echo '<tr>';
							echo '<td style="text-align:left">'.$skillCombined.'</td>';
							echo '<td style="text-align:center">'.$skillRank.'</td>';
							echo '</tr>';
						}
					}
				?>
				</tbody>
			</table>
			<!--<h2>Custom Skills [+]</h2>
			<table class="">
			<thead>
			<tr>
			<td class="col1">Skill</td>
			<td class="col2">Rank</td>
			</tr>
			</thead>
			<tbody>
			<!--{{#each rank in customSkills}}
			{{control "rank" rank}}
			{{/each}}
			</tbody>
			</table>-->
			</div>
		  </div>
			<div class="characterWeaponsContainer">
				<div class="characterTalents">
					<h1>Talents</h1>
						<div class="contentBlock col5">
							<table class="">
								<thead>
									<tr>
										<td class="col1">Talent</td>
										<td class="col2">Activation</td>
										<td class="col3">Rank</td>
										<td class="col4">Page</td>
										<td class="col5">Description</td>
									</tr>
								</thead>
								<tbody>
									<?php
										//initializing variables needed to display talents
										$talentKey = "";//DBKey from exon_talent
										//$talentKey2 = "";//DBParentSkillKey from exon_character_talent
										$talentName = "";
										$talentActivation = "";
										$talentRanked = "";
										$talentPage = "";
										$talentRank = "";

										// create query from exon_character_talent
										$query1 = "SELECT * FROM exon_character_talent WHERE DBParentCharacterKey='$characterKey'";

										// execute query 
										$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

										// see if any rows were returned 
										if (mysql_num_rows($result1) > 0) {
											while($row1 = mysql_fetch_row($result1)) {
												$talentKey = $row1[2];
												$query2 = "SELECT DBKey,Name,Activation,Ranked,Page FROM exon_talent WHERE DBKey='$talentKey'";
												$result2 = mysql_query($query2) or die ("Error in query: $query2. ".mysql_error());
												$row2 = mysql_fetch_row($result2);
												if($talentKey == $row2[0]){
													$talentName = $row2[1];
													$talentActivation = $row2[2];
													$talentPage = $row2[4];
													$talentDesc = $row[5];
													if($row2[2]=="Yes"){
														$talentRank = $row1[3];
													} else {
														$talentRank = "";
													}
													echo '<tr>';
													echo '<td style="text-align:left">'.$talentName.'</td>';
													echo '<td style="text-align:center">'.$talentActivation.'</td>';
													echo '<td style="text-align:center">'.$talentRank.'</td>';
													echo '<td style="text-align:center">'.$talentPage.'</td>';
													echo '<td style="text-align:right">'.$talentDesc.'</td>';
													echo '</tr>';
												}				
											}
										}
									?>
								</tbody>
							</table>
					</div>
				</div>
			</div>
		  <div class="characterWeaponsContainer">
			<div class="characterWeapons">
			  <h1>Weapons <button {{action createWeapon}}>[+]</button></h1>
			  <div class="contentBlock col6">
				<table class="">
				  <thead>
					<tr>
					  <td class="col1">Weapon</td>
					  <td class="col2">Skill</td>
					  <td class="col3">Damage</td>
					  <td class="col4">Range</td>
					  <td class="col5">Crit</td>
					  <td class="col6">Special</td>
					</tr>
				  </thead>
				  <tbody>
				<?php
					//initializing variables needed to display weapons
					$weaponKey = "";//DBKey from exon_weapon
					$weaponName = "";
					$weaponSkill = "";
					$weaponDamage = "";
					$weaponRange = "";
					$weaponCrit = "";
					$weaponSpecial = "";

					// create query from exon_character_talent
					$query1 = "SELECT * FROM exon_weapon WHERE DBParentCharacterKey='$characterKey'";

					// execute query 
					$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

					// see if any rows were returned 
					if (mysql_num_rows($result1) > 0) {
						while($row1 = mysql_fetch_row($result1)) {
							$weaponKey = $row1[1];
							$weaponName = $row1[3];
							$weaponSkill = $row1[4];
							if($weaponSkill == "Melee" or $weaponSkill == "Brawl"){
								$weaponDamage = $brawn+$row1[5];
							} else {
								$weaponDamage = $row1[5];
							}
							$weaponRange = $row1[6];
							$weaponCrit = $row1[7];
							$weaponSpecial = $row1[8];
							echo '<tr>';
							echo '<td style="text-align:left">'.$weaponName.'</td>';
							echo '<td style="text-align:center">'.$weaponSkill.'</td>';
							echo '<td style="text-align:center">'.$weaponDamage.'</td>';
							echo '<td style="text-align:center">'.$weaponRange.'</td>';
							echo '<td style="text-align:center">'.$weaponCrit.'</td>';
							echo '<td style="text-align:center">'.$weaponSpecial.'</td>';
							echo '</tr>';			
						}
					}
				?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <div class="characterEquipment">
			<div class="characterArmor twoUp">
			  <h1>Armor <button {{action 'createArmor'}}>[+]</button></h1>
			  <div class="contentBlock col4">
				<table>
				  <thead>
					<tr>
					  <td class="col1">Type</td>
					  <td class="col2">Model</td>
					  <td class="col3">Defense</td>
					  <td class="col4">Soak</td>
					</tr>
				  </thead>
				  <tbody>
				   <?php
				echo '<tr>';
				echo '<td style="text-align:left">'.$armorType.'</td>';
				echo '<td style="text-align:center">'.$armorModel.'</td>';
				echo '<td style="text-align:center">'.$armorDefense.'</td>';
				echo '<td style="text-align:center">'.$armorSoak.'</td>';
				echo '</tr>';
			?>
				  </tbody>
				</table>
			  </div>
			</div>
			<div class="characterInventory twoUp">
			  <h1>Inventory <button {{action 'createInventoryItem'}}>[+]</button></h1>
			  <div class="contentBlock col2">
				<table>
				  <thead>
					<tr>
					  <td class="col1">Name</td>
					  <td class="col2">Type</td>
					</tr>
				  </thead>
				  <tbody>
				   <?php
				//initializing variables needed to display gear
				$gearName = "";
				$gearType = "";

				// create query from exon_gear
				$query1 = "SELECT * FROM exon_gear WHERE DBParentCharacterKey='$characterKey'";

				// execute query 
				$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

				// see if any rows were returned 
				if (mysql_num_rows($result1) > 0) {
					while($row1 = mysql_fetch_row($result1)) {
						$gearName = $row1[3];
						$gearType = $row1[4];
						echo '<tr>';
						echo '<td style="text-align:left">'.$gearName.'</td>';
						echo '<td style="text-align:center">'.$gearType.'</td>';
						echo '</tr>';			
					}
				}
			?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		  <div class="characterMiscInfo">
			<div class="characterCritInjuries twoUp">
			  <h1>Critical Injuries <button {{action 'createCriticalInjury'}}>[+]</button></h1>
			  <div class="contentBlock col4">
				<table>
				  <thead>
					<tr>
					  <td class="col1">Result</td>
					  <td class="col2">Severity</td>
					  <td class="col3">Name</td>
					  <td class="col4">Description</td>
					</tr>
				  </thead>
				  <tbody>
			<?php
				//initializing variables needed to display crits
				$critName = "";
				$critResult = "";
				$critSeverity = "";
				$critDesc = "";

				// create query from exon_character_talent
				$query1 = "SELECT * FROM exon_critical WHERE DBParentCharacterKey='$characterKey'";

				// execute query 
				$result1 = mysql_query($query1) or die ("Error in query: $query1. ".mysql_error());

				// see if any rows were returned 
				if (mysql_num_rows($result1) > 0) {
					while($row1 = mysql_fetch_row($result1)) {
						$critResult = $row1[3];
						$critSeverity = $row1[4];
						$critName = $row1[5];
						$critDesc = $row1[6];
						echo '<tr>';
						echo '<td style="text-align:left">'.$critResult.'</td>';
						echo '<td style="text-align:center">'.$critSeverity.'</td>';
						echo '<td style="text-align:center">'.$critName.'</td>';
						echo '<td style="text-align:center">'.$critDesc.'</td>';
						echo '</tr>';			
					}
				}
			?>
				  </tbody>
				</table>
			  </div>
			</div>
			<div class="characterXP twoUp">
			  <h1>XP and Credits<button {{action 'createXPItem'}}>[+]</button></h1>
			  <div class="contentBlock col2">
			<table>
				  <thead>
					<tr>
					  <td class="col1">Credits</td>
					  <td class="col2"></td>
					</tr>
				  </thead>
				  <tbody>
					 <tr class="total">
					  <td class="col1"><strong><?php echo $credits; ?></strong></td>
					  <td class="col2"><strong></strong></td> 
					</tr>
				  </tbody>
				</table>
				<table>
				  <thead>
					<tr>
					  <td class="col1"></td>
					  <td class="col2">Amount</td>
					</tr>
				  </thead>
				  <tbody>
					 <tr class="total">
					  <td class="col1"><strong>Total XP</strong></td>
					  <td class="col2"><strong><?php echo $xpTotal; ?></strong></td> 
					</tr>
					<tr>
					  <td class="col1"><strong>Available XP</strong></td>
					  <td class="col2"><strong><?php echo $xpAvailable; ?></strong></td>
					</tr>
				  </tbody>
				</table>
			  </div>
			</div>
			  <div class="characterMotivation twoUp">
			  <h1>Motivations <button {{action 'createMotivation'}}>[+]</button></h1>
			  <table>
				  <thead>
					<tr>
					  <td class="col1">Type</td>
					  <td class="col3">Details</td>
					</tr>
				  </thead>
				<tbody>
				<?php
					//Initializing extra variables for player<->motivation matching
					$motivationKey = "";
					$motivationType = "";
					$motivationDesc = "";

					// create query to find Motivation Key from exon_character_motivation (stores pairs of Character and Motivation Keys)
					$query = "SELECT DBParentMotivationKey FROM exon_character_motivation WHERE DBParentCharacterKey ='$characterKey'";

					// execute above query 
					$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

					// see if any rows were returned 
					if (mysql_num_rows($result) > 0) {
						while($row = mysql_fetch_row($result)) {
							$motivationKey = $row[0];
							// create query to find Motivation Type and Description from exon_motivation, based on previously selected DBParentMotivationKey
							$query2 = "SELECT Type,Description FROM exon_motivation WHERE DBKey ='$motivationKey'";

							// execute above query 
							$result2 = mysql_query($query2) or die ("Error in query: $query. ".mysql_error()); 

							// see if any rows were returned 
							if (mysql_num_rows($result2) > 0) {
								while($row2 = mysql_fetch_row($result2)) {
									$motivationType = $row2[0];
									$motivationDesc = $row2[1];
								}
							}
							echo '<tr>';
							echo '<td style="text-align:left">'.$motivationType.'</td>';
							echo '<td>'.$motivationDesc.'</td>';
							echo '</tr>';
						}
					}
				?>
				</tbody>
			  </table>
			</div>
			<div class="characterObligation twoUp">
			  <h1>Obligation <button {{action 'createObligation'}}>[+]</button></h1>
			  <div class="contentBlock col3">
				<table>
				  <thead>
					<tr>
					  <td class="col1">Type</td>
					  <td class="col2">Magnitude</td>
					  <td class="col3">Details</td>
					</tr>
				  </thead>
				  <tbody>
					<?php
						//Initializing extra variables for player<->obligation matching
						$obligationKey = "";
						$obligationType = "";
						$obligationMagnitude = "";
						$obligationDesc = "";

						// create query to find Motivation Key from exon_character_obligation (stores pairs of Character and Obligation Keys)
						$query = "SELECT DBParentObligationKey FROM exon_character_obligation WHERE DBParentCharacterKey ='$characterKey'";

						// execute above query 
						$result = mysql_query($query) or die ("Error in query: $query. ".mysql_error()); 

						// see if any rows were returned 
						if (mysql_num_rows($result) > 0) {
							while($row = mysql_fetch_row($result)) {
								$obligationKey = $row[0];
								
								// create query to find Obligation Type, Magnitude and Description from exon_obligation, based on previously selected DBParentObligationKey
								$query2 = "SELECT Type,Magnitude,Description FROM exon_obligation WHERE DBKey ='$obligationKey'";

								// execute above query 
								$result2 = mysql_query($query2) or die ("Error in query: $query. ".mysql_error()); 

								// see if any rows were returned 
								if (mysql_num_rows($result2) > 0) {
									while($row2 = mysql_fetch_row($result2)) {
										$obligationType = $row2[0];
										$obligationMagnitude = $row2[1];
										$obligationDesc = $row2[2];
									}
								}
								echo '<tr>';
								echo '<td style="text-align:left">'.$obligationType.'</td>';
								echo '<td>'.$obligationMagnitude.'</td>';
								echo '<td>'.$obligationDesc.'</td>';
								echo '</tr>';
							}
						}
					?></tr>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>
	</body>
</html>
