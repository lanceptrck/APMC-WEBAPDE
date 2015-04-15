<?php

	
	session_start();
	
	include 'functions.php';

	loadAll();

	$loggedIn_account = getAccount($_SESSION["username"]);
	$account_id = $loggedIn_account->getAccid();
	$result = "";

	$q=$_GET["q"];

	if(strlen($q) >= 2)
	{
		$result = populateMatches($q);
	}

	echo $result;

?>