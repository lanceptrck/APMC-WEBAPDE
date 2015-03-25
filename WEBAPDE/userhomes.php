<!DOCTYPE html>
<html>
	<head>
		<title>potato. - Discover good food and recipes</title>
		<script>
			function reviewHeader(rTitle, rUser, rImage, sCount, hCount){
				this.rTitle = rTitle;
				this.rUser = rUser;
				this.rImage = rImage;
				this.sCount = sCount;
				this.hCount = hCount;
			}

			var reviews = [];
			reviews[0] = new reviewHeader("Rock Lobster", "iluvfood21", "images/lobster.jpg", 5, 10);
			reviews[1] = new reviewHeader("Ribeye Steak", "usaftw", "images/steak.jpg", 3, 5);
			reviews[2] = new reviewHeader("Chicken Sandwich", "bluesky21", "images/sandwich.jpg", 2, 1);
			reviews[3] = new reviewHeader("California Maki", "calidownsouth", "images/sushi.jpg", 2, 1);
			reviews[4] = new reviewHeader("Supreme Pizza", "mammamia", "images/pizza.jpg", 0, 0);

			function populate(){
				for(var i in reviews){
					var newElement = document.createElement('div');
					newElement.className = "itemBox";
					var itemBoxData = 
					  	  "<img class = \"itemBoxImg\" src = \"" + reviews[i].rImage + "\">"
						+ "&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" + reviews[i].rTitle + "</font></b>"
						+ "<p class = \"heartCount\">" + reviews[i].hCount + "</p><img class = \"heartImg\" src = \"images/heart.jpg\">"
						+ "<p class = \"heartCount\">" + reviews[i].sCount + "</p><img class = \"heartImg\" src = \"images/star.jpg\">"
						+ "<br><br>"
						+ "&nbsp;&nbsp;&nbsp;&nbsp;submitted by " + reviews[i].rUser;
					newElement.innerHTML = itemBoxData;
					document.getElementById("inbox").appendChild(newElement);
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
				<p class = "headName">potato.</p>
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
				<p class = "menuHead">The best food in Los Angeles.</p>
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