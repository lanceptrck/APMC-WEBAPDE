<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = "";
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		$la_id = $loggedIn_account->getAccid();
		include 'logic_settings.php';
		
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
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype = "multipart/form-data">
						<div class = "leftSettings">
							<br>
							<br>
							<b>Profile picture</b> <p> <?php echo $ppReply; ?> </p>
							<input type = "file" name = "fileToUpload">
							<br>
							<br>
							<b>Password</b> <p> <?php echo $pReply; ?> </p>
							<input type = "Password" placeholder = "New password" name = "password" class = "iBox"/>
							<br>
							<br>
							<input type = "Password" placeholder = "Confirm password" name = "confirmPassword" class = "iBox"/>
						</div>
						<div class = "rightSettings">
							<br>
							<br>
							<b>About me</b> <?php echo $aReply; ?> </p>
							<textarea placeholder = "Insert text here" class = "tBox" name="aboutme" style = "width:400px;" cols = "10" rows = "50"/></textarea>
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