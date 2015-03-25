<?php

include 'functions.php';

loadAll();

/* Variables */
$firstname = $lastname = $cUser = $password = $email = "";
$fnErr = $lnErr= $unErr = $pwErr = $emErr = "";
$isErr = false;
$greeting = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST["firstname"])) {
     	$fnErr = "Firstname is required";
     	$isErr = true;
   	} else {
     	$firstname = test_input($_POST["firstname"]);
     		// check if name only contains letters and whitespace
     	if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
       		$fnErr = "Only letters and white space allowed"; 
       		$isErr = true;
     	}
   	}

   	if (empty($_POST["lastname"])) {
     	$lnErr = "Lastname is required";
     	$isErr = true;
   	} else {
     	$lastname = test_input($_POST["lastname"]);
     		// check if name only contains letters and whitespace
     	if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
       		$lnErr = "Only letters and white space allowed"; 
       		$isErr = true;
     	}
   	}

   	if (empty($_POST["username"])) {
     	$unErr = "Username is required";
     	$isErr = true;
   	} else {
     	$cUser = test_input($_POST["username"]);
     		// check if name only contains letters and whitespace
     	if (!preg_match("/^[a-zA-Z0-9._]*$/", $cUser)) {
       		$addErr = "Only letters, numbers, commas and underscores are allowed"; 
       		$isErr = true;
     	}
     	if(usernameExists($cUser) == true)
     	{
     		$unErr = "Username already exists";
     		$isErr = true;
     	}
   	}

   	if (empty($_POST["password"])) {
     	$pwErr = "Password is required";
     	$isErr = true;
   	} else {
     	$password = test_input($_POST["password"]);
     		// check if name only contains letters and whitespace
     	if (preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $password)) {
       		$pwErr = "Password does not meet the requirements"; 
       		$isErr = true;
     	}
   	}

	if (empty($_POST["email"])) {
     	$emErr = "Email is required";
     	$isErr = true;
   	} else {
     	$email = test_input($_POST["email"]);
     	// check if e-mail address is well-formed
     	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       		$emErr = "Invalid email format";
       		$isErr = true; 
     	}
     	if(emailExists($email) == true){
     		$emErr = "Email already exists";
     		$isErr = true;
     	}
   	}

    if($isErr == false)
    {

      createAccount(getLastAccId()+1, "default_pic.jpg", $cUser, $password, $firstname, $lastname, $email);
      $greeting = "Hi " . $firstname . "! Your account has been created.";
      header('Refresh: 3; URL=index.php'); 

    }

}	

?>