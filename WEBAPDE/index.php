<?php 

session_start();

/* Include functions and classes */
include 'functions.php';

/* load all necessary data for this session */
loadAll();
$loggedin = false;
$reply = "Sign in.";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$loggedin = false;
	if (!empty($_POST["username"])) {
     	$username = test_input($_POST["username"]); 
     	$loggedin = true;	
 	} else if($loggedin == false){
 		$reply = "Username or Password field is empty.";
 	}

 	if (!empty($_POST["password"])) {
 		$password = test_input($_POST["password"]);
 	}

if($loggedin == true){

 	if(verify($username, $password))
	{
		$_SESSION["username"] = test_input($_POST["username"]);
		header('Refresh: 1; URL=home.php');	
	}
	else if($loggedin == false)
	{
		$reply = "";
	}
	else
	{
		$reply = "Username does not exist or password is wrong";
	}
}
	
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to potato.</title>
		<script>
			function login(){
				var username = document.getElementById('username').value;
				var password = document.getElementById('password').value;
				alert("Username: " + username +"\nPassword: " + password);
			}
		</script>
		<style>
			body{
				margin: 0px;
			}
			.backgroundPage{
				background: url(images/welcomeBackground.jpg);
				background-repeat: no-repeat;
				background-size: 100% 100%;
				width: 100%;
				height: 100%;
				position: fixed;
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
				float: left;
			}
			.welcomeText{
				color: rgb(255, 255, 255);
				font-style: arial;
				font-family: sans-serif;
				font-size: 18px;
				top: 40%;
				left: 60%;
				position: absolute;
			}
			.loginBox{
				background-color: rgb(255, 255, 255);
    			border-radius: 5px;
    			box-shadow: 0.5px 0.5px 1px #888888 inset;
    			width: 230px;
    			height: 190px;
    			top: 60%;
    			left: 60%;
    			padding: 20px;
    			position: absolute;
			}
			.iBox{
				color: rgb(10, 10, 10);
				font-style: arial;
				font-family: sans-serif;
				font-size: 13px;
				height: 25px;
				width: 223px;
				border: 1px solid rgba(0,0,0,0.15);
    			border-radius: 3px;
      			opacity: 1.0;
			}
    		.iBox:hover{
      			border: 1px solid rgba(0,0,0,0.3);
    		}
    		.iBox:active{
      			border: 1px solid rgb(66,133,244);
      			opacity: 0.8;
    		}
    		.iBox::-webkit-input-placeholder{
    			color: rgb(118, 118, 118);
			}
			.pBox{
				color: rgb(10, 10, 10);
				font-style: arial;
				font-family: sans-serif;
				font-size: 13px;
				height: 25px;
				width: 150px;
				border: 1px solid rgba(0,0,0,0.15);
    			border-radius: 3px;
      			opacity: 1.0;
			}
    		.pBox:hover{
      			border: 1px solid rgba(0,0,0,0.3);
    		}
    		.pBox:active{
      			border: 1px solid rgb(66,133,244);
      			opacity: 0.8;
    		}
    		.pBox::-webkit-input-placeholder{
    			color: rgb(118, 118, 118);
			}
    		.loginButton{
    			font-style: arial;
				font-family: sans-serif;
				font-weight: bold;
				padding-top: 5px;
    			border-radius: 3px;
    			height: 2.5em;
    			width: 6em;
    			border: 0px;
    			opacity: 0.8;
    			float: right;
    		}
    		.regButton{
    			font-style: arial;
				font-family: sans-serif;
				font-weight: bold;
				padding-top: 5px;
    			border-radius: 3px;
    			height: 2.5em;
    			width: 6em;
    			border: 0px;
    			opacity: 0.8;
    			float: left;
    		}
    		.loginButton:hover{
      			border: 1px solid rgba(0,0,0,0.3);
    		}
    		.loginButton:active{
    			background-color: rgb(168, 168, 168);
    			border: 1px solid rgb(66,133,244);
    		}
    		.loginButton:focus{
    			outline: 0;
    		}
    		#error{
    			color:black;
    			display: inline;
    			font-size: 15px;
    			font-style: arial;
				font-family: sans-serif;
    		}
    		a{
    			color:black;
    			font-size: 15px;
    			font-style: arial;
				font-family: sans-serif;
    		}
		</style>
	</head>
	<body>
		<div class = "backgroundPage">
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

			</header>
			<div class = "welcomeText">
				<b><font size = "7">Welcome to potato.</font></b>
				<p>Discover good food and recipes. </p>
			</div>
			<div class = "loginBox">
				<p id ="error"> <?php echo $reply; ?> </p>
			<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

				<br><input type = "text" placeholder = "Email or username "class = "iBox" id = "username" name ="username">
					<br>
					<br>
					<input type = "password" placeholder = "Password" class = "iBox" id = "password" name="password">
					<br><br><br><a href = "registration.php"> <input type="button" class ="regButton" value="Register"/> </a>
					<input type ="submit" class = "loginButton" value ="Login">
			</form>
	
					</div>
		</div>	

	</body>
</html>