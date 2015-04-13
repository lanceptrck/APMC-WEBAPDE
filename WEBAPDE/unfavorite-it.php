<?php
	
	session_start();
	
	include 'functions.php';

	loadAll();

	$loggedIn_account = getAccount($_SESSION["username"]);
	$account_id = $loggedIn_account->getAccid();
	$fav = 0;

	if(isset($_GET['id']) && isset($_GET['type']))
	{	
		$type = $_GET['type'];
     	$id = $_GET['id'];

     	switch($type)
     	{
     		case 1: $fav = unfavorite($account_id, $type, $id, "0", "0"); break;
     		case 2: $fav = unfavorite($account_id, $type, "0", $id, "0"); break;
     		case 3: $fav = unfavorite($account_id, $type, "0", "0", $id); break;
     	}
		
	}

	
	echo $fav;
	loadAll();
	
?>