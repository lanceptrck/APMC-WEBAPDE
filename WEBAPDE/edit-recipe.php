<?php	
session_start();
include 'functions.php';
loadAll();
if(isset($_SESSION["username"])){
	$loggedIn_account = getAccount($_SESSION["username"]);
	if(isset($_GET["link"])){
		$recipe_id = $_GET["link"];
		$recipe = getRecipeById($recipe_id);
		if($recipe->get_accid() != $loggedIn_account->getAccid())
		{
			echo "You're not allowed to edit this.";
			header('Refresh: 2; URL=home.php');
			exit;
		}
	} 
	else echo "No recipe selected.";
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
				<a href = "account.php"><input type = "button" style = "top: 15px; left:15px; position: absolute;" value = "&#10094; Back"/></a>
				<ul class = "tabs" align = "center">
					<li class = "tab-link current" data-tab = "postRecipe">Editing Recipe - <?php echo $recipe->get_recipename(); ?></a></li>
				</ul>				
				<div id = "postRecipe" class = "tab-content current" align = "center">
					<form action ="logic_editrecipe.php?q=<?php echo $recipe_id; ?>" method="POST" enctype = "multipart/form-data">
						<div id = "inputData2">
							<br>
							<textarea placeholder = "Ingredients" class = "reBox"cols = "10" rows = "50" name = "ingredients_txt"/></textarea>
							<br>
							<br>
							<textarea placeholder = "Directions" class = "reBox"cols = "10" rows = "50" name = "directions_txt"/></textarea>
							<br>
							<br>
							<textarea placeholder = "Nutrition Facts" class = "reBox"cols = "10" rows = "50" name = "facts_txt"/></textarea>
							<br>
							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type = "file" name = "fileToUpload">
						</div>
						<div class = "submitButton">
							<button id = "postButton" onclick = "document.forms["pRecipe"].submit();"><img class = "postImg" src = "images/checkButton.png"></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>