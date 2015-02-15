<?php
	session_start();
	require_once('connection.php');

	//Array to store validation errors
	$errmsg_arr = array();

	//Validation error flag
	$errflag = false;

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
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

	mysql_query("INSERT INTO exon_character(Name,DBParentSpeciesKey,Gender,Age,Height,Build,Hair,Eyes,Features)
	VALUES('$charName','$charSpeciesKey','$charGender','$charAge','$charHeight','$charBuild','$charHair','$charEyes','$charFeatures')");
	$result = mysql_query("SELECT DBKey FROM exon_character WHERE DBKey=(SELECT MAX(DBKey) FROM exon_character)");
	if (mysql_num_rows($result)>0){
		while($row = mysql_fetch_row($result)) {
			$charKey=$row[0];
		}
	}
	mysql_query("INSERT INTO exon_character_career(DBParentCharacterKey,DBParentCareerKey)VALUES('$charKey','$charCareerKey'");
	mysql_query("INSERT INTO exon_character_specialization(DBParentCharacterKey,DBParentSpecializationKey)VALUES('$charKey','$charSpecializationKey'");
	mysql_close($con);
?>
