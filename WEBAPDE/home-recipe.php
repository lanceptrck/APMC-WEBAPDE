<?php	
	session_start();
	include 'functions.php';
	loadAll();
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 3; URL = index.php');	
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
				<p class = "menuHead">Recipes just for you.</p>
				<br>
				<br>
				<?php populateRecipeList(); ?>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>