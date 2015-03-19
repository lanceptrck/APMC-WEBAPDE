<?php

	session_start();

	include 'logic_registration.php';

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sign up for potato.</title>
		<script>
			function register(){
				var fullname = document.getElementById('fullname').value;
				var email = document.getElementById('email').value;
				var password = document.getElementById('password').value;
				var username = document.getElementById('username').value;
				alert("Full name: " + fullname + "\nEmail: " + email + "\nPassword: " + password + "\nUsername: " + username);
			}
		</script>
		<style>
			body{
				margin: 0px;

			}
			.registerPage{
				background-image: url("images/registerBackground.jpg");
				background-repeat: no-repeat;
				background-size: 100% 100%;
				width: 100%;
				height: 100%;
				position: absolute;
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
			p.registerHead{
				margin: 0px;
				padding: 0px;
				color: rgba(10, 10, 10, 0.9);
				font-style: arial;
				font-family: sans-serif;
				font-size: 56px;
				font-weight: bold;
			}
			.registerBox{
				background-color: rgb(255, 255, 255);
    			border-radius: 5px;
    			box-shadow: 0.5px 0.5px 1px #888888 inset;
    			width: 350px;
    			height: 560px;
    			top: 8%;
    			left: 35%;
    			padding: 30px;
    			padding-left: 45px;
    			padding-right: 0px;
    			position: absolute;
			}
			.rBox{
				color: rgb(10, 10, 10);
				font-style: arial;
				font-family: sans-serif;
				font-size: 13px;
				height: 25px;
				width: 295px;
				border: 1px solid rgba(0,0,0,0.15);
    			border-radius: 3px;
      			opacity: 1.0;
			}
    		.rBox:hover{
      			border: 1px solid rgba(0,0,0,0.3);
    		}
    		.rBox:active{
      			border: 1px solid rgb(66,133,244);
      			opacity: 0.8;
    		}
    		.rBox::-webkit-input-placeholder{
    			color: rgb(118, 118, 118);
			}
    		.registerButton{
    			font-style: arial;
				font-family: sans-serif;
				font-weight: bold;
				font-size: 11px;
				padding-top: 5px;
    			border-radius: 3px;
    			height: 2.5em;
    			width: 27em;
    			border: 0px;
    			opacity: 0.8;
    		}
    		.registerButton:hover{
      			border: 1px solid rgba(0,0,0,0.3);
    		}
    		.registerButton:active{
    			background-color: rgb(168, 168, 168);
    			border: 1px solid rgb(66,133,244);
    		}
    		.registerButton:focus{
    			outline: 0;
    		}
    		#error{
    			color:red;
    			display: inline;
    			font-size: 15px;
    			font-family: sans-serif;    			
    		}
    		#greeting{
    			font-size: 15px;
    			font-family: sans-serif;
    		}
    		label{
    			font-size: 15px;
    			font-family: sans-serif;
    		}
		</style>
	</head>
	<body>
		<div class = "registerPage">
			<div class = "header">
				<p class = "headName">potato.</p>
			</div>
			<div class = "registerBox">
			<form method ="POST" action="#">
				<p class = "registerHead">Sign up for potato.</p>
				<br><p id ="error"> * required fields </p>
				<br><p id="greeting"> <?php echo $greeting; ?> </p>
				<label> First name: <p id ="error"> * <?php echo $fnErr; ?> </p> </label>
				<input type = "text" placeholder = "Firstname" class = "rBox" id = "fullname" name="firstname">
				<br>
				<br><label> Last name: <p id ="error"> * <?php echo $lnErr; ?> </p> </label>
				<input type = "text" placeholder = "Lastname" class = "rBox" id = "fullname" name="lastname">
				<br>
				<br><label> Email: <p id ="error"> * <?php echo $emErr; ?> </p> </label>
				<input type = "email" placeholder = "Email" class = "rBox" id = "email" name ="email">
				<br>
				<br><label> Password: <p id ="error"> * <?php echo $pwErr; ?> </p> </label>
				<input type = "password" placeholder = "*******" class = "rBox" id = "password" name="password">
				<br>
				<br><label> Username: <p id ="error"> * <?php echo $unErr; ?> </p> </label>
				<input type = "text" placeholder = "Username" class = "rBox" id = "username" name = "username">
				<br>
				<br>
				<input type ="submit" value ="Register" class="registerButton">
				<br><br><a href = "index.php"> <input type ="button" value ="Cancel" class="registerButton"> </a>
			</form>
			</div>
		</div>
	</body>
</html>