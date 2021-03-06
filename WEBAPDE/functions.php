<?php

include 'classes.php';

/* for validation */
$username = null;
$password = null;
$accounts = array();
$recipes = array();
$reviews = array();
$comments = array();
$favorites = array();
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
	loadComments();
	loadFavorites();
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

function getAccountById($id)
{
	global $accounts;

	$acc = null;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_id = $accounts[$i]->getAccid();

		if($id == $temp_id)
		{
			$acc = $accounts[$i];
		}

	}

	return $acc;

}



function changePassword($account_id, $new_password)
{
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "UPDATE account SET password='" . $new_password . "' WHERE account_id='" . $account_id . "'"; 

	if ($connect->query($sql) !== TRUE) {
    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
    }

    $connect->close();
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
			$temp_acc = new account($row['account_id'], $row['accimgname'], $row['username'], $row['password'], $row['firstname'], $row['lastname'], $row['email']);
			$temp_acc->set_aboutme(getData("text/aboutme.txt", $temp_acc->getAccid()));
			$accounts[count($accounts)] = $temp_acc;
			
		}

	}
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
	}

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
	}

	$connect->close();
}

function loadComments()
{
	global $comments;
	$comments = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT * FROM comment";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$temp_comment = new comment($row['comment_id'], $row['account_id'], $row['favorite_count'], "hi", $row['type'], $row['review_id'], $row['recipe_id'], $row['acc_id']);
			$temp_comment->set_comment(getCommentFromText("text/comments.txt", $row['comment_id']));

			$comments[count($comments)] = $temp_comment;
		}
	}

	$connect->close();
}

function loadFavorites()
{
	global $favorites;
	$favorites = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT * FROM favorite";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$temp_fave = new favorite($row['favorite_id'], $row['account_id'], $row['type'], $row['review_id'], $row['recipe_id'], $row['comment_id']);
			$favorites[count($favorites)] = $temp_fave;
		}
	}

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

function getCommentFromText($text, $comment_id)
{
	$file = fopen($text, "r");

	$text = "";
	$found = false;

	while(!feof($file) || $found == true)
	{
		$init = str_replace(array("\r", "\n"), "", fgets($file));

		if(strcmp($init, $comment_id) == 0)
		{
			for($i = 0; $i<4; $i++)
			{
				fgets($file);
			}

			do{
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

function getLastCommentId()
{
	$id = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT MAX(comment_id) as result FROM comment";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$id = $row['result'];
	}

	$connect->close();

	return $id;
}

function getLastFavoriteId()
{
	$id = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT MAX(favorite_id) as result FROM favorite";
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

function populateMatches($str)
{
	global $accounts;
	global $recipes;
	global $reviews;

	$cnt = 0;

	$result = "";

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp = $accounts[$i];
		if(strpos(strtolower($temp->getFirstname()), strtolower($str)) !== false || strpos(strtolower($temp->getLastname()), strtolower($str)) !== false)
		{
			$or_match = $temp->getFirstname() . " " . $temp->getLastname();
			$match = strtolower(str_ireplace($str, "<b>".$str."</b>", $or_match));

			$result .= "<a href='account.php?id=".$temp->getAccid()."'><p class='resultItem' onclick='autofill(\"".$or_match."\")'>Account - ".$match."</p>";
			$cnt++;
		}
	}

	for($i = 0; $i<count($recipes); $i++)
	{
		$temp = $recipes[$i];
		if(strpos(strtolower($temp->get_recipename()), strtolower($str)) !== false)
		{
			$or_match = $temp->get_recipename();
			$match = strtolower(str_ireplace($str, "<b>".$str."</b>", $or_match));

			$result .= "<a href='recipe.php?link=".$temp->get_recipeid()."'><p class='resultItem' onclick='autofill(\"".$or_match."\")'>Recipe - ".$match."</p>";
			$cnt++;
		}
	}

	for($i = 0; $i<count($reviews); $i++)
	{
		$temp = $reviews[$i];
		if(strpos(strtolower($temp->get_reviewname()), strtolower($str)) !== false)
		{
			$or_match = $temp->get_reviewname();
			$match = strtolower(str_ireplace($str, "<b>".$str."</b>", $or_match));

			$result .= "<a href='review.php?link=".$temp->get_reviewid()."'><p class='resultItem' onclick='autofill(\"".$or_match."\")'>Review - ".$match."</p>";
			$cnt++;
		}
	}

	if($result == "")
		echo "<p class =\"noResults\">No results.</p>";
	else{
		echo $result;
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
   		 $uploadOk = 0;
	}

	if($uploadOk == 0)
	{
		echo "File not uploaded.";
		return false;
	} else {
		if(move_uploaded_file($file, $directory))
		{
			//echo "File successfully uploaded";
			return true;
		} else 
		{
			//echo "Error occured";
			return false;
		}
	}



}

function changeProfilePicture($account_id, $profile_pic)
{
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "UPDATE account SET accimgname='" . $profile_pic . "' WHERE account_id='" . $account_id . "'"; 

	if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();
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

function editRecipe($rec_id, $img, $ing, $d, $f)
{
	global $recipes;
				//echo $i . " -i " . $d . " -d " . $f . " -f";

	for($i = 0; $i<count($recipes); $i++)
	{
		$forEdit = $recipes[$i];

		if($rec_id == $forEdit->get_recipeid())
		{
			//echo $forEdit->get_recipeid();
				if(strcmp($ing, "") != 0)
				{
					$forEdit->set_ingredients($ing);
				}

				if(strcmp($d, "") != 0)
				{
					$forEdit->set_directions($d);
					//echo $d;
				}

				if(strcmp($f, "") != 0)
				{
					$forEdit->set_facts($f);
					//echo $f;
				}

				$recipes[$i] = $forEdit;
		}
	}


	writeRecipeToText();

	loadAll();
}




function getFavoriteCountById($id, $type)
{

	switch($type)
	{
		case 1: global $reviews;
				for($i = 0; $i<count($reviews); $i++)
				{
					if($reviews[$i]->get_reviewid() == $id)
						return $reviews[$i]->get_favecounts();
				}
				break;

		case 2: global $recipes;
				for($i = 0; $i<count($recipes); $i++)
				{
					if($recipes[$i]->get_recipeid() == $id)
						return $recipes[$i]->get_favecounts();
				}
				break;

		case 3: global $comments;
				for($i = 0; $i<count($comments); $i++)
				{
					if($comments[$i]->get_commentid() == $id)
						return $comments[$i]->get_favecounts();
				}
				break;
	}
}

function hasLiked($aid, $id, $type)
{
	global $favorites;

	for($i = 0; $i<count($favorites); $i++)
	{
		$temp = $favorites[$i];

		if($temp->get_accountid() == $aid)
		{	
			switch($type)
			{
				case 1: if($temp->get_reviewid() == $id) return $temp->get_favoriteid(); break;
				case 2: if($temp->get_recipeid() == $id) return $temp->get_favoriteid(); break;
				case 3: if($temp->get_commentid() == $id) return $temp->get_favoriteid(); break;
			}
		}
	}

	return false;
}

function favorite($fid, $aid, $t, $rv, $rc, $ct)
{
	global $favorites;
	$connect = new DBConnection();
	$connect = $connect->getInstance();
	$favCount = 0;

	$sql = "INSERT INTO favorite(favorite_id, account_id, type, review_id, recipe_id, comment_id)
	VALUES ('$fid', '$aid', '$t', '$rv', '$rc', '$ct')";

	if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $sql ="";

    switch($t)
    {
    	case 1: $favCount = (getFavoriteCountById($rv, $t)+1); $sql = "UPDATE review SET favorite_count='" . $favCount . "' WHERE review_id='" . $rv . "'"; break;
    	case 2: $favCount = (getFavoriteCountById($rc, $t)+1); $sql = "UPDATE recipe SET favorite_count='" . $favCount. "' WHERE recipe_id='" . $rc . "'"; break;
    	case 3: $favCount = (getFavoriteCountById($ct, $t)+1); $sql = "UPDATE comment SET favorite_count='" . $favCount . "' WHERE comment_id='" . $ct . "'"; break;
    }

    if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();

  	loadAll();

  	return $favCount;

}

function test()
{
	$connect = new DBConnection();
	$connect = $connect->getInstance();

	$sql = "UPDATE review SET favorite_count='10' WHERE review_id='10001'";
    				if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();
}

function unfavorite($aid, $t, $rv, $rc, $ct)
{
	global $favorites;
	$connect = new DBConnection();
	$connect = $connect->getInstance();
	$favCount;

    switch($t)
    {
    	case 1: $favCount = (getFavoriteCountById($rv, $t)-1); 
    			$sql = "DELETE FROM favorite where account_id='" .$aid. '" AND review_id="'.$rv."'"; 
    				$connect->query($sql);

    			$sql = "UPDATE review SET favorite_count='" . $favCount. "' WHERE review_id='" . $rv . "'";
    				$connect->query($sql); 
    			
    			break;
    	case 2: $favCount = (getFavoriteCountById($rc, $t)-1); 
    			$sql = "DELETE FROM favorite where account_id='" .$aid. '" AND recipe_id="'.$rc."'"; 
    				$connect->query($sql);

    			$sql = "UPDATE recipe SET favorite_count='" . $favCount. "' WHERE recipe_id='" . $rc . "'";
    				$connect->query($sql); 
    			
    			break;
    	case 3: $favCount = (getFavoriteCountById($ct, $t)-1); 
    			$sql = "DELETE FROM favorite where account_id='" .$aid. '" AND comment_id="'.$ct."'"; 
    				$connect->query($sql); 

    			$sql = "UPDATE comment SET favorite_count='" . $favCount . "' WHERE comment_id='" . $ct . "'";
    				$connect->query($sql); 

    			break;
    }



    $connect->close();

  	loadAll();

  	return $favCount;

}

function postComment($cid, $aid, $cnt, $cmt, $t, $rv, $rc, $a)
{
	global $comments;
	$connect = new DBConnection();
	$connect = $connect->getInstance();

	$sql = "INSERT INTO comment(comment_id, account_id, file_comment, favorite_count, type, review_id, recipe_id, acc_id)
	VALUES ('$cid', '$aid', 'comments.txt', '$cnt', '$t', '$rv', '$rc', '$a')";

	if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }

	$connect->close();

	$cmt = str_replace("\n", "<br>", $cmt) . "<br>";

	$temp_comment = new comment($cid, $aid, $cnt, $cmt, $t, $rv, $rc, $a);

	$comments[count($comments)] = $temp_comment;

	writeCommentsToText();

	loadAll();

	switch($t)
	{
		case 1: $compare = $rv; $div = "commentBox"; break;
		case 2: $compare = $rc; $div = "commentBox"; break;
		case 3: $compare = $a; $div = "postBox"; break;
	}

	$acc = getAccountById($aid);

	return "<div class=\"".$div."\"><a href='account.php?id=". $acc->getAccid() ."'><img class = \"itemBoxImg\" src = \"images/profile/" . $acc->getImg() . "\"></a>
			&nbsp;&nbsp&nbsp;&nbsp;<a href='account.php?id=". $acc->getAccid() ."'><b><font size = \"2\">" . $acc->getFirstname() . " " . $acc->getLastname() . "</font></b></a>
			<p id =\"".$cid."_heartCount\" class = \"heartCount\">" . $cnt . "</p><input type=\"image\" onclick=\"favorite(".$cid.", '3', '0');\" id=\"".$cid."_heartImg\"class = \"heartImg\" src = \"images/hollowheart.png\"><br><br>
			<p class = \"commentText\">" . $cmt . "</p>
			</div>";


}

function changeAboutMe($account_id, $aboutme)
{
	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp = $accounts[$i];
		if($temp->getAccid() == $account_id)
		{	
			$temp->set_aboutme($aboutme);
			break;
		}

	}

	writeAboutMeToText();
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

function writeAboutMeToText()
{
	$file = fopen("text/aboutme.txt", "w");

	$newline = PHP_EOL;

	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp = $accounts[$i];

		fwrite($file, $temp->getAccid().PHP_EOL);
		fwrite($file, $temp->get_aboutme().PHP_EOL);
		fwrite($file, ";".$newline);
	}

	fclose($file);

}


function writeCommentsToText()
{
	$file = fopen("text/comments.txt", "w");

	$newline = PHP_EOL;

	global $comments;

	for($i = 0; $i<count($comments); $i++)
	{
		$temp = $comments[$i];
		fwrite($file, $temp->get_commentid().$newline);
		fwrite($file, $temp->get_type().$newline);

		switch($temp->get_type()){
			case 1: fwrite($file, $temp->get_reviewid().$newline); break;
			case 2: fwrite($file, $temp->get_recipeid().$newline); break;
			case 3: fwrite($file, $temp->get_accid().$newline); break;

		}

		fwrite($file, $temp->get_favecounts().$newline);

		fwrite($file, $temp->get_accountid().$newline);

		fwrite($file, $temp->get_comment().$newline);

		fwrite($file, ";".$newline);

	}

	fclose($file);
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


function editReview($rev_id, $img, $txt, $rat)
{
	global $reviews;
				//echo $i . " -i " . $d . " -d " . $f . " -f";

	for($i = 0; $i<count($reviews); $i++)
	{
		$forEdit = $reviews[$i];

		if($rev_id == $forEdit->get_reviewid())
		{
			//echo $forEdit->get_recipeid();
				if(strcmp($txt, "") != 0)
				{
					$forEdit->set_reviewtext($txt);
				}

				if(strcmp($rat, "") !== 0)
				{	$connect = new DBConnection();
					$connect = $connect->getInstance();

						$sql = "UPDATE review SET review_count='" . $rat. "' WHERE review_id='" . $rev_id. "'"; 
						if ($connect->query($sql) !== TRUE) {
    					echo "Error: " . $sql . "<br>" . $connect->error;
    					}

    				 $connect->close();
				}
				
    

				$reviews[$i] = $forEdit;
		}
	}


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

function populateRecipeByName($name)
{
	global $recipes;
	$temp = null;
	$cnt = 0;

	for($i = 0; $i<count($recipes); $i++)
	{
		$temp = $recipes[$i];
		if(strcmp($name, $temp->get_recipename()) == 0 || strpos(strtolower($temp->get_recipename()), strtolower($name)) !== false)
		{
		echo "<a class =\"no\" href='recipe.php?link=". $temp->get_recipeid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/recipe/" . $temp->get_recipeimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_recipename() . "</font></b>
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
		$cnt++;
		}
	}


	if($cnt == 0) echo "<p align=\"center\">No results.</p>";
}

function populateReviewByName($name)
{
	global $reviews;
	$temp = null;
	$cnt = 0;

	for($i = 0; $i<count($reviews); $i++)
	{
		$temp = $reviews[$i];
		if(strcmp($name, $temp->get_reviewname()) == 0 || strpos(strtolower($temp->get_reviewname()), strtolower($name)) !== false){
		echo "<a class =\"no\" href='review.php?link=". $temp->get_reviewid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/review/" . $temp->get_reviewimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_reviewname() . "</font></b>
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<p class = \"heartCount\">" . $temp->get_reviewcounts() . "</p><img class = \"heartImg\" src = \"images/star.jpg\">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
		$cnt++;
		}
	}

	if($cnt == 0) echo "<p align=\"center\">No results.</p>";
}

function populateReviewByAccount($id, $aid)
{
	global $reviews;
	$temp = null;
	$cnt = 0;

	for($i = 0; $i<count($reviews); $i++)
	{
		$temp = $reviews[$i];
		if($temp->get_accid() == $id){

		if($temp->get_accid() == $aid){
		echo "<a href='review.php?link=". $temp->get_reviewid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/review/" . $temp->get_reviewimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_reviewname() . "</font></b><a href='edit-review.php?link=". $temp->get_reviewid()."'>&nbsp;&nbsp&nbsp;
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<p class = \"heartCount\">" . $temp->get_reviewcounts() . "</p><img class = \"heartImg\" src = \"images/star.jpg\">
		<input type=\"button\" value=\"Edit\" style=\"margin-top:5px; padding: 2px;\"/></a>
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
		$cnt++;
		}

		else
		{
			echo "<a class =\"no\" href='review.php?link=". $temp->get_reviewid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/review/" . $temp->get_reviewimg() . "\">
			&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_reviewname() . "</font></b>
			<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
			<p class = \"heartCount\">" . $temp->get_reviewcounts() . "</p><img class = \"heartImg\" src = \"images/star.jpg\">
			<br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
			$cnt++;
		}
	}
	}

	if($cnt == 0) echo "<p align=\"center\">No results.</p>";
}

function populateReviewByFavorite($aid)
{
	global $reviews;
	$temp = null;
	$cnt = 0;

	for($i = 0; $i<count($reviews); $i++)
	{
		$temp = $reviews[$i];
		if(hasLiked($aid, $temp->get_reviewid(), "1") == true){
		echo "<a class =\"no\" href='review.php?link=". $temp->get_reviewid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/review/" . $temp->get_reviewimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_reviewname() . "</font></b>
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<p class = \"heartCount\">" . $temp->get_reviewcounts() . "</p><img class = \"heartImg\" src = \"images/star.jpg\">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
		$cnt++;
		}
	}

	if($cnt == 0) echo "<p align=\"center\">No results.</p>";
}


function populateRecipeByAccount($id, $aid)
{
	global $recipes;
	$temp = null;
	$cnt = 0;

	for($i = 0; $i<count($recipes); $i++)
	{
		$temp = $recipes[$i];
		if($temp->get_accid() == $id)
		{
			if($temp->get_accid() == $aid)
			{
				echo "<a class href='recipe.php?link=". $temp->get_recipeid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/recipe/" . $temp->get_recipeimg() . "\">
				&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_recipename() . "</font>&nbsp;&nbsp&nbsp;</b><a href='edit-recipe.php?link=". $temp->get_recipeid()."'>
				<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
				<input type=\"button\" value=\"Edit\" style=\"margin-top:5px; padding: 2px;\"/></a>
				<br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div>";
				$cnt++;
			}
			else
			{
				echo "<a class =\"no\" href='recipe.php?link=". $temp->get_recipeid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/recipe/" . $temp->get_recipeimg() . "\">
				&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_recipename() . "</font></b>
				<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
				<br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
				$cnt++;
			}
		}
		
	}
	


	if($cnt == 0) echo "<p align=\"center\">No results.</p>";
}

function populateRecipeByFavorite($aid)
{
	global $recipes;
	$temp = null;
	$cnt = 0;

	for($i = 0; $i<count($recipes); $i++)
	{
		$temp = $recipes[$i];
		if(hasLiked($aid, $temp->get_recipeid(), "2") == true)
		{
		echo "<a class =\"no\" href='recipe.php?link=". $temp->get_recipeid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/recipe/" . $temp->get_recipeimg() . "\">
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->get_recipename() . "</font></b>
		<p class = \"heartCount\">" . $temp->get_favecounts() . "</p><img class = \"heartImg\" src = \"images/heart.jpg\">
		<br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;submitted by " . getAccountName($temp->get_accid()) . "</div></a>";
		$cnt++;
		}
	}


	if($cnt == 0) echo "<p align=\"center\">No results.</p>";
}

function populatePeople($name)
{
	global $accounts;
	$temp = null;
	$cnt = 0;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp = $accounts[$i];
		$firstname = $temp->getFirstname();
		$lastname = $temp->getLastname();
		$fullname = $firstname . " " . $lastname;

		if(strcmp($name, $fullname) == 0 || strpos(strtolower($firstname), strtolower($name)) !== false || strpos(strtolower($lastname), strtolower($name)) !== false){
		echo "<a class =\"no\" href='account.php?id=". $temp->getAccid()."'><div class =\"itemBox\"><img class = \"itemBoxImg\" src = \"images/profile/" . $temp->getImg() . "\">
		<br>
		&nbsp;&nbsp&nbsp;&nbsp;<b><font size = \"2\">" . $temp->getFirstname() . " " . $temp->getLastname() . "</font></b>
		</div></a>";
		$cnt++;
		}
	}

	if($cnt == 0) echo "<p align=\"center\">No results.</p>";
}

function populateCommentById($aid, $id, $type)
{
	global $comments;
	$temp = null;
	$cnt = 0;


	for($i = 0; $i<count($comments); $i++)
	{
		$temp = $comments[$i];


		switch($type)
		{
			case 1: $compare = $temp->get_reviewid(); $div = "commentBox"; break;
			case 2: $compare = $temp->get_recipeid(); $div = "commentBox"; break;
			case 3: $compare = $temp->get_accid(); $div = "postBox"; break;
		}

		if($compare == $id && $temp->get_type() == $type){
		$acc = getAccount(getAccountName($temp->get_accountid()));
		if(hasLiked($aid, $temp->get_commentid(), "3") == false)
		{
			echo "<div class=\"".$div."\"><a href='account.php?id=". $acc->getAccid() ."'><img class = \"itemBoxImg\" src = \"images/profile/" . $acc->getImg() . "\"></a>
			&nbsp;&nbsp&nbsp;&nbsp;<a href='account.php?id=". $acc->getAccid() ."'><b><font size = \"2\">" . $acc->getFirstname() . " " . $acc->getLastname() . "</font></b></a>
			<p id =\"".$temp->get_commentid()."_heartCount\" class = \"heartCount\">" . $temp->get_favecounts() . "</p><input type=\"image\" onclick=\"favorite(".$temp->get_commentid().", '3', '0');\" id=\"".$temp->get_commentid()."_heartImg\"class = \"heartImg\" src = \"images/hollowheart.png\"><br><br>
			<p class = \"commentText\">" . $temp->get_comment() . "</p>
			</div>";
		}
		else
		{
			echo "<div class=\"".$div."\"><a href='account.php?id=". $acc->getAccid() ."'><img class = \"itemBoxImg\" src = \"images/profile/" . $acc->getImg() . "\"></a>
			&nbsp;&nbsp&nbsp;&nbsp;<a href='account.php?id=". $acc->getAccid() ."'><b><font size = \"2\">" . $acc->getFirstname() . " " . $acc->getLastname() . "</font></b></a>
			<p id =\"".$temp->get_commentid()."_heartCount\" class = \"heartCount\">" . $temp->get_favecounts() . "</p><input type=\"image\" onclick=\"unfavorite(".$temp->get_commentid().", '3', '0');\" id=\"".$temp->get_commentid()."_heartImg\"class = \"heartImg\" src = \"images/hollowheart.png\"><br><br>
			<p class = \"commentText\">" . $temp->get_comment() . "</p>
			</div>";
		}
	 }

	}
}

function echoFavorite($aid, $id, $type)
{

	if(hasLiked($aid, $id, $type) == false)
	{
		echo "<input title=\"Favorite\" type=\"image\" id=\"".$id."_favorited\" onclick=\"favorite(".$id.", ".$type.", '1');\" class = \"favorited\" src = \"images/hollowheart.png\">";
	}
	else 
		echo "<input title=\"Unfavorite\" type=\"image\" id=\"".$id."_favorited\" onclick=\"unfavorite(".$id.", ".$type.", '1');\" class = \"favorited\" src = \"images/heart.jpg\">";

}

?>	