<?php

$pReply = $ppReply = $aReply = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$password = $confirm = $aboutme = "";
	$pExist = $aExist = $picExist = false;

	$target_dir = "images/profile/";

	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
	$file_name = "profpic_" . $la_id .".".$file_type;
	$file_size = $_FILES["fileToUpload"]["size"];
	$img_file = $_FILES["fileToUpload"]["tmp_name"];

	if($file_size > 0)
	{
		$picExist = true;
		$toPost = uploadPicture($target_dir.$file_name, $file_type, $file_name, $file_size, $_FILES["fileToUpload"]["tmp_name"]);
		
		if($toPost == true)
		{
			changeProfilePicture($la_id, $file_name);
			$ppReply = "Successfuly changed profile picture!";
		} else  $ppReply = "Failed to change profile picture.";
	}

	if(!empty($_POST["password"]) && !empty($_POST["confirmPassword"]))
	{
		$password = test_input($_POST["password"]);
		$confirmPassword = test_input($_POST["confirmPassword"]);

		if(strcmp($password, $confirmPassword) == 0)
		{
			changePassword($la_id, $password);
			$pReply = "Successfuly changed password!";
		} else $pReply = "Password does not match";
	}

	if(!empty($_POST["aboutme"]))
	{
		$aExist = true;
		changeAboutMe($la_id, $_POST["aboutme"]);
		$aReply = "Successfully changed About me.";
	}
}

?>