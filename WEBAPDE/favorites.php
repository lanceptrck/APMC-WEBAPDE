<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = "";
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		$la_id = $loggedIn_account->getAccid();
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 3; url = index.php');	
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
					<?php populateReviewByFavorite($la_id); ?>
				</div>					
				<div id = "favoriteRecipes" class = "tab-content">
					<?php populateRecipeByFavorite($la_id); ?>
				</div>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>