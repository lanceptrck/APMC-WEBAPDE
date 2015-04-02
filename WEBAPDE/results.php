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
		<link rel = "stylesheet" type = "text/css" href = "style.css">
	</head>
	<body>
		<div class = "foodList">
			<?php include 'header.php'; ?>
			<div class = "menuBox" id = "inbox">
				<p class = "resultHead">Showing results of</p>
				<p class = "menuHead" style = "padding-top:15px;"><?php echo $searched ?>.</p>
				<ul class = "tabs" align = "center">
					<li class="tab-link current" data-tab = "resultReview">Review</a></li>
					<li class="tab-link" data-tab = "resultRecipe">Recipe</a></li>
				</ul>
				<br>
				<div id = "resultReview" class = "tab-content current">
					<?php populateReviewByName($searched); ?>
				</div>					
				<div id = "resultRecipe" class = "tab-content">
					<?php populateRecipeByName($searched); ?>
				</div>
			</div>
			<div class = "addButton">
				<a href="post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>