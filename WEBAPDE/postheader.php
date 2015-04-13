<html>
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
  			$(document).ready(function(){
  				$(".menuBox").animate({opacity: 1, top: "15%"}, 500);
  				$(".submitButton").addClass('spinButton');
				$('ul.tabs li').click(function(){
					var tab_id = $(this).attr('data-tab');
					$('ul.tabs li').removeClass('current');
					$('.tab-content').removeClass('current');
					$(this).addClass('current');
					$("#"+tab_id).addClass('current');
					if(tab_id == "postReview"){
						$('#inputData1').css('opacity', '0');
						$('#inputData1').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "postRecipe"){
						$('#inputData2').css('opacity', '0');
						$('#inputData2').animate({opacity: 1}, "slow");
					}
					$(".submitButton").removeClass('spinButton');
				});
			});
		</script>
		<a href = "home.php" class = "no"><p class = "headName">potato.</p></a>
		<form action = "results.php" method = "post">
			<input type = "search" name = "searchbar" placeholder = "">
		</form>
	</header>
	<div class = "slideOutBar">
		<div class = "slideHeader">
			<img class = "slideImg" src = "images/profile/chino_cover.jpg"/>
			<img class = "userImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>"/>
			<p class = "userName"><?php echo $loggedIn_account->getFirstname() . " " . $loggedIn_account->getLastname() ?>
				<br>
				<?php echo $loggedIn_account->getUser() ?>
			</p>
		</div>
		<hr><a href = "home.php" class = "no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sHome.png">Home
			</div>
		</a>
		<a href = "favorites.php" class = "no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sHeart.png">Favorites
			</div>
		</a>
		<hr>
		<a href = "home-review.php" class = "no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sGlass.png">Reviews
			</div>
		</a>
		<a href = "home-recipe.php" class = "no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sApple.png">Recipes
			</div>
		</a>
		<hr>
		<a href = "logout.php" class ="no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sLogout.png">Logout
			</div>
		</a>
		<a href = "#" class ="no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sSettings.png">Settings
			</div>
		</a>
	</div>
</html>