<!DOCTYPE html>

<?php
require 'config/config.php'; //Access the connection
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/utilities.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="flex-container flex">
        <div class="left flex">
            <div class="left-logo">
                <img src="./images/logoMain.png" alt="Logo" class="logo">
            </div>
            <h1 class="title">Welcome to Connectify!</h1>
            <h4>Connect with your friends and share<br>by joining our community now!</h4>
            <img src="./images/login_logo.png" alt="Rocket Image" class="rocket">
        </div>
        <div class="right flex">
            <div class="right-btn">
                <button class="btn1 btn-primary" id="loginBtn"><a onclick="setActive()" href="sign_in.php">Login</a></button>
                <button class="btn2 btn-primary" id="registerBtn"><a onclick="setActive()" href="sign_up.php">Sign up</a></button>
            </div>
            <div class="form">
                <h1>Sign up</h1>
                <form action="sign_up.php" method="POST">
                <input class="whitebox" type="text" name="reg_fname" placeholder="First Name" value="<?php
                if (isset($_SESSION['reg_fname'])) {
                    echo $_SESSION['reg_fname'];
                }
                ?>"required><br> <!-- required means mandatory field -->
                <?php if (in_array("Your first name should be between 2 and 25 characters<br>", $error_array)) echo "Your first name should be between 2 and 25 characters<br>"; ?>

                <input class="whitebox" type="text" name="reg_lname" placeholder="Last Name" value="<?php
                if (isset($_SESSION['reg_lname'])) {
                    echo $_SESSION['reg_lname'];
                }
                ?>"required><br>
                <?php if (in_array("Your last name should be between 2 and 25 characters<br>", $error_array)) echo "Your last name should be between 2 and 25 characters<br>"; ?>

                <input class="whitebox" type="email" name="reg_email" placeholder="E-mail" value="<?php
                if (isset($_SESSION['reg_email'])) {
                    echo $_SESSION['reg_email'];
                }
                ?>"required><br>

                <input class="whitebox" type="email" name="reg_email2" placeholder="Confirm E-mail" value="<?php
                if (isset($_SESSION['reg_email2'])) {
                    echo $_SESSION['reg_email2'];
                }
                ?>"required><br>
                <?php if (in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
                else if (in_array("Invalid E-mail format<br>", $error_array)) echo "Invalid E-mail format<br>";
                else if (in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>";?>

                <input id="myPass" class="whitebox" type="password" name="reg_password" placeholder="Password" required>
                <i id="showPass" onclick="showPass()" class="fa fa-eye fa-eye-slash"></i><br>
                <input class="whitebox" type="password" name="reg_password2" placeholder="Confirm Password" required> <br>
                <?php if (in_array("Passwords don't match<br>", $error_array)) echo "Passwords don't match<br>";
                else if (in_array("Your password can only contain English characters and numbers<br>", $error_array)) echo "Your password can only contain English characters and numbers<br>";
                else if (in_array("Your password should be between 6 and 30 characters<br>", $error_array)) echo "Your password should be between 6 and 30 characters<br>";?>

                <input class="btn-primary submit" type="submit" name="reg_button" value="Register"> <br>

                <?php if (in_array("<span style = 'color: #14C800;'>You are all set! Go ahead and login.</span><br>", $error_array)) echo "<span style = 'color: #14C800;'>You are all set! Go ahead and login.</span><br>";?>
                </form>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
