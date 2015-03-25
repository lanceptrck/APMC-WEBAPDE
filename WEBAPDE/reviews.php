<?php
	
	session_start();

	include 'functions.php';

	loadAll();


	if(isset($_SESSION["username"]))
	{
		$loggedIn_account = getAccount($_SESSION["username"]);
		$review_id = $_GET["link"];
		$review = getReviewById($review_id);

	}

	else
	{
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
			comments[0] = new commentHeader("iluvfood21", "images/lobster.jpg", "Great review! Hopefully I can go there and eat lobster soon! :)", 5);
			comments[1] = new commentHeader("usaftw", "images/steak.jpg", "I still prefer steak, but hey! Surf and Turf is amazing.", 5);
			comments[2] = new commentHeader("bluesky21", "images/sandwich.jpg", "I love it :D", 1);
			comments[3] = new commentHeader("calidownsouth", "images/sushi.jpg", "This is an extensive well thought out review, who knew California has the best lobsters around!!!", 1);
			comments[4] = new commentHeader("mammamia", "images/pizza.jpg", "This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!! This is an extensive well thought out review, who knew California has the best lobsters around!!!", 0);

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
			function search(){
				var search = document.getElementById('searchBar').value;
				alert("You searched for: " + search);
			}
		</script>
		<link rel = "stylesheet" type = "text/css" href = "style.css">
	</head>
	<body>
		<div class = "foodList">
			<header class = "header">
				<a id = "nav-toggle" href = "#"><span></span></a>
				<script src = "jquery-2.1.3.min.js"></script>
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
				<p class = "headName">potato.</p>
				<input type = "search" id = "searchBar">
			</header>
			<div class = "slideOutBar">
				<img class = "userImg" src = "images/account.jpg">
				<p class = "userName">
					<font size = "3">Chino Tapales</font>
					<br>
					chinotapales
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
					<img class = "sideImg" src = "images/sLogout.png">Sign Out
				</div>
				<div class = "sideBox">
					<img class = "sideImg" src = "images/sSettings.png">Settings
				</div>
			</div>
			<div class = "menuBox" id = "inbox">
				<img class = "reviewImg" src = "images/lobster.jpg">
				<p class = "reviewHead">Rock Lobster.<img class = "favorited" src = "images/heart.jpg"></p>
				<p class = "userTag">by iluvfood21</p>
				<br><br>
				<p class = "reviewText">
					"Rock Lobster" is a song written by Fred Schneider and Ricky Wilson, two members of The B-52's. It was produced in two versions, one by DB Records released in 1978, and a longer version, which was part of the band's 1979 self-titled debut album, released by Warner Bros.[5] The song became one of their signature tunes[6] and it helped launch the band's success.
					<br><br>
					"Rock Lobster" was the band's first single to appear on Billboard Hot 100, where it reached No. 56. A major hit in Canada, the single went all the way to No. 1 in the RPM national singles chart. Its follow-up was "Private Idaho," in October 1980, which reached No. 74 in the US. It was well received by critics and was placed at No. 147 on Rolling Stone's list of the "500 Greatest Songs of All Time".
					<br><br>
					The DB Records single version lasts 4'37" and is rawer and faster than the 1979 Warner single version. It has, however, almost the same lyrics of the second version, just including some extra lines in the listing of marine animals. The 1979 single version itself is an edit from the album version released in 1979, which lasts about seven minutes and contains an extra verse.
					<br><br>
					Its lyrics include nonsensical lines about a beach party and excited rants about real or imagined marine animals ("There goes a dog-fish, chased by a cat-fish, in flew a sea robin, watch out for that piranha, there goes a narwhal, here comes a bikini whale!"), accompanied by absurd, fictional noises attributed to them (provided by Kate Pierson and Cindy Wilson - Pierson providing the higher-pitched noises and Wilson the lower-pitched ones); the chorus consists of the words "Rock Lobster!" repeated over and over on top of a keyboard line.
					<br><br>
					"Rock Lobster" is written in the key of C minor (with a raised fourth in the chorus) and is in common time. Instruments used in the music include a baritone-tuned surf-style Mosrite electric guitar, a Farfisa Combo Compact organ, and drums.[citation needed] Kate Pierson played the song's bass line on a Korg SB-100 "Synth Bass" synthesizer.
				</p>
				<br>
				<div id = "rating">
					<script>displayRating(3);</script>
				</div>
				<br><br>
				<script>populate();</script>
			</div>
			<div class = "addButton">
				<img class = "postImg" src = "images/addButton.png">
			</div>
		</div>
	</body>
</html>