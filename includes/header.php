<?php  
	require 'config/config.php';
	include("includes/classes/User.php");
	include("includes/classes/Post.php");
	include("includes/classes/Message.php");
	include("includes/classes/Notification.php");
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
		<title>Welcome to Swirlfeed</title>
		<!-- Javascript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="assets/js/demo.js"></script>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/style_navbar.css">
		<link rel="stylesheet" href="assets/css/style_feed.css">
		<link rel="stylesheet" href="assets/css/style_profile.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
	<nav>
		<?php
			//Unread messages 
			$messages = new Message($con, $userLoggedIn);
			$num_messages = $messages->getUnreadNumber();
			//Unread notifications 
			$notifications = new Notification($con, $userLoggedIn);
			$num_notifications = $notifications->getUnreadNumber();
			//Unread notifications 
			$user_obj = new User($con, $userLoggedIn);
			$num_requests = $user_obj->getNumberOfFriendRequests();
		?>
		<div class="logo">
			<a href="index.php">Connectify |</a>
			<a href="<?php echo $userLoggedIn ?>">
				<h3 class="uname"><?php echo $user['first_name'];?></h3>
			</a>
		</div>
		<div class="search">
			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">
				<img class="search-btn" src="assets/images/icons/magnifying_glass.png">
			</form>
			<div class="search_results"></div>
			<div class="search_results_footer_empty"></div>
		</div>
		<div class="nav-links">
			<a href="index.php">
				<i class="fa fa-home"></i>
			</a>
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
				<i class="fa fa-envelope"></i>
				<?php
					if($num_messages > 0)
					echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>';
				?>
			</a>
			<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
				<i class="fa fa-bell"></i>
				<?php
					if($num_notifications > 0)
					echo '<span class="notification_badge" id="unread_notification">' . $num_notifications . '</span>';
				?>
			</a>
			<a href="requests.php">
				<i class="fa fa-users fa-lg"></i>
				<?php
					if($num_requests > 0)
					echo '<span class="notification_badge" id="unread_requests">' . $num_requests . '</span>';
				?>
			</a>
			<a href="settings.php">
				<i class="fa fa-sliders"></i>
			</a>
			<a href="includes/handlers/logout.php">
				<i class="fa fa-sign-out"></i>
			</a>
		</div>
		<div class="dropdown_data_window" style="height:0px; border:none;"></div>
		<input type="hidden" id="dropdown_data_type" value="">
    </nav>


	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('.dropdown_data_window').scroll(function() {
			var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing data
			var scroll_top = $('.dropdown_data_window').scrollTop();
			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

			if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

				var pageName; //Holds name of page to send ajax request to
				var type = $('#dropdown_data_type').val();


				if(type == 'notification')
					pageName = "ajax_load_notifications.php";
				else if(type == 'message')
					pageName = "ajax_load_messages.php"


				var ajaxReq = $.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage 
						$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage 


						$('.dropdown_data_window').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>


	<div class="wrapper">