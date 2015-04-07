<?php	
	session_start();
	include 'functions.php';
	loadAll();
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		$la_id = $loggedIn_account->getAccid();
		$acc = getAccount($_SESSION["username"]);
		if(!isset($_GET["link"])){
			echo "<h1 align=\"center\">No recipe selected.</h1>";
			header('Refresh: 2; URL=home.php');
			exit;
		}
		else{	
			$recipe_id = $_GET["link"];
			$recipe = getRecipeById($recipe_id);
			$poster = getAccount(getAccountName($recipe->get_accid())); 
			$_GET["type"] = $type = 2;
			$_SESSION['prev'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
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
				<img class = "reviewImg" src = "images/recipe/<?php echo $recipe->get_recipeimg()?>">
				<p class = "reviewHead"><?php echo $recipe->get_recipename(); ?><?php echoFavorite($la_id, $recipe_id, "2"); ?></p>
				<p class = "userTag">by <a href = "account.php?id=<?php echo $poster->getAccid(); ?>"><?php echo $poster->getUser(); ?></a></p>
				<br>
				<br>
				<br>
				<p class = "recipeText">
					<b>Ingredients</b>
					<br>
					<br>
					<?php echo $recipe->get_ingredients(); ?>
  					<br>
  					<b>Directions</b>
  					<br>
  					<br>
					<?php echo $recipe->get_directions(); ?>
					<br>
					<b>Nutrition Facts</b>
					<br>
					<br>
					<?php echo $recipe ->get_facts(); ?>
				</p>
				<br>
				<br>
				<br>
				<?php include 'addComment.php'; ?>
				<?php populateCommentById($la_id, $recipe_id, $type); ?>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>