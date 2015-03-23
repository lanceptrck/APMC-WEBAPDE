<?php

	$iFile= fopen("text/ingredients.txt", "r");
	$dFile= fopen("text/directions.txt", "r");
	$fFile= fopen("text/facts.txt", "r");

	$ingredients_text = "";
	$ingredients_array = array();
	$found = false;

	while(!feof($iFile) || $found == true)
	{
		$init = str_replace(array("\r", "\n"), "", fgets($iFile));
		//echo $init . " " . strlen($init) . "<br>";
		if(strcmp($init, "10009") == 0)
		{
			do {
				$save = str_replace(array("\r", "\n"), "", fgets($iFile));
				if(strcmp($save, ";") != 0)
					$ingredients_text .= $save ."<br>";	
			}while(strcmp($save, ";"));

		}
	}

	fclose($iFile);

	echo $ingredients_text;

?>