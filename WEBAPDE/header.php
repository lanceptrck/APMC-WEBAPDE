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
				$('ul.tabs li').click(function(){
					var tab_id = $(this).attr('data-tab');
					$('ul.tabs li').removeClass('current');
					$('.tab-content').removeClass('current');
					$(this).addClass('current');
					$("#"+tab_id).addClass('current');
					if(tab_id == "resultReview"){
						$('#resultReview').css('opacity', '0');
						$('#resultReview').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "resultRecipe"){
						$('#resultRecipe').css('opacity', '0');
						$('#resultRecipe').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "accountWall"){
						$('#accountWall').css('opacity', '0');
						$('#accountWall').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "accountAbout"){
						$('#accountAbout').css('opacity', '0');
						$('#accountAbout').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "accountReviews"){
						$('#accountReviews').css('opacity', '0');
						$('#accountReviews').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "accountRecipes"){
						$('#accountRecipes').css('opacity', '0');
						$('#accountRecipes').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "favoriteReviews"){
						$('#favoriteReviews').css('opacity', '0');
						$('#favoriteReviews').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "favoriteRecipes"){
						$('#favoriteRecipes').css('opacity', '0');
						$('#favoriteRecipes').animate({opacity: 1}, "slow");
					}
				});
			});
		</script>
		<a href = "home.php" class = "no"><p class = "headName">potato.</p></a>
		<form action = "results.php" method = "post">
			<input type = "search" name = "searchbar" placeholder = "">
		</form>
	</header>
	<div class = "slideOutBar">
		<img class = "userImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>">
		<p class = "userName">
			<font size = "3"><?php echo $loggedIn_account->getFirstname() . " " . $loggedIn_account->getLastname() ?></font>
			<br>
			<?php echo $loggedIn_account->getUser(); ?>
		</p>
		<hr>
		<a href = "#" class = "no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sHeart.png">Favorites
			</div>
		</a>
		<hr>
		<a href = "home.php" class = "no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sGlass.png">Recipes
			</div>
		</a>
		<a href = "home-review.php" class = "no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sApple.png">Reviews
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