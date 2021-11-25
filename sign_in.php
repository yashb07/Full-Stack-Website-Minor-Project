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
                <h1>Login</h1>
                <form action="sign_in.php" method="POST">
                    <input class="whitebox" type="text" name="log_email" placeholder="E-mail" value="<?php
                        if (isset($_SESSION['log_email'])) {
                            echo $_SESSION['log_email'];
                        }
                        ?>"required><br>
                    <input id="myPass" class="whitebox" type="password" name="log_password" placeholder="Password" value="<?php
                        if (isset($_SESSION['log_password'])) {
                            echo $_SESSION['log_password'];
                        }
                        ?>"required><i id="showPass" onclick="showPass()" class="fa fa-eye fa-eye-slash"></i><br>
                    <input class="btn-primary submit" type="submit" name="login_button" value="Login">
                        <?php if (in_array("Incorrect E-mail or Password<br>",$error_array)) {
                            echo "Incorrect E-mail or Password<br>";
                        }?>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>