<?php	
	session_start();
	include 'functions.php';
	loadAll();
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		include 'userhome.php';
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 3; URL=index.php');	
	}
?>