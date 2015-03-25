<?php
	loadAll();
	$loggedin = false;
	$reply = "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$loggedin = false;
		if(!empty($_POST["username"])){
     		$username = test_input($_POST["username"]); 
     		$loggedin = true;	
 		}
 		else if($loggedin == false){
 			$reply = "Username or Password field is empty.";
 		}
 		if(!empty($_POST["password"])){
 			$password = test_input($_POST["password"]);
 		}
		if($loggedin == true){
	 		if(verify($username, $password)){
				$_SESSION["username"] = test_input($_POST["username"]);
				header('Refresh: 1; URL=home.php');	
			}
			else if($loggedin == false){
				$reply = "";
			}
			else{
				$reply = "Username does not exist or password is wrong";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to potato.</title>
		<link rel = "stylesheet" type = "text/css" href = "style.css">
	</head>
	<body>
		<div class = "backgroundPage">
			<div class = "header">
				<p class = "welcomeHeadName">potato.</p>
			</div>
			<div class = "welcomeText">
				<b><font size = "7">Welcome to potato.</font></b>
				<p>Discover good food and recipes.</p>
			</div>
			<div class = "loginBox">
				<p class = "signInText">Sign in.</p>
				<p id = "error"><?php echo $reply; ?></p>
				<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<br>
					<input type = "text" placeholder = "Email or username "class = "iBox" id = "username" name ="username">
					<br>
					<br>
					<input type = "password" placeholder = "Password" class = "iBox" id = "password" name="password">
					<br>
					<br>
					<a href = "registration.php"><input type = "button" class = "regButton" value="Register"/></a>
					<input type ="submit" class = "loginButton" value ="Login">
				</form>
			</div>
		</div>	
	</body>
</html>