<?php

class recipe
{
	private $recipe_id;
	private $recipe_name;
	private $account_id;
	private $recipeImg;
	private $ingredients;
	private $directions;
	private $facts;
	private $fave_count;

	function __construct($id, $name, $accid, $img, $ing, $dir, $fac, $fcnt)
	{
		$this->recipe_id = $id;
		$this->recipe_name = $name;
		$this->account_id = $accid;
		$this->recipeImg = $img;
		$this->ingredients = $ing;
		$this->directions = $dir;
		$this->facts = $fac;
		$this->fave_count = $fcnt;
	}

	function loadComments()
	{

	}

	function postComment()
	{

	}

	function deleteComment()
	{

	}

	function set_ingredients($input)
	{
		$this->ingredients = $input;
	}

	function set_directions($input)
	{
		$this->directions = $input;
	}

	function set_facts($input)
	{
		$this->facts = $input;
	}

	function get_recipeid()
	{
		return $this->recipe_id;
	}

	function get_recipename()
	{
		return $this->recipe_name;
	}

	function get_accid()
	{
		return $this->account_id;
	}

	function get_recipeimg()
	{
		return $this->recipeImg;
	}

	function get_ingredients()
	{
		return $this->ingredients;
	}

	function get_directions()
	{
		return $this->directions;
	}

	function get_facts()
	{
		return $this->facts;
	}

	function get_favecounts()
	{
		return $this->fave_count;
	}
}

class review
{
	private $review_id;
	private $review_name;
	private $account_id;
	private $reviewImg;
	private $review_text;
	private $fave_count;
	private $review_count;

	function __construct($id, $name, $accid, $img, $fcnt, $rcnt)
	{
		$this->review_id = $id;
		$this->review_name = $name;
		$this->account_id = $accid;
		$this->reviewImg = $img;
		$this->fave_count = $fcnt;
		$this->review_count = $rcnt;
	}

	function loadComments()
	{

	}

	function postComment()
	{

	}

	function deleteComment()
	{

	}

	function set_reviewtext($input)
	{
		$this->review_text = $input;
	}

	function get_reviewid()
	{
		return $this->review_id;
	}

	function get_reviewname()
	{
		return $this->review_name;
	}

	function get_accid()
	{
		return $this->account_id;
	}

	function get_reviewimg()
	{
		return $this->reviewImg;
	}

	function get_reviewtext()
	{
		return $this->review_text;
	}

	function get_favecounts()
	{
		return $this->fave_count;
	}

	function get_reviewcounts()
	{
		return $this->review_count;
	}



}

class account
{
	public $account_id;
	public $account_img;
	public $username;
	public $password;
	public $firstname;
	public $lastname;
	public $email;

	function __construct($accid, $img, $user, $pass, $fn, $ln, $em)
	{
		$this->account_id = $accid;
		$this->account_img = $img;
		$this->username = $user;
		$this->password = $pass;
		$this->firstname = $fn;
		$this->lastname = $ln;
		$this->email = $em;

	}

	function changePass($pw)
	{
		$this->password = $pw;
	}

	function changeEmail($em)
	{
		$this->email = $em;
	}

	function getUser()
	{
		return $this->username;
	}

	function getPass()
	{
		return $this->password;
	}

	function getImg()
	{
		return $this->account_img;
	}

	function getFirstname()
	{
		return $this->firstname;
	}

	function getLastname()
	{
		return $this->lastname;
	}

	function getEmail()
	{
		return $this->email;
	}

	function getAccid()
	{
		return $this->account_id;
	}
}

class DBConnection
{
	private $servername;
	private	$dbuser;
	private	$password;
	private	$dbName;
	private $conn;

	function __construct()
	{
			$this->servername = "localhost";
			$this->dbuser = "root";
			$this->password = "root";
			$this->dbName = "potato";
			$this->conn = new mysqli($this->servername, $this->dbuser, $this->password, $this->dbName);
	}

	function getInstance()
	{
					/* Connect */
		if($this->conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
	
		}

		else return $this->conn;
	}

}

?>