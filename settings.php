<?php 
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>

<div class="main_column column">
	<h4>Account Settings</h4>
	<div class="profile-img-container">
		<?php
			echo "<img src='" . $user['profile_pic'] ."' class='small_profile_pic'>";
		?>
		<a href="upload.php">Upload new profile picture</a>
	</div>
	<div class="profile-update-container">
		<?php
		$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
		$row = mysqli_fetch_array($user_data_query);
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$email = $row['email'];
		?>
		<div class="profile-details-container">
			<h4>Update Details</h4>
			<form action="settings.php" method="POST">
				<div class="profile-details-row">
					<p>First Name: </p>
					<input type="text" name="first_name" value="<?php echo $first_name; ?>" id="settings_input">
				</div>
				<div class="profile-details-row">
					<p>Last Name: </p>
					<input type="text" name="last_name" value="<?php echo $last_name; ?>" id="settings_input">
				</div>
				<div class="profile-details-row">
					<p>Email: </p>
					<input type="text" name="email" value="<?php echo $email; ?>" id="settings_input">
				</div>
				<?php echo $message; ?>
				<input type="submit" name="update_details" id="save_details" value="Update Details" class="info settings_submit"><br>
			</form>
		</div>
		<div class="profile-details-container">
			<h4>Change Password</h4>
			<form action="settings.php" method="POST">
				<div class="profile-details-row">
						<p>Old Password: </p>
						<input type="password" name="old_password" id="settings_input">
				</div>	
				<div class="profile-details-row">
						<p>New Password: </p>
						<input type="password" name="new_password_1" id="settings_input">
				</div>	
				<div class="profile-details-row">
						<p>Confirm Password: </p>
						<input type="password" name="new_password_2" id="settings_input">
				</div>
				<?php echo $password_message; ?>
				<input type="submit" name="update_password" id="save_details" value="Update Password" class="info settings_submit"><br>
			</form>
		</div>
	</div>
	<div class="profile-remove">
		<h4>Close Account</h4>
		<form action="settings.php" method="POST">
			<input type="submit" name="close_account" id="close_account" value="Close Account" class="danger settings_submit">
		</form>
	</div>
</div>