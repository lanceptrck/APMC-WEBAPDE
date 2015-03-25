<?php	
	session_start();
	include 'functions.php';
	loadAll();
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 3; URL=index.php');
		exit;	
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
			<header class = "header">
				<a id = "nav-toggle" href = "#"><span></span></a>
				<script src = "js/jquery-2.1.3.min.js"></script>
				<script>
					var clicked = 0;
					document.querySelector("#nav-toggle").addEventListener("click", function(){
						this.classList.toggle("active");
						if(clicked == 0){
							$(".slideOutBar").animate({left: "0px"}, 300);
							clicked = 1;
						}
						else{
							$(".slideOutBar").animate({left: "-268px"}, 300);
							clicked = 0;
						}
  					});
  					$(document).ready(function(){
						$('ul.tabs li').click(function(){
							var tab_id = $(this).attr('data-tab');
							$('ul.tabs li').removeClass('current');
							$('.tab-content').removeClass('current');
							$(this).addClass('current');
							$("#"+tab_id).addClass('current');
						})
					});
				</script>
				<a href = "home.php"><p class = "headName">potato.</p></a>
				<input type = "search" id = "searchBar">
			</header>
			<div class = "slideOutBar">
				<img class = "userImg" src = "images/<?php echo $loggedIn_account->getImg()?>">
				<p class = "userName">
					<font size = "3"><?php echo $loggedIn_account->getFirstname() . " " . $loggedIn_account->getLastname() ?></font>
					<br>
					<?php echo $loggedIn_account->getUser(); ?>
				</p>
				<hr>
				<div class = "sideBox">
					<img class = "sideImg" src = "images/sHeart.png">Favorites
				</div>
				<hr>
				<div class = "sideBox">
					<img class = "sideImg" src = "images/sGlass.png">Fine Dining
				</div>
				<div class = "sideBox">
					<img class = "sideImg" src = "images/sApple.png">Eat Healthy
				</div>
				<hr>
				<div class = "sideBox">
					<a href="logout.php"><img class = "sideImg" src = "images/sLogout.png"></a>Logout
				</div>
				<div class = "sideBox">
					<img class = "sideImg" src = "images/sSettings.png">Settings
				</div>
			</div>
			<div class = "menuBox" id = "inbox">
				<ul class = "tabs" align = "center">
					<li class="tab-link current" data-tab = "postReview">Review</a></li>
					<li class="tab-link" data-tab = "postRecipe">Recipe</a></li>
				</ul>
				<div id = "postReview" class = "tab-content current" align = "center">
					<form> <!-- Insert form here -->
						<br>
						<input type = "text" placeholder = "Title" class = "pBox" id = "title"/>
						<br>
						<br>
						<textarea placeholder = "Insert text here" class = "tBox"cols = "10" rows = "50 "id = "textBody"/></textarea>
						<br>
						<br>
						<span class = "rating">
					        <input type = "radio" class = "rating-input" id = "rating-input-1-5" name = "rating-input-1">
					        <label for = "rating-input-1-5" class = "rating-star"></label>
					        <input type = "radio" class = "rating-input" id = "rating-input-1-4" name = "rating-input-1">
					        <label for = "rating-input-1-4" class = "rating-star"></label>
					        <input type = "radio" class="rating-input" id = "rating-input-1-3" name = "rating-input-1">
					        <label for = "rating-input-1-3" class = "rating-star"></label>
					        <input type = "radio" class="rating-input" id = "rating-input-1-2" name = "rating-input-1">
					        <label for = "rating-input-1-2" class = "rating-star"></label>
					        <input type = "radio" class = "rating-input" id = "rating-input-1-1" name = "rating-input-1">
					        <label for = "rating-input-1-1" class = "rating-star"></label>
						</span>
					    <div class = "submitButton">
							<button id = "postButton" onclick = "document.forms["pReview"].submit();"><img class = "postImg" src = "images/checkButton.png"></button>
						</div>
					</form>
				</div>
				<div id = "postRecipe" class="tab-content" align = "center">
					<form> <!-- Insert form here -->
						<br>
						<input type = "text" placeholder = "Title" class = "pBox" id = "title"/>
						<br>
						<br>
						<textarea placeholder = "Ingredients" class = "reBox"cols = "10" rows = "50 "id = "ingredientsText"/></textarea>
						<br>
						<br>
						<textarea placeholder = "Directions" class = "reBox"cols = "10" rows = "50 "id = "directionsText"/></textarea>
						<br>
						<br>
						<textarea placeholder = "Nutrition Facts" class = "reBox"cols = "10" rows = "50 "id = "nutritionsText"/></textarea>
						<div class = "submitButton">
							<button id = "postButton" onclick = "document.forms["pRecipe"].submit();"><img class = "postImg" src = "images/checkButton.png"></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>