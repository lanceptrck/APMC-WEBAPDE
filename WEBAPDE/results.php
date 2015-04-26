<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = null;
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		if(isset($_POST["searchbar"])){
			$searched = $_POST["searchbar"];
		}
		else if(isset($_GET['q']))
		{
			$searched = $_GET['q'];
		}
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 2; URL=index.php');	
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
				<p class = "resultHead">Showing results of</p>
				<p class = "menuHead" style = "padding-top:15px; padding-left:25px"><?php echo $searched ?></p>
				<br>
				<ul class = "tabs" style = "padding-left:30px;">
					<li class = "tab-link current" data-tab = "resultReview">Reviews</a></li>
					<li class = "tab-link" data-tab = "resultRecipe">Recipes</a></li>
					<li class = "tab-link" data-tab = "resultAccount">People</a></li>
				</ul>
				<br>
				<div id = "resultReview" class = "tab-content current">
					<?php if($searched != null) populateReviewByName($searched); else echo "<p align=\"center\"> Empty search field <p>"; ?>
				</div>					
				<div id = "resultRecipe" class = "tab-content">
					<?php if($searched != null) populateRecipeByName($searched); else echo "<p align=\"center\"> Empty search field <p>"; ?>
				</div>
				<div id = "resultAccount" class = "tab-content">
					<?php if($searched != null) populatePeople($searched); else echo "<p align=\"center\"> Empty search field <p>"; ?>
				</div>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>