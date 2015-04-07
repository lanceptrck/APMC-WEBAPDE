<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = "";
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		$la_id = $loggedIn_account->getAccid();
		$account_id = $loggedIn_account->getAccid();
		$acc = getAccount($_SESSION["username"]);
		$_GET["type"] = $type = 3;
		if(isset($_GET["id"])){
			$account_id = $_GET["id"];
			$acc = getAccount(getAccountName($account_id));
			$_SESSION['prev'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 2; url = index.php');	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>potato. - Discover good food and recipes</title>
		<link rel = "stylesheet" type = "text/css" href = "css/style.css">
	</head>
	<body>
		<div class = "foodList">
			<?php include 'header.php'; ?>
			<div class = "menuBox" id = "inbox">
				<div class = "accHeader">
					<img class = "coverImg" src = "images/mainSettings.jpg"/>
					<img class = "accImg" src = "images/gear.jpg"/>
					<p class = "accHead">Settings</p>
				</div>
				<br>
				<br>
				<div id = "settingsBox">
					<form>
						<div class = "leftSettings">
							<br>
							<br>
							<b>Profile picture</b>
							<br>
							<br>
							<input type = "file" name = "fileToUpload">
							<br>
							<br>
							<b>Password</b>
							<br>
							<br>
							<input type = "Password" placeholder = "New password" class = "iBox"/>
							<br>
							<br>
							<input type = "Password" placeholder = "Confirm password" class = "iBox"/>
						</div>
						<div class = "rightSettings">
							<br>
							<br>
							<b>About me</b>
							<br>
							<br>
							<textarea placeholder = "Insert text here" class = "tBox" style = "width:400px;" cols = "10" rows = "50"/></textarea>
							<br>
							<br>
						</div>
					    <div class = "submitButton">
							<button id = "postButton" onclick = "document.forms["pReview"].submit();"><img class = "postImg" src = "images/checkButton.png"></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>