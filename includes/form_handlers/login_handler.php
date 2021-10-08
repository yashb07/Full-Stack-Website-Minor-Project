<?php

if (isset($_POST['log_button'])) {
	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Checks if email is in the correct format
	$_SESSION['log_email'] = $email; //Store email to session variable
	$password = md5($_POST['log_password']); //checks if md5 version exists, if same then logs in
	$check_database_query = mysqli_query($con,"SELECT * FROM users WHERE email ='$email' AND password ='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if ($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query); //Results from the query are stored as an array inside here ($row)
		$username = $row['username']; //Access the result from the column where the username matches

		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email ='$email' AND user_closed ='yes'");
		if (mysqli_num_rows($user_closed_query) == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed ='no' WHERE email ='$email'"); //Reopening a closed account
		}

		$_SESSION['username'] = $username; //If there is a value in it, it means user has logged in. If it is empty, we can redirect them back to login page
		header("Location: index.php"); //If they logged in, it will lead them to Index page
		exit();
	}
	else{
		array_push($error_array,"Incorrect E-mail or Password<br>");
	}
}
?>
