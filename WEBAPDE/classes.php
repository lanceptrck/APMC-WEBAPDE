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

class comment
{
	public $comment_id;
	public $account_id;
	public $comment;
	public $type;
	public $favorite_count;
	public $review_id;
	public $recipe_id;
	public $acc_id;

	function __construct($cid, $aid, $cnt, $cmt, $t, $rv, $rc, $a)
	{
		$this->comment_id = $cid;
		$this->account_id = $aid;
		$this->comment = $cmt;
		$this->type = $t;
		$this->favorite_count = $cnt;
		$this->review_id = $rv;
		$this->recipe_id = $rc;
		$this->acc_id = $a;
	}

	function get_commentid()
	{
		return $this->comment_id;
	}

	function get_accountid()
	{
		return $this->account_id;
	}

	function get_reviewid()
	{
		return $this->review_id;
	}

	function get_recipeid()
	{
		return $this->recipe_id;
	}

	function get_accid()
	{
		return $this->acc_id;
	}

	function get_type()
	{
		return $this->type;
	}

	function get_favecounts()
	{
		return $this->favorite_count;
	}

	function get_comment()
	{
		return $this->comment;
	}

	/* setters */

	function set_commentid($input)
	{
		$this->comment_id = $input;
	}

	function set_accountid($input)
	{
		$this->account_id = $input;
	}

	function set_reviewid($input)
	{
		$this->review_id = $input;
	}

	function set_recipeid($input)
	{
		$this->recipe_id = $input;
	}

	function set_accid($input)
	{
		$this->acc_id = $input;
	}

	function set_type($input)
	{
		$this->type = $input;
	}

	function set_favcount($input)
	{
		$this->favorite_count = $input;
	}

	function set_comment($input)
	{
		$this->comment = $input;
	}
}

class favorite
{
	public $favorite_id;
	public $account_id;
	public $type;
	public $review_id;
	public $recipe_id;
	public $comment_id;

	function __construct($fid, $aid, $t, $rv, $rc, $ct)
	{
		$this->favorite_id = $fid;
		$this->account_id = $aid;
		$this->type = $t;
		$this->review_id = $rv;
		$this->recipe_id = $rc;
		$this->comment_id = $ct;

	}

	function get_favoriteid()
	{
		return $this->favorite_id;
	}

	function get_commentid()
	{
		return $this->comment_id;
	}

	function get_accountid()
	{
		return $this->account_id;
	}

	function get_reviewid()
	{
		return $this->review_id;
	}

	function get_recipeid()
	{
		return $this->recipe_id;
	}

	function get_type()
	{
		return $this->type;
	}

	/* setters */

	function set_commentid($input)
	{
		$this->comment_id = $input;
	}

	function set_accountid($input)
	{
		$this->account_id = $input;
	}

	function set_reviewid($input)
	{
		$this->review_id = $input;
	}

	function set_recipeid($input)
	{
		$this->recipe_id = $input;
	}

	function set_favoriteid($input)
	{
		$this->favorite_id = $input;
	}

	function set_type($input)
	{
		$this->type = $input;
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
	public $about_me;

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

	function set_aboutme($input)
	{
		$this->about_me = $input;
	}

	function get_aboutme()
	{
		return $this->about_me;
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