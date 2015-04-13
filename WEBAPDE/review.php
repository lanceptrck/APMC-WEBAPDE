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
		header('Refresh: 2; URL=home-review.php');
		exit;	
	}
	else{	
		$review_id = $_GET["link"];
		$review = getReviewById($review_id);
		$poster = getAccount(getAccountName($review->get_accid())); 
				 $_GET["type"] = $type = 1;
		$_SESSION['prev'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
}
else{
	echo "You are not logged in.";
	header('Refresh: 2; URL = index.php');
	exit;	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>potato. - Discover good food and recipes</title>
		<link rel = "stylesheet" type = "text/css" href = "css/style.css">
		<script>
			function displayRating(stars){
				for(var i = 0; i < 5; i++){
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
				<p class = "reviewHead"><?php echo $review->get_reviewname(); ?><?php echoFavorite($la_id, $review_id, "1"); ?></p> 
				<p class = "userTag">by <a href="account.php?id=<?php echo $poster->getAccid(); ?>"><?php echo $poster->getUser(); ?></a></p>
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