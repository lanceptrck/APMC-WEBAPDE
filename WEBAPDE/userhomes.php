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
			<?php include 'header.php'; ?>	
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