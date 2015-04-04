<?php
	
	session_start();
	
	include 'functions.php';

	loadAll();

	$loggedIn_account = getAccount($_SESSION["username"]);
	$account_id = $loggedIn_account->getAccid();
	$prev = $_SESSION['prev'];

	if(isset($_GET['id']) && isset($_GET['type']))
	{	
		$type = $_GET['type'];
     	$id = $_GET['id'];

     	switch($type)
     	{
     		case 1: favorite(getLastFavoriteId()+1, $account_id, $type, $id, "0", "0"); break;
     		case 2: favorite(getLastFavoriteId()+1, $account_id, $type, "0", $id, "0"); break;
     		case 3: favorite(getLastFavoriteId()+1, $account_id, $type, "0", "0", $id); break;
     	}
		
	}

	header("Location: $prev");
?>