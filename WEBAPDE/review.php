<?php	
session_start();
include 'functions.php';
loadAll();
if(isset($_SESSION["username"])){
	$loggedIn_account = getAccount($_SESSION["username"]);
	if(!isset($_GET["link"])){
		echo "<h1 align=\"center\">No review selected.</h1>";
		header('Refresh: 3; URL=home-review.php');
		exit;
	}
	else{	
		$review_id = $_GET["link"];
		$review = getReviewById($review_id);
	}
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
		<script>
			function commentHeader(cUser, cImage, cBody, hCount){
				this.cUser = cUser;
				this.cImage = cImage;
				this.cBody = cBody;
				this.hCount = hCount;
			}

			var comments = [];
			comments[0] = new commentHeader("iluvfood21", "images/profile/default_pic.jpg", "Great review! Hopefully I can go there and eat lobster soon! :)", 5);
			comments[1] = new commentHeader("usaftw", "images/profile/default_pic.jpg", "I still prefer steak, but hey! Surf and Turf is amazing.", 5);
			comments[2] = new commentHeader("bluesky21", "images/profile/default_pic.jpg", "I love it :D", 1);
			comments[3] = new commentHeader("calidownsouth", "images/profile/default_pic.jpg", "This is an extensive well thought out review, who knew California has the best lobsters around!!!", 1);
			comments[4] = new commentHeader("mammamia", "images/profile/default_pic.jpg", "This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!!", 0);

			function populate(){
				for(var i in comments){
					var newElement = document.createElement('div');
					newElement.className = "commentBox";
					var commentBoxData = 
					  	  "<img class = \"itemBoxImg\" src = \"" + comments[i].cImage + "\">"
						+ "&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" + comments[i].cUser + "</font></b>"
						+ "<p class = \"heartCount\">" + comments[i].hCount + "</p><img class = \"heartImg\" src = \"images/heart.jpg\">"
						+ "<br><br>"
						+ "<p class = \"commentText\">" + comments[i].cBody + "</p>";
					newElement.innerHTML = commentBoxData;
					document.getElementById("inbox").appendChild(newElement);
				}
			}
			function displayRating(stars){
				var i;
				for(i = 0; i < 5; i++){
					var newElement = document.createElement('div');
					newElement.className = "fLeft";
					if(i < stars)
						var starImgData = "<img class = \"starImg\" src = \"images/star.jpg\">";
					else 
						var starImgData = "<img class = \"starImg\" src = \"images/hollowStar.png\">";
					newElement.innerHTML = starImgData;
					document.getElementById("rating").appendChild(newElement);
				}
			}
		</script>
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
  					$(document).ready(function() {
    					$(".menuBox").animate({opacity: 1, top: "15%"}, 500);
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
				<img class = "reviewImg" src = "images/review/<?php echo $review->get_reviewimg()?>">
				<p class = "reviewHead"><?php echo $review->get_reviewname(); ?><img class = "favorited" src = "images/heart.jpg"></p>
				<p class = "userTag">by <?php echo getAccountName($review->get_accid()); ?></p>
				<br>
				<br>
				<p class = "reviewText">
					<?php echo $review->get_reviewtext(); ?>
				</p>
				<br>
				<div id = "rating">
					<script>displayRating(<?php echo $review->get_reviewcounts(); ?>);</script>
				</div>
				<br>
				<br>
				<script>populate();</script>
			</div>
			<div class = "addButton">
				<a href="post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>