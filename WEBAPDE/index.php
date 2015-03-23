<?php

session_start();

include 'functions.php';

if(isset($_SESSION["username"]))
	{
		$loggedIn_account = getAccount($_SESSION["username"]);
		header("Location: home.php");

	}

else
{
	include 'index_.php';
}

?>