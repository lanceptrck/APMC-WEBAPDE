<?php

include 'classes.php';

/* for validation */
$username = null;
$password = null;
$accounts = array();
$recipes = array();
$recviews = array();
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
	loadReviews();
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
			$temp_recipe = new recipe($row['recipe_id'], $row['recipename'], $row['account_id'], $row['recipeimgname'], "hi", "hi", "hi", $row['favorite_count']);
			$temp_recipe->set_ingredients(getData("text/ingredients.txt", $temp_recipe->get_recipeid()));
			$temp_recipe->set_directions(getData("text/directions.txt", $temp_recipe->get_recipeid()));
			$temp_recipe->set_facts(getData("text/facts.txt", $temp_recipe->get_recipeid()));
			$recipes[count($recipes)] = $temp_recipe;

		}
	} else echo "0 results";

	$connect->close();

}

function loadReviews()
{
	global $reviews;
	$reviews = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT * FROM review";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$temp_review = new review($row['review_id'], $row['reviewname'], $row['account_id'], $row['reviewimgname'], $row['favorite_count'], $row['review_count']);
			$temp_review->set_reviewtext(getData("text/reviews.txt", $temp_review->get_reviewid()));
			$reviews[count($reviews)] = $temp_review;
		}
	}	else echo "0 results";

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
					$text .= $save;
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

function getReviewById($id)
{
	global $reviews;

	for($i = 0; $i<count($reviews); $i++)
	{
		$temp_review = $reviews[$i];

		if(strcmp($id, $temp_review->get_reviewid()) == 0)
		{
			return $temp_review;
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

	$connect->close();

	return $id;
}

function getLastRecipeId()
{
	$id = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT MAX(recipe_id) as result FROM recipe";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$id = $row['result'];
	}

	$connect->close();

	return $id;

}

function getLastReviewId()
{
	$id = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT MAX(review_id) as result FROM review";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$id = $row['result'];
	}

	$connect->close();

	return $id;

}

function populateRecipeList()
{
	global $recipes;
	$temp = null;

	for($i = 0; $i<count($recipes); $i++)
	{
		$temp = $recipes[$i];
		echo "<a class =\"no\" href='recipe.php?link=". $temp->get_recipeid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/recipe/" . $temp->get_recipeimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_recipename() . "</font></b>
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
	}
}

function populateReviewList()
{
	global $reviews;
	$temp = null;

	for($i = 0; $i<count($reviews); $i++)
	{
		$temp = $reviews[$i];
		echo "<a class =\"no\" href='review.php?link=". $temp->get_reviewid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/review/" . $temp->get_reviewimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_reviewname() . "</font></b>
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<p class = \"heartCount\">" . $temp->get_reviewcounts() . "</p><img class = \"heartImg\" src = \"images/star.jpg\">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
	}
}

function uploadPicture($directory, $file_type, $file_name, $file_size, $file)
{
	$uploadOk = 1;

	if($file_size > 500000)
	{	
		echo "File too large.";
		$uploadOk = 0;
	}

	if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" 
		&& $file_type != "gif" ) {
    		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   		 $uploadOk = 0;
	}

	if($uploadOk == 0)
	{
		echo "File not uploaded.";
	} else {
		if(move_uploaded_file($file, $directory))
		{
			echo "File successfully uploaded";
		} else echo "Error occured";
	}

}

function postRecipe($rec_id, $acc_id, $t, $i, $d, $f, $img)
{
	global $recipes;
	$connect = new DBConnection();
	$connect = $connect->getInstance();

	$sql = "INSERT INTO recipe(recipe_id, recipename, account_id, recipeimgname, file, favorite_count)
	VALUES ('$rec_id', '$t', '$acc_id', '$img', 'recipe.txt', '0')";

	if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();

    $i = str_replace("\n", "<br>", $i) . "<br>";
    $d = str_replace("\n", "<br>", $d) . "<br>";
    $f = str_replace("\n", "<br>", $f) . "<br>";


    $temp_recipe = new recipe($rec_id, $t, $acc_id, $img, "hi", "hi", "hi", 0);
	$temp_recipe->set_ingredients($i);
	$temp_recipe->set_directions($d);
	$temp_recipe->set_facts($f);
	$recipes[count($recipes)] = $temp_recipe;

	writeRecipeToText();

	loadAll();

}

function writeRecipeToText()
{
	$file = fopen("text/ingredients.txt", "w");
	$dFile = fopen("text/directions.txt", "w");
	$fFile = fopen("text/facts.txt", "w");

	$newline = PHP_EOL;

	$allRecipes = array();
	$allRecipes = getRecipes();

	for($i = 0; $i<count($allRecipes); $i++)
	{
		$temp = $allRecipes[$i];

		fwrite($file, $temp->get_recipeid().PHP_EOL);
		fwrite($dFile, $temp->get_recipeid().PHP_EOL);
		fwrite($fFile, $temp->get_recipeid().PHP_EOL);

		fwrite($file, $temp->get_ingredients() . PHP_EOL);
		fwrite($dFile, $temp->get_directions() . PHP_EOL);
		fwrite($fFile, $temp->get_facts() . PHP_EOL);


		fwrite($file, ";".$newline);
		fwrite($dFile, ";".$newline);
		fwrite($fFile, ";".$newline);

	}

	fclose($file);
	fclose($dFile);
	fclose($fFile);
}

function postReview($rev_id, $acc_id, $t, $rev_txt, $rat, $img)
{
	global $reviews;
	$connect = new DBConnection();
	$connect = $connect->getInstance();

	$sql = "INSERT INTO review(review_id, reviewname, account_id, reviewimgname, favorite_count, review_count)
	VALUES ('$rev_id', '$t', '$acc_id', '$img', '0', '$rat')";

	if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();

    $rev_txt = str_replace("\n", "<br>", $rev_txt) . "<br>";

    $temp_review = new review($rev_id, $t, $acc_id, $img, 0, $rat);
    $temp_review->set_reviewtext($rev_txt);
    $reviews[count($reviews)] = $temp_review;	

    writeReviewToText();

    loadAll();

}

function writeReviewToText()
{	
	global $reviews;
	$file = fopen("text/reviews.txt", "w");
	$newline = PHP_EOL;

	for($i = 0; $i<count($reviews); $i++)
	{
		$temp = $reviews[$i];

		fwrite($file, $temp->get_reviewid().PHP_EOL);
		fwrite($file, $temp->get_reviewtext().PHP_EOL);
		fwrite($file, ";".$newline);

	}

	fclose($file);

}

?>	