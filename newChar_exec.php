<?php
	session_start();
	include('config.php');

	//Array to store validation errors
	$errmsg_arr = array();

	//Validation error flag
	$errflag = false;

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		$str = stripslashes($str);
		return mysqli_real_escape_string($str);
	}

	//Initialize variable to store exon_character DBKey
	$charKey = "";

	//Sanitize the POST values and shorten Key strings to remove "XKey=" from beginning
	$charName = clean($_POST['charName']);
	$charSpeciesKeyLong = clean($_POST['charSpecies']);
	$charSpeciesKey = substr($charSpeciesKeyLong,11);
	$charCareerKeyLong = clean($_POST['charCareer']);
	$charCareerKey = substr($charCareerKeyLong,10);
	$charSpecializationKeyLong = clean($_POST['charSpecialization']);
	$charSpecializationKey = substr($charSpecializationKeyLong,8);
	$charGender = clean($_POST['charGender']);
	$charAge = clean($_POST['charAge']);
	$charHeight = clean($_POST['charHeight']);
	$charHair = clean($_POST['charHair']);
	$charEyes = clean($_POST['charEyes']);
	$charFeatures = clean($_POST['charFeatures']);
	$charBuild = clean($_POST['charBuild']);
	$speciesSkillKey = 0;

	//Input Validations
	if($charName == '') {
		$errmsg_arr[] = 'Character name missing';
		$errflag = true;
	}
	if($charAge == '') {
		$errmsg_arr[] = 'Character age missing';
		$errflag = true;
	}
	if($charHeight == '') {
		$errmsg_arr[] = 'Character height missing';
		$errflag = true;
	}
	if($charHair == '') {
		$errmsg_arr[] = 'Character hair color missing';
		$errflag = true;
	}
	if($charEyes == '') {
		$errmsg_arr[] = 'Character eye color missing';
		$errflag = true;
	}
	if($charFeatures == '') {
		$errmsg_arr[] = 'Notable features missing';
		$errflag = true;
	}
	if($charBuild == '') {
		$errmsg_arr[] = 'Character build type missing';
		$errflag = true;
	}

	//If there are input validations, redirect back to the new character form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: newcharacter.php");
		exit();
	}

	mysqli_query("INSERT INTO exon_character(Name,DBParentSpeciesKey,Gender,Age,Height,Build,Hair,Eyes,Features)
	VALUES('$charName','$charSpeciesKey','$charGender','$charAge','$charHeight','$charBuild','$charHair','$charEyes','$charFeatures')");
	
	$result = mysqli_query("SELECT DBKey FROM exon_character WHERE DBKey=(SELECT MAX(DBKey) FROM exon_character)");
	if (mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_row($result)) {
			$charKey=$row[0];
		}
	}
	
	$result = mysql_query("SELECT * FROM exon_species WHERE DBKey='$charSpeciesKey'");
	if (mysql_num_rows($result)>0){
		while($row = mysql_fetch_row($result)) {
			$i = 2;
			while($i<8){
				echo 'Char'.$i.'='.$row[$i];
				$i++;
			}
			mysql_query("UPDATE exon_character SET Brawn=$row[2],Agility=$row[3],Intellect=$row[4],Cunning=$row[5],Willpower=$row[6],Presence=$row[7],XPTotal=$row[10],XPAvailable=$row[10] WHERE DBKey='$charKey'") or die(mysql_error());
			if(!is_null($row[11])){
				$speciesSkillKey = $row[11];
			}
		}
	}

	mysql_query("INSERT INTO exon_character_career(DBParentCharacterKey,DBParentCareerKey)VALUES('$charKey','$charCareerKey')");
	mysql_query("INSERT INTO exon_character_specialization(DBParentCharacterKey,DBParentSpecializationKey)VALUES('$charKey','$charSpecializationKey')");
	
	$fullprice = 1;
	
	$result = mysql_query("SELECT * FROM exon_career WHERE DBKey=$charCareerKey");
	if (mysql_num_rows($result)>0){
		$i = 2;
		while($row = mysql_fetch_row($result)) {
			if($speciesSkillKey == $row[$i]){
				$fullprice=0;
			}
			$i++;
		}
	}
	
	$result = mysql_query("SELECT DBKey FROM exon_specialization WHERE DBKey=$charSpecializationKey");
	if (mysql_num_rows($result)>0){
		$i = 3;
		while($row = mysql_fetch_row($result)) {
			if($speciesSkillKey == $row[$i]){
				$fullprice=0;
			}
			$i++;
		}
	}
	
	if($speciesSkillKey > 0){
		mysql_query("INSERT INTO exon_character_skill(DBParentCharacterKey,DBParentSkillKey,FullPrice,Rank)VALUES('$charKey','$speciesSkillKey','$fullprice','1')");
	}
	
	mysql_close($con);
?>
