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

			function logout()
			{
				<?php
					$_SESSION["logout"] = true; 
					$loggedin = false;
				?>
			}
			
		</script>
		<style>
			body{
				margin: 0px;
			}
			.foodList{
				background: url(images/foodListBackground.jpg);
				background-repeat: no-repeat;
				background-size: 100% 100%;
				width: 100%;
				height: 100%;
				position: absolute;
    			overflow: auto;
			}
			.header{
				background-color: rgb(175, 20, 20);
				height: 47px;
				width: 100%;
				position: fixed;
				z-index: 1;
			}
			p.headName{
				color: rgb(255, 255, 255);
				font-style: arial;
				font-family: sans-serif;
				font-size: 18px;
				margin: 13px;
				margin-left: 40px;
				float: left;
			}
			p.menuHead{
				margin: 0px;
				padding-top: 25px;
				padding-left: 25px;
				color: rgba(10, 10, 10, 0.9);
				font-style: arial;
				font-family: sans-serif;
				font-size: 42px;
				font-weight: bold;
			}
			p.heartCount{
				margin: 0px;
				padding-top: 19px;
				color: rgba(10, 10, 10, 0.9);
				font-style: arial;
				font-family: sans-serif;
				font-size: 10px;
				font-weight: bold;
				float: right;
			}
			p.userName{
				margin-top: 53px;
				font-size: 11px;
				line-height: 150%;
			}
			.slideOutBar{
				padding: 13px;
				padding-top: 37px;
				background: rgb(60, 60, 60);
				box-shadow: 0.5px 0.5px 1px rgb(60, 60, 60);
				color: rgb(255, 255, 255);
				font-style: arial;
				font-family: sans-serif;
				font-size: 12px;
				width: 240px;
				height: 100%;
				top: 47px;
				left: -268px;
				position: fixed;
				z-index: 1;
			}
			.menuBox{
				color: rgb(118, 118, 118);
				font-style: arial;
				font-family: sans-serif;
				font-size: 14px;
				background-color: rgb(255, 255, 255);
    			border-radius: 5px;
    			box-shadow: 0.5px 0.5px 1px #888888 inset;
    			width: 1000px;
    			height: auto;
    			top: 15%;
    			left: 10%;
    			padding: 30px;
    			position: absolute;
			}
    		.itemBox{
				color: rgba(10, 10, 10, 0.9);
				font-style: arial;
				font-family: sans-serif;
				font-size: 11px;
				background-color: rgb(255, 255, 255);
    			border-radius: 5px;
    			box-shadow: 0.5px 0.5px 1px #888888 inset;
    			width: 840px;
    			height: 35px;
    			padding: 15px;
    			left: 60px;
    			position: relative;
			}
			.itemBox:hover{
      			border: 1px solid rgba(0, 0, 0, 0.3);
    		}
    		.sideBox{
    			margin-top: 20px;
    			margin-bottom: 20px;
    		}
    		p.sideText{
    			margin-left: 30px;
    			float: left;
    			position: relative;
    		}
    		img.itemBoxImg{
    			background-repeat: no-repeat;
    			background-position: 50%;
    			border-radius: 50%;
    			width: 40px;
    			height: 40px;
    			float: left;
			}
			img.userImg{
				margin-right: 15px;
    			background-repeat: no-repeat;
    			background-position: 50%;
    			border-radius: 50%;
    			border: solid 1px rgb(255, 255, 255);
    			width: 80px;
    			height: 80px;
    			float: left;
			}
			img.heartImg{
				background-repeat: no-repeat;
    			width: 20px;
    			height: 18px;
    			padding-top: 10px;
    			padding-left: 10px;
    			float: right;
			}
			img.sideImg{
				margin-right: 30px;
				height: 16px;
				width: 16px;
				float: left;
			}
			.imgSign{
				background-image: url(images/sLogout.png);
				width: 16px;
				height: 16px;
				margin-right: 30px;
				float: left;
			}
			#nav-toggle{
				position: absolute;
				top: 25%;
				left: 1%;
				cursor: pointer;
				padding: 10px 35px 16px 0px;
			}
			#nav-toggle span, #nav-toggle span:before, #nav-toggle span:after{
  				cursor: pointer;
  				height: 1px;
  				width: 15px;
  				background: white;
  				position: absolute;
  				display: block;
  				content: '';
			}
			#nav-toggle span:before{
  				top: -6px; 
			}
			#nav-toggle span:after{
  				bottom: -6px;
			}
			#nav-toggle span, #nav-toggle span:before, #nav-toggle span:after{
  				transition: all 500ms ease-in-out;
			}
			#nav-toggle.active span{
  				background-color: transparent;
			}
			#nav-toggle.active span:before, #nav-toggle.active span:after{
  				top: 0;
			}
			#nav-toggle.active span:before{
  				transform: rotate(45deg);
			}
			#nav-toggle.active span:after{
  				transform: rotate(-45deg);
			}
			input[type=search]{
				margin: 13px;
				float: right;
				top: 0px;
				background: url(images/searchIcon.png) no-repeat 0px center;
				background-size: 20px 20px;
				border: 0px;
				height: 22px;
				width: 22px;
				color: transparent;
				cursor: pointer;
				-webkit-border-radius: 1em;
				border-radius: 1em;
				-webkit-transition: width .5s;
				transition: width .5s;
			}
			input::-webkit-search-decoration, input::-webkit-search-cancel-button{
				display: none;
			}
			input[type=search]:focus{
				background: rgb(255, 255, 255);
				color: rgb(10, 10, 10);
				font-style: arial;
				font-family: sans-serif;
				font-size: 13px;
    			box-shadow: 0.5px 0.5px 1px #888888 inset;
				width: 230px;
				padding-left: 6px;
				padding-right: 6px;
				cursor: auto;
				outline: 0;
			}
		</style>
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
		</div>
	</body>
</html>