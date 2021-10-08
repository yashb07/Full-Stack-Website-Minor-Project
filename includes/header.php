<?php  
require 'config/config.php';


if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else {
	header("Location: sign_in.php");
}

?>

<html>
<head>
	<title>Connectify</title>

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!-- <script src="assets/js/bootstrap.js"></script> -->
    <link rel="icon" href="images/logo1.png">
	<link rel="stylesheet" href="css/style_head.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


</head>
<body>

<div class="topbar">    
    <div class="headname">
        <h3><i class="bi bi-share"></i>  Connectify |</h3>
        <a href="<?php echo $userLoggedIn ?>"> <h3 class="uname"><?php echo $user['first_name']; ?></h3> </a>
    </div>
    <hr>
    <nav id="m">
                <div class="m-i">
                    <div class="m-text">
                        <a href="index.php"><i class="bi bi-house"></i> Home</a>
                    </div>
                </div>
                <div class="m-i">
                    <div class="m-text">
                        <a href="#"><i class="bi bi-chat-left"></i> Messages</a>
                    </div>
                </div>
                <div class="m-i">
                    <div class="m-text">
                        <a href="#"><i class="bi bi-bell"></i> Notifs</a>
                    </div>
                </div>
                <div class="m-i">
                    <div class="m-text">
                        <a href="#"><i class="bi bi-gear"></i> Settings</a>
                    </div>
                </div>
                <div class="m-i">
                    <div class="m-text">
                        <a href="includes/handlers/logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
                    </div>
                </div>
    </nav>

	</div>


	<div class="wrapper">