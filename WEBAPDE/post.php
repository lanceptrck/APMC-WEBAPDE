<?php	
session_start();
include 'functions.php';
loadAll();
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
				<ul class = "tabs" align = "center">
					<li class = "tab-link current" data-tab = "postReview">Review</a></li>
					<li class = "tab-link" data-tab = "postRecipe">Recipe</a></li>
				</ul>
				<div id = "postReview" class = "tab-content current" align = "center">
					<form action = "post_review.php" method = "POST" enctype = "multipart/form-data">
						<div id = "inputData1">
							<br>
							<input type = "text" placeholder = "Title" class = "pBox" name = "review_title"/>
							<br>
							<br>
							<textarea placeholder = "Insert text here" class = "tBox" cols = "10" rows = "50" name = "review_txt"/></textarea>
							<br>
							<br>
							<label class = "custom-file-input">
								Upload Image
								<input type = "file" name = "fileToUpload">
							</label>
							<br>
							<br>
							<span class = "rating">
						        <input type = "radio" class = "rating-input" id = "rating-input-1-5" value ="5" name = "rating-input-1">
						        <label for = "rating-input-1-5" class = "rating-star"></label>
						        <input type = "radio" class = "rating-input" id = "rating-input-1-4" value = "4" name = "rating-input-1">
						        <label for = "rating-input-1-4" class = "rating-star"></label>
						        <input type = "radio" class="rating-input" id = "rating-input-1-3" value = "3"name = "rating-input-1">
						        <label for = "rating-input-1-3" class = "rating-star"></label>
						        <input type = "radio" class="rating-input" id = "rating-input-1-2" value = "2" name = "rating-input-1">
						        <label for = "rating-input-1-2" class = "rating-star"></label>
						        <input type = "radio" class = "rating-input" id = "rating-input-1-1" value = "1" name = "rating-input-1">
						        <label for = "rating-input-1-1" class = "rating-star"></label>
							</span>
						</div>
					    <div class = "submitButton">
							<button id = "postButton" onclick = "document.forms["pReview"].submit();"><img class = "postImg" src = "images/checkButton.png"></button>
						</div>
					</form>
				</div>					
				<div id = "postRecipe" class = "tab-content" align = "center">
					<form action ="post_recipe.php" method="POST" enctype = "multipart/form-data">
						<div id = "inputData2">
							<br>
							<input type = "text" placeholder = "Title" class = "pBox" name = "recipe_title"/>
							<br>
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
							<label class = "custom-file-input">
								Upload Image
								<input type = "file" name = "fileToUpload">
							</label>
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