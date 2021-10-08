<?php

// Declaring variables
$fname = "";
$lname = "";
$em = ""; //email
$em2 = ""; //Confirm email
$password = "";
$password2 = ""; //Confirm password
$date = "";
$error_array = array(); //Holds error messages
if (isset($_POST['reg_button'])) { //if button is pressed, start having the form
	// Registration form values

	// FIRST NAME
	// strip_tag removes HTML tags, e.g. if someone inputs username as <a>Leo</a>, strip_tags will just take 'Leo' as input
	$fname = strip_tags($_POST['reg_fname']); //Store values sent from the form in this variable //$_POST because method="POST"
	$fname = str_replace(' ', '', $fname); //if a user accidently puts space after their name, it'll remove that
    $fname = ucfirst(strtolower($fname)); //Uppercases the first letter
    $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

    // LAST NAME
    $lname = strip_tags($_POST['reg_lname']);
	$lname = str_replace(' ', '', $lname); //if a user accidently puts space after their name, it'll remove that
    $lname = ucfirst(strtolower($lname)); //Uppercases the first letter
    $_SESSION['reg_lname'] = $lname; //Stores last name into session variable

    // EMAIL
    $em = strip_tags($_POST['reg_email']);
	$em = str_replace(' ', '', $em); //if a user accidently puts space after their name, it'll remove that
    $em = strtolower($em); //Uppercases the first letter
    $_SESSION['reg_email'] = $em; //Stores email into session variable

    // CONFIRM EMAIL
    $em2 = strip_tags($_POST['reg_email2']);
	$em2 = str_replace(' ', '', $em2); //if a user accidently puts space after their name, it'll remove that
    $em2 = strtolower($em2); //Uppercases the first letter
    $_SESSION['reg_email2'] = $em2; //Stores email2 into session variable

    // PASSWORD
    $password = strip_tags($_POST['reg_password']);

    // CONFIRM PASSWORD
    $password2 = strip_tags($_POST['reg_password2']);

    // DATE
    $date = date("Y-m-d"); //Current Date

    if ($em == $em2) {
    	if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
    		$em = filter_var($em, FILTER_VALIDATE_EMAIL);

    		//CHECK IF EMAIL ALREADY EXISTS
    		$e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$em'");
    		$num_rows = mysqli_num_rows($e_check); // Counts the number of times that e-mail has been used
    		if ($num_rows > 0) {
    			array_push($error_array, "Email already in use<br>");
    		}
    	}
    	else{
    		array_push($error_array, "Invalid E-mail format<br>");
    	}
    }
    else {
    	array_push($error_array, "Emails don't match<br>");
    }


    if (strlen($fname) > 25 || strlen($fname) < 2) {
    	array_push($error_array, "Your first name should be between 2 and 25 characters<br>");
    }

    if (strlen($lname) > 25 || strlen($lname) < 2) {
    	array_push($error_array, "Your last name should be between 2 and 25 characters<br>");
    }

    if ($password != $password2) {
    	array_push($error_array, "Passwords don't match<br>");
    }
    else{
    	if (preg_match('/[^A-Za-z0-9]/', $password)) {
    		array_push($error_array, "Your password can only contain English characters and numbers<br>");
    	}
    }

    if (strlen($password) > 30 || strlen($password) < 6) {
    	array_push($error_array, "Your password should be between 6 and 30 characters<br>");
    }

    if (empty($error_array)) {
    	$password = md5($password); //Encrypts password before sending to database

    	//Generate username by concatenating first name and last name
    	$username = strtolower($fname."_".$lname);
    	$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    	$i = 0;

    	while (mysqli_num_rows($check_username_query) != 0) {
    		$i++;
    		$username = $username."_".$i;
    		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    	}

       //Profile picture assignment
       $rand = rand(1,2);
       if ($rand == 1) {
       	$profile_pic = "images/head_nephritis.png";
       }
       else if ($rand == 2) {
       	$profile_pic = "images/head_wisteria.png";
       }
       $query = mysqli_query($con, "INSERT INTO users VALUES ('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')");

       array_push($error_array,"<span style = 'color: #14C800;'>You are all set! Go ahead and login.</span><br>");

       //Clear session variables
       $_SESSION['reg_fname'] ="";
       $_SESSION['reg_lname'] ="";
       $_SESSION['reg_email'] ="";
       $_SESSION['reg_email2'] ="";
    }
}
?>
