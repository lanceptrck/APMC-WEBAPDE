<?php

include 'classes.php';

/* for validation */
$username = null;
$password = null;
$accounts = array();
$recipes = array();
$reply = "";
$loggedin = false;

function test_input($data) {
   			$data = trim($data);
   			$data = stripslashes($data);
   			$data = htmlspecialchars($data);
   			return $data;
}

function loadAll()
{
	if(isset($_SESSION["username"]))
	{
		global $username;
		$username = $_SESSION["username"];
	}

	loadAccounts();
	loadRecipes();
}


function returnAccountsList()
{
	global $accounts;
	return $accounts;
}

function verify($username, $password)
{
	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_user = $accounts[$i]->getUser();
		$temp_pass = $accounts[$i]->getPass();

		if(strcmp($temp_user, $username) == 0 && strcmp($temp_pass, $password) == 0)
		{
			return true;
		}

	}

	return false;

}

function usernameExists($username)
{
	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_user = $accounts[$i]->getUser();
		if(strcmp($temp_user, $username) == 0)
		{
			return true;
		}
	}

	return false;
}

function emailExists($email)
{
	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_email = $accounts[$i]->getEmail();
		if(strcmp($temp_email, $email) == 0)
		{
			return true;
		}
	}

	return false;
}

function getAccount($username)
{
	global $accounts;

	$acc = null;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_user = $accounts[$i]->getUser();

		if(strcmp($temp_user, $username) == 0)
		{
			$acc = $accounts[$i];
		}

	}

	return $acc;

}

function getAccountName($account_id)
{
	global $accounts;

	$account_name = null;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_accid = $accounts[$i]->getAccid();

		if(strcmp($temp_accid, $account_id) == 0)
		{
			$account_name = $accounts[$i]->getUser();
		}

	}

	return $account_name;

}

function loadAccounts()
{
	global $accounts;
	$accounts = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT * FROM account";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$accounts[count($accounts)] = new account($row['account_id'], $row['accimgname'], $row['username'], $row['password'], $row['firstname'], $row['lastname'], $row['email']);
		}

	}else echo "0 results";

	$connect->close();
}

function loadRecipes()
{
	global $recipes;
	$recipes = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT * FROM recipe";
	$result = $connect->query($sql);

	
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$temp_recipe = new recipe($row['recipe_id'], $row['recipename'], $row['account_id'], $row['recipeimgname'], "hi", "hi", "hi", $row['favorite_count'], $row['review_count']);
			$temp_recipe->set_ingredients(getData("text/ingredients.txt", $temp_recipe->get_recipeid()));
			$temp_recipe->set_directions(getData("text/directions.txt", $temp_recipe->get_recipeid()));
			$temp_recipe->set_facts(getData("text/facts.txt", $temp_recipe->get_recipeid()));
			$recipes[count($recipes)] = $temp_recipe;

		}
	} else echo "0 results";

	$connect->close();

}

function getData ($text, $recipe_id)
{
	$file= fopen($text, "r");

	$text = "";
	$found = false;

	while(!feof($file) || $found == true)
	{
		$init = str_replace(array("\r", "\n"), "", fgets($file));
		//echo $init . " " . strlen($init) . "<br>";
		if(strcmp($init, $recipe_id) == 0)
		{
			do {
				$save = str_replace(array("\r", "\n"), "", fgets($file));
				if(strcmp($save, ";") != 0)
					$text .= $save."<br>";
			}while(strcmp($save, ";"));

		}
	}

	fclose($file);

	return $text;
}

function getRecipes()
{
	global $recipes;

	return $recipes;
}

function getRecipeById($id)
{
	global $recipes;

	for($i = 0; $i<count($recipes); $i++)
	{
		$temp_recipe = $recipes[$i];

		if(strcmp($id, $temp_recipe->get_recipeid()) == 0)
		{
			return $temp_recipe;
		}
	}

	return null;
}

function createAccount($id, $img, $un, $pw, $fn, $ln, $em)
{ 

	$connect = new DBConnection();
	$connect = $connect->getInstance();

	$sql = "INSERT INTO account(account_id, accimgname, username, password, firstname, lastname, email)
	VALUES ('$id', '$img', '$un', '$pw', '$fn', '$ln', '$em')";

	if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }
    else loadAll();

    $connect->close();

}

function getLastAccId()
{
	$id = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT MAX(account_id) as result FROM account";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$id = $row['result'];
	}

	return $id;

	$connect->close();
}

function populateRecipeList()
{
	global $recipes;
	$temp = null;

	for($i = 0; $i<count($recipes); $i++)
	{
		$temp = $recipes[$i];
		echo "<a class =\"no\" href='recipe.php?link=". $temp->get_recipeid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"" . $temp->get_recipeimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_recipename() . "</font></b>
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<p class = \"heartCount\">" . $temp->get_reviewcounts() . "</p><img class = \"heartImg\" src = \"images/star.jpg\">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
	}
}

?>	