<?php
	
	session_start();

	include 'functions.php';
	loadAll();

	$loggedIn_account = getAccount($_SESSION["username"]);
	$account_id = $loggedIn_account->getAccid();

	//postComment("30002", "10001", "3", "Hello there", "3", "0", "0", "10001");

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{

		$prev = $_SESSION['prev'];
		$text ="";
		$isErr = false;

		if (empty($_POST["text"])) {
     			$isErr = true;
   			} else {
     			$text = $_POST["text"];
     				// check if name only contains letters and whitespace
     	}

     	if($isErr == false)
     	{
     		$type = $_GET['type'];
     		$id = $_GET['id'];

     		switch($type)
     		{
     			case 1: postComment(getLastCommentId()+1, $account_id, "0", $text, $type, $id, "0", "0"); break;
     			case 2: postComment(getLastCommentId()+1, $account_id, "0", $text, $type, "0", $id, "0"); break;
     			case 3: postComment(getLastCommentId()+1, $account_id, "0", $text, $type, "0", "0", $id); break;
     		
     		}
     		

     	}

     	header("Location: $prev");

	}
	


?>