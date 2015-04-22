<?php	
session_start();
include 'functions.php';
loadAll();
if(isset($_SESSION["username"])){
	$loggedIn_account = getAccount($_SESSION["username"]);
	if(isset($_GET["link"])){
		$review_id = $_GET["link"];
		$review = getReviewById($review_id);
		if($review->get_accid() != $loggedIn_account->getAccid())
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
					<li class = "tab-link current" data-tab = "postReview">Editing Review - <?php echo $review->get_reviewname(); ?></a></li>
				</ul>
				<div id = "postReview" class = "tab-content current" align = "center">
					<form action = "logic_editreview.php?q=<?php echo $review_id;?>" method = "POST" enctype = "multipart/form-data">
						<div id = "inputData1">
							<br>
							<textarea placeholder = "Insert text here" class = "tBox" cols = "10" rows = "50" name = "review_txt"/></textarea>
							<br>
							<br>
							&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
							<input type = "file" name = "fileToUpload">
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
				
			</div>
		</div>
	</body>
</html>