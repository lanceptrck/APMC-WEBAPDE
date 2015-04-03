<?php
	session_start();
	include 'functions.php';
	loadAll();
	$searched = "";
	if(isset($_SESSION["username"])){
		$loggedIn_account = getAccount($_SESSION["username"]);
		$searched = $_POST["searchbar"];
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
					newElement.className = "postBox";
					var commentBoxData = 
					  	  "<img class = \"itemBoxImg\" src = \"" + comments[i].cImage + "\">"
						+ "&nbsp;&nbsp;&nbsp;&nbsp;<b><font size = \"2\">" + comments[i].cUser + "</font></b>"
						+ "<p class = \"heartCount\">" + comments[i].hCount + "</p><img class = \"heartImg\" src = \"images/heart.jpg\">"
						+ "<br><br>"
						+ "<p class = \"commentText\">" + comments[i].cBody + "</p>";
					newElement.innerHTML = commentBoxData;
					document.getElementById("accountWall").appendChild(newElement);
				}
			}
		</script>
	</head>
	<body>
		<div class = "foodList">
			<?php include 'header.php'; ?>
			<div class = "menuBox" id = "inbox">
				<div class = "accHeader">
					<img class = "coverImg" src = "images/profile/chino_cover.jpg"/>
					<img class = "accImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>"/>
					<p class = "accHead"><?php echo $loggedIn_account->getFirstname() . " " . $loggedIn_account->getLastname() . "." ?></p>
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
						<form>
							<textarea class = "cBox" placeholder = "Write something..." name = "wall_txt"/></textarea>
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
					<script>populate();</script>
				</div>
				<div id = "accountAbout" class = "tab-content">
					<b>DLSU Student.</b>
					<br>
					<br>
					Failure is the key to success; each mistake teaches us something.
					<br>
					<br>
					The heart of another is a dark forest, always, no matter how close it has been to one's own.
				</div>	
				<div id = "accountReviews" class = "tab-content">
					<!-- Testing purposes -->
					<?php populateReviewByName("Rock Lobster"); ?>
				</div>					
				<div id = "accountRecipes" class = "tab-content">
					<!-- Testing purposes -->
					<?php populateRecipeByName("Rock Lobster"); ?>
				</div>
			</div>
			<div class = "addButton">
				<a href = "post.php"><img class = "postImg" src = "images/addButton.png"></a>
			</div>
		</div>
	</body>
</html>