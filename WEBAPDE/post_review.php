<?php
	
	session_start();
	
	include 'functions.php';

	loadAll();

	$loggedIn_account = getAccount($_SESSION["username"]);
	$account_id = $loggedIn_account->getAccid();


	if($_SERVER["REQUEST_METHOD"] == "POST")
	{

		$title = $review_text = $rating = "";
		$tErr = $rErr = $ratErr = "";
		$isErr = false;

		$target_dir = "images/review/";

		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		$file_name = "rev_" . (getLastReviewId()+1) .".".$file_type;
		$file_size = $_FILES["fileToUpload"]["size"];
		$img_file = $_FILES["fileToUpload"]["tmp_name"];

		$submitted = isset($_POST["submit"]);

    if($file_size < 0)
    {
        $isErr = true;
    } 

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

		if (empty($_POST["review_title"])) {
     			$tErr = "Title is required";
     			$isErr = true;
   			} else {
     			$title = test_input($_POST["review_title"]);
     				// check if name only contains letters and whitespace
     			if (!preg_match("/^[a-zA-Z0-9,.!? ]*$/", $title)) {
       				$tErr = "Only letters and white space allowed"; 
       				$isErr = true;
     			}
   			}

		if (empty($_POST["review_txt"])) {
     			$iErr = "Review text is required";
     			$isErr = true;
   			} else {
     			$review_text = $_POST["review_txt"];
     				// check if name only contains letters and whitespace
     	}

     	if (empty($_POST["rating-input-1"])) {
     			$ratErr = "Rating is required";
     			$isErr = true;
   			} else {
     			$rating = $_POST["rating-input-1"];
     				// check if name only contains letters and whitespace
     	}

     	if($isErr == false)
     	{

        $toPost = uploadPicture($target_dir.$file_name, $file_type, $file_name, $file_size, $_FILES["fileToUpload"]["tmp_name"]);
        $latest = getLastReviewId()+1;
        if($toPost == true)
        {
          postReview(getLastReviewId()+1, $account_id, $title, $review_text, $rating, $file_name);
     		    echo "Review successfuly posted!";
            header("Refresh: 2; URL=review.php?link=$latest");
            exit;
        } 
        
     	} else {
     		echo "An error occured, going back to post page.";
     		header("Refresh: 2; URL=post.php");
     	}

   		
	}
	
?>



