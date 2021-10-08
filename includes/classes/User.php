<?php
class User {
	private $user;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;//references the variable of the class
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
		//con is a connection variable used to pass the user details with the username stored in $user
		$this->user = mysqli_fetch_array($user_details_query);
	}
	// the above function creates an object of the user class and initialises variables to use.
    // $user_obj = new User($con,$userLoggedIn); calling the function
	public function getUsername() {
		return $this->user['username'];
	}

	public function getNumPosts() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['num_posts'];
	}

	public function getFirstAndLastName() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);
		return $row['first_name'] . " " . $row['last_name'];
	}

	public function isClosed() {
		$username = $this->user['username'];
		$query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
		$row = mysqli_fetch_array($query);

		if($row['user_closed'] == 'yes')
			return true;
		else 
			return false;
	}

	




}

?>