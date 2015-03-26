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
				</script>
				<a href = "home.php" class ="no"><p class = "headName">potato.</p></a>
				<input type = "search" id = "searchBar">
			</header>
			<div class = "slideOutBar">
				<img class = "userImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>">
				<p class = "userName">
					<font size = "3"><?php echo $loggedIn_account->getFirstname() . " " . $loggedIn_account->getLastname() ?></font>
					<br>
					<?php echo $loggedIn_account->getUser(); ?>
				</p>
				<hr>
				<a href="#" class ="no">
					<div class = "sideBox">
						<img class = "sideImg" src = "images/sHeart.png">Favorites
					</div>
				</a>
				<hr>
				<a href="home.php" class ="no">
					<div class = "sideBox">
						<img class = "sideImg" src = "images/sGlass.png">Recipes
					</div>
				</a>
				<a href="home-review.php" class ="no">
					<div class = "sideBox">
						<img class = "sideImg" src = "images/sApple.png">Reviews
					</div>
				</a>
				<hr>
				<a href="logout.php" class ="no">
					<div class = "sideBox">
						<img class = "sideImg" src = "images/sLogout.png">Logout
					</div>
				</a>
				<a href="#" class ="no">
					<div class = "sideBox">
						<img class = "sideImg" src = "images/sSettings.png">Settings
					</div>
				</a>
			</div>
			<div class = "menuBox" id = "inbox">
				<p class = "menuHead"> Exceptional reviews, brought by potato. </p>
				<br>
				<br>
				<?php populateReviewList(); ?>
			</div>
			<div class = "addButton">
				<a href="post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>