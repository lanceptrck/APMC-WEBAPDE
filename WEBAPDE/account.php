<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = "";
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		$la_id = $loggedIn_account->getAccid();
		$account_id = $loggedIn_account->getAccid();
		$acc = getAccount($_SESSION["username"]);
		$_GET["type"] = $type = 3;
		if(isset($_GET["id"])){
			$account_id = $_GET["id"];
			$acc = getAccount(getAccountName($account_id));
			$_SESSION['prev'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		}
	}
	else{
		echo "You are not logged in.";
		header('Refresh: 2; url = index.php');	
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
				<div class = "accHeader">
					<img class = "coverImg" src = "images/profile/chino_cover.jpg"/>
					<img class = "accImg" src = "images/profile/<?php echo $acc->getImg()?>"/>
					<p class = "accHead"><?php echo $acc->getFirstname() . " " . $acc->getLastname() . "." ?></p>
				</div>
				<br>
				<br>
				<ul class = "tabs" style = "padding-left:60px;">
					<li class = "tab-link current" data-tab = "accountWall">Wall</a></li>
					<li class = "tab-link" data-tab = "accountAbout">About</a></li>
					<li class = "tab-link" data-tab = "accountReviews">Reviews</a></li>
					<li class = "tab-link" data-tab = "accountRecipes">Recipes</a></li>
				</ul>
				<br>
				<div id = "accountWall" class = "tab-content current">
					<div class = "postBox">
						<img class = "itemBoxImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>">
						<form action = "post_comment.php?id=<?php echo $account_id; ?>&type=<?php echo $_GET['type']; ?>" method = "post">
							<textarea class = "cBox" placeholder = "Write something..." name = "text"/></textarea>
							<button id = "postButton" onclick = "document.forms["pPost"].submit();"><img class = "sendImg" src = "images/sent.png"></button>
						</form>
						<script src = "js/jquery-2.1.3.min.js"></script>
						<script>
							$('.cBox').css('width', '730px');
							$('.cBox').on('keyup', function(){
								$(this).css('height','auto');
								$(this).height(this.scrollHeight - 2);
							});
						</script>
					</div>
					<?php populateCommentById($la_id, $account_id, $type); ?>
				</div>
				<div id = "accountAbout" class = "tab-content">
					<?php echo $acc->get_aboutme(); ?>
				</div>	
				<div id = "accountReviews" class = "tab-content">
					<?php populateReviewByAccount($account_id); ?>
				</div>					
				<div id = "accountRecipes" class = "tab-content">
					<?php populateRecipeByAccount($account_id);  ?>
				</div>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>