<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = "";
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);

	}
	else{
		echo "You are not logged in.";
		header('Refresh: 2; URL=index.php');
		exit;	
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
				<a href = "home-review.php">
					<div class = "mainHeader">
						<img class = "mainImg" src = "images/mainReview.jpg"/>
						<img class = "mainItemImg" src = "images/review/rev_10001.jpg"/>
						<p class = "mainHead">Reviews.</p>
					</div>
				</a>
				<br>
				<a href = "home-recipe.php">
					<div class = "mainHeader">
						<img class = "mainImg" src = "images/mainRecipe.jpg"/>
						<img class = "mainItemImg" src = "images/recipe/rec_10013.jpg"/>
						<p class = "mainHead">Recipes.</p>
					</div>
				</a>
				<br>
				<a href = "favorites.php">
					<div class = "mainHeader">
						<img class = "mainImg" src = "images/mainFavorites.jpg"/>
						<img class = "mainItemImg" src = "images/recipe/rec_10005.jpg"/>
						<p class = "mainHead">Favorites.</p>
					</div>
				</a>
				<br>
				<a href = "account.php">
					<div class = "mainHeader">
						<img class = "mainImg" src = "images/mainAccount.jpg"/>
						<img class = "mainItemImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>"/>
						<p class = "mainHead">Account.</p>
					</div>
				</a>
				<br>
				<a href = "settings.php">
					<div class = "mainHeader">
						<img class = "mainImg" src = "images/mainSettings.jpg"/>
						<img class = "mainItemImg" src = "images/gear.jpg"/>
						<p class = "mainHead">Settings.</p>
					</div>
				</a>
				<br>
				<br>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>