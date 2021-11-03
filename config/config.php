<?php
ob_start(); //Turns on output buffering //Sends the PHP code to browser, all at once
session_start();

$timezone = date_default_timezone_set("Asia/Kolkata"); //Shows how long before post was uploaded

$con = mysqli_connect("localhost:3306","root","","social"); //"localhost,username,password,databse_name"
//changing port number because just local host doesn't work
if (mysqli_connect_errno()) {
	echo "Failed to connect: ".mysql_connect_errno(); //returns error code in case of some error
}

?>
