<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = "";
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		$searched = $_POST["searchbar"];
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 3; URL=index.php');	
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
				<p class = "menuHead">Your Favorites.</p>
				<ul class = "tabs" align = "center">
					<li class = "tab-link current" data-tab = "favoriteReviews">Review</a></li>
					<li class = "tab-link" data-tab = "favoriteRecipes">Recipe</a></li>
				</ul>
				<br>
				<div id = "favoriteReviews" class = "tab-content current">
					<!-- Testing purposes -->
					<?php populateReviewByName("Lobster"); ?>
				</div>					
				<div id = "favoriteRecipes" class = "tab-content">
					<!-- Testing purposes -->
					<?php populateRecipeByName("Lobster"); ?>
				</div>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>