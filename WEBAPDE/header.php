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
					if(tab_id == "resultReview"){
						$('#resultReview').css('opacity', '0');
						$('#resultReview').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "resultRecipe"){
						$('#resultRecipe').css('opacity', '0');
						$('#resultRecipe').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "resultAccount"){
						$('#resultAccount').css('opacity', '0');
						$('#resultAccount').animate({opacity: 1}, "slow");
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
					else if(tab_id == "postReview"){
						$('#inputData1').css('opacity', '0');
						$('#inputData1').animate({opacity: 1}, "slow");
					}
					else if(tab_id == "postRecipe"){
						$('#inputData2').css('opacity', '0');
						$('#inputData2').animate({opacity: 1}, "slow");
					}
					$(".submitButton").removeClass('spinButton');
				});
				$('.mainHeader').hover(function(){
        			$(this).animate({opacity: 1}, 250);
        		}
        		,function(){
        			$(this).animate({opacity: 0.8}, 250);
    			});
			});

			function showResult(str){
				if (str.length < 2){ 
    				document.getElementById("live").innerHTML = "";
    				document.getElementById("live").className = "";
    				document.getElementById("search").className = "";
    				return;
  				}	
  				if(window.XMLHttpRequest){
    				xmlhttp = new XMLHttpRequest();
  				} 
  				else{
   					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  				}
  				xmlhttp.onreadystatechange = function(){
    				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      					document.getElementById("live").innerHTML = xmlhttp.responseText;
      					document.getElementById("live").className = "live";
    					document.getElementById("search").className = "searchClicked";
    				}

  				}
  				xmlhttp.open("GET","livesearch.php?q="+str,true);
  				xmlhttp.send();
			}

			function autofill(str)
			{
				document.getElementById("search").value = str;
				$( "#live" ).remove();
			}
			
			function favorite(id, type, indicator){
				var xmlhttp = new XMLHttpRequest();
	        	xmlhttp.onreadystatechange = function(){
	            	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	            		if(indicator == 0){
	            			document.getElementById(id+"_heartCount").innerHTML = xmlhttp.responseText;
	            			document.getElementById(id+"_heartImg").src = "images/heart.jpg";
	            			document.getElementById(id+"_heartImg").onclick = function(){ unfavorite(id,type,indicator); };
	            			document.getElementById(id+"_heartImg").title = "Unfavorite";
	            		}
	            		else{
	            			document.getElementById(id+"_favorited").src = "images/heart.jpg";
	            			document.getElementById(id+"_favorited").onclick = function(){ unfavorite(id,type,indicator); };
	            			document.getElementById(id+"_favorited").title = "Unfavorite";
	            		}
	            	}
       			}
        		xmlhttp.open("GET", "favorite-it.php?id=" + id +"&type="+type, true);
        		xmlhttp.send();
			}

			function unfavorite(id, type, indicator){
				var xmlhttp = new XMLHttpRequest();
        		xmlhttp.onreadystatechange = function(){
	            	if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
	            		if(indicator == 0){
	            			document.getElementById(id+"_heartCount").innerHTML = xmlhttp.responseText;
	            			document.getElementById(id+"_heartImg").src = "images/hollowheart.png";
	            			document.getElementById(id+"_heartImg").onclick = function(){ favorite(id,type,indicator); } ;
	            			document.getElementById(id+"_heartImg").title = "Favorite";
	            		}
	            		else{
	            			document.getElementById(id+"_favorited").src = "images/hollowheart.png";
	            			document.getElementById(id+"_favorited").onclick = function(){ favorite(id,type,indicator); } ;
	            			document.getElementById(id+"_favorited").title = "Favorite";
	            		}
	           		}
       			}
        		xmlhttp.open("GET", "unfavorite-it.php?id=" + id +"&type="+type, true);
        		xmlhttp.send();
        	}
		</script>
		<a href = "home.php" class = "no"><p class = "headName">potato.</p></a>
		<form action = "results.php" method = "post">
			<input id ="search" type = "search" name = "searchbar" placeholder = "" autocomplete="off" onkeyup="showResult(this.value);">
		</form>
		<br><br><br><div id="live"></div>
	</header>
	<div class = "slideOutBar">
		<div class = "slideHeader">
			<img class = "slideImg" src = "images/profile/chino_cover.jpg"/>
			<img class = "userImg" src = "images/profile/<?php echo $loggedIn_account->getImg()?>"/>
			<a href = "account.php" class = "no">
				<p class = "userName"><?php echo $loggedIn_account->getFirstname() . " " . $loggedIn_account->getLastname() ?>
					<br>
					<?php echo $loggedIn_account->getUser() ?>
				</p>
			</a>
		</div>
		<hr>
		<a href = "home.php" class = "no">
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
		<a href = "settings.php" class ="no">
			<div class = "sideBox">
				<img class = "sideImg" src = "images/sSettings.png">Settings
			</div>
		</a>
		<hr>
	</div>
</html>