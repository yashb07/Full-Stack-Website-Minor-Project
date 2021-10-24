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
        <link rel="stylesheet" href="css/style_navbar.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/style_feed.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/style_profile.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>
    <body>
        <nav>    
            <div class="logo">
                <h3><i class="bi bi-share"></i>Connectify |</h3>
                <a href="<?php echo $userLoggedIn ?>">
                    <h3 class="uname"><?php echo $user['first_name'];?></h3>
                </a>
            </div>
            <div class="nav-links">
                <a href="index.php"><i class="bi bi-house"></i> Home</a>
                <a href="#"><i class="bi bi-chat-left"></i> Messages</a>
                <a href="#"><i class="bi bi-bell"></i> Notifs</a>
                <a href="#"><i class="bi bi-gear"></i> Settings</a>
                <a href="includes/handlers/logout.php"><i class="bi bi-box-arrow-right"></i> Log Out</a>
            </div>
        </nav>
        <hr>
        <div class="wrapper">