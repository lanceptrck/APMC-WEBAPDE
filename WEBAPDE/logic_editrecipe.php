<?php

	session_start();
	include 'functions.php';
	loadAll();

	if(isset($_SESSION["username"])){
	$loggedIn_account = getAccount($_SESSION["username"]);
	$account_id = $loggedIn_account->getAccid();
	}

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{

		$recipe_id = $_GET['q'];

		$title = $ingredients = $directions = $facts = "";
		$tErr = $iErr = $dErr = $fErr = "";
		$isErr = false;

		$target_dir = "images/recipe/";

		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		$file_name = "rec_" .$recipe_id.".".$file_type;
		$file_size = $_FILES["fileToUpload"]["size"];
		$img_file = $_FILES["fileToUpload"]["tmp_name"];

		$submitted = isset($_POST["submit"]);

		if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    	if($check !== false) {
	        	echo "File is an image - " . $check["mime"] . ".";
	        	$uploadOk = 1;
	    	} else {
	       	 echo "File is not an image.";
   		    	 $uploadOk = 0;
    		}
		}

    if($file_size < 0)
    {
        $isErr = true;
    } 

		if (empty($_POST["ingredients_txt"])) {
     			$iErr = "Ingredients is required";
   			} else {
     			$ingredients = $_POST["ingredients_txt"];
     				// check if name only contains letters and whitespace
     	}

     	if (empty($_POST["directions_txt"])) {
     			$dErr = "Directions is required";;
   			} else {
     			$directions = $_POST["directions_txt"];
     				// check if name only contains letters and whitespace
     	}


     	if (empty($_POST["facts_txt"])) {
     			$fErr = "Facts is required";
   			} else {
     			$facts = $_POST["facts_txt"];
     				// check if name only contains letters and whitespace
     	}

     	if($isErr == false)
     	{

        $toPost = uploadPicture($target_dir.$file_name, $file_type, $file_name, $file_size, $_FILES["fileToUpload"]["tmp_name"]);

          editRecipe($recipe_id, $file_name, $ingredients, $directions, $facts);
          header("Location: recipe.php?link=$recipe_id");
          exit;
        }

     	 else {
        echo "An error occured, going back to post page.";
        header("Refresh: 2; URL=post.php");
      }

   		
	}

?>