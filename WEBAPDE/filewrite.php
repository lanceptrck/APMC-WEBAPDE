<?php
	
	include 'functions.php';
	loadAll();


	$file = fopen("text/test.txt", "w");
	$dFile = fopen("text/test1.txt", "w");
	$fFile = fopen("text/test2.txt", "w");

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

?>