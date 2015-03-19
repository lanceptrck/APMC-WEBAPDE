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

	function __construct($id, $name, $accid, $img, $ing, $dir, $fac, $cnt)
	{
		$this->recipe_id = $id;
		$this->recipe_name = $name;
		$this->account_id = $accid;
		$this->recipeImg = $img;
		$this->$ingredients = $ing;
		$this->directions = $dir;
		$this->facts = $fac;
		$this->fave_count = $cnt;
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
		return $this->accountId;
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
			$this->password = "1234";
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