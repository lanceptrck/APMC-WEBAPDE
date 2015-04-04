<?php	
session_start();
include 'functions.php';
loadAll();
if(isset($_SESSION["username"])){
	$loggedIn_account = getAccount($_SESSION["username"]);
	$la_id = $loggedIn_account->getAccid();
		$acc = getAccount($_SESSION["username"]);
	if(!isset($_GET["link"])){
		echo "<h1 align=\"center\">No review selected.</h1>";
		header('Refresh: 3; URL=home-review.php');
		exit;
	}
	else{	
		$review_id = $_GET["link"];
		$_GET["type"] = $type = 1;
		$review = getReviewById($review_id);
		$poster = getAccount(getAccountName($review->get_accid())); 
		$_SESSION['prev'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

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
		<link rel = "stylesheet" type = "text/css" href = "css/style.css">
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
						+ "&nbsp;&nbsp;&nbsp;&nbsp;<b><font size = \"2\">" + comments[i].cUser + "</font></b>"
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
	</head>
	<body>
		<div class = "foodList">
			<?php include 'header.php'; ?>	
			<div class = "menuBox" id = "inbox">
				<img class = "reviewImg" src = "images/review/<?php echo $review->get_reviewimg()?>">
				<p class = "reviewHead"><?php echo $review->get_reviewname(); ?> <?php echoFavorite($la_id, $review_id, "1"); ?> </p> 
				<p class = "userTag">by <a href="account.php?id=<?php echo $poster->getAccid(); ?>"><?php echo $poster->getUser(); ?> </a></p>
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
				<?php include 'addComment.php'; ?>
				<?php populateCommentById($la_id, $review_id, $type); ?>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>