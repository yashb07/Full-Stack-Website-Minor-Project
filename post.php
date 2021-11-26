<?php  
include("includes/header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
}
?>
	<div class="single-post-container">
		<div class="user-details-container">
			<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>
			<div class="user-details">
				<a href="<?php echo $userLoggedIn; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
				<?php 
					echo("<p style='font-size: 1.4rem; margin-bottom: 0.5rem;'> Posts: ".$user['num_posts']."</p>
					<p style='font-size: 1.4rem;'> Likes: ".$user['num_likes']."</p>");
				?>
			</div>
		</div>
		<div class="main_column status_post" id="main_column">
			<div class="posts_area">
				<?php 
					$post = new Post($con, $userLoggedIn);
					$post->getSinglePost($id);
				?>
			</div>
		</div>
	</div>