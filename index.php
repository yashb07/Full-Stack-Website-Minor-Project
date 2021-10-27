<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");


if(isset($_POST['post'])){

	$uploadOk =1; //whether the upload is succ. or no
	$imageName = $_FILES['fileToUpload']['name']; //gives us file name, and ['name'] gives us name
	$errorMessage="";
	if($imageName!="")
	{
		$targetDir = "images/posts/";
		$imageName = $targetDir.uniqid().basename($imageName); //creates a random id for the id
		//why unique id? if two people upload the same filenamed files, then this unique id will help us differentiate
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);
		//gets info about the file
		if($_FILES['fileToUpload']['size']>100000000)
		{
			//checking for maximum size
			$errorMessage ="Sorry your file is too large to upload!";
			//we could not encounter this error by reducing quality of the image using various compressor APIs
			$uploadOk=0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk) {
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)){
				//image uploaded
			}
			else{
				$uploadOk=0;
			}
		}
	}
	if($uploadOk)
	{
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], 'none',$imageName);
	}
	else{
		echo "<div style='text-align:center;' class='alert alert-danger'>
		$errorMessage
		</div>";
	}
}


 ?>
	<div class="user_details column">
		<a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>

		<div class="user_details_left_right">
			<a href="<?php echo $userLoggedIn; ?>">
			<?php 
			echo $user['first_name'] . " " . $user['last_name'];

			 ?>
			</a>
			<br>
			<?php echo "Posts: " . $user['num_posts']. "<br>"; 
			echo "Likes: " . $user['num_likes'];

			?>
		</div>

	</div>

	<div class="main_column column tp">
		<form class="post_form" action="index.php" method="POST" enctype="multipart/form-data"> <!--using enctype, 
		so that form processes multimedia type data-->
		<textarea name="post_text"id="post_text" placeholder="What's on your mind?" maxlength="100"></textarea>
			<input type="submit" name="post" id="post_button" value="Post">
			<input type="file" name="fileToUpload" id="fileToUpload" value="Select Media" style="display:none;">
			<label for="fileToUpload" id="mediabut"><i class="bi bi-plus-circle fa-10x"></i></label>
		</form>

		<div class="posts_area"></div>
		<img id="loading" src="images/loading.gif">
<!-- 	
	//$user_obj = new User($con, $userLoggedIn);
	//echo $user_obj->getFirstAndLastName();
	// why classes and objects? to write the code once and use it multiple times
	//getting rid of these lines as the ajax call will shows all the posts

	//using ajax to load posts without refreshing the page
	//ajax used to make database calls
	 -->

	</div>

	<script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';
//function to instruct the loader to not do anything until document is ready
	$(document).ready(function() {

		$('#loading').show();

		//Original ajax request for loading first posts 
		$.ajax({
			url: "includes/handlers/ajax_load_posts.php",
			type: "POST",
			data: "page=1&userLoggedIn=" + userLoggedIn,
			cache:false,

			success: function(data) {
				$('#loading').hide(); //once data is loaded it will stop showing the loading sign
				$('.posts_area').html(data);
			}
		});

		$(window).scroll(function() {
			var height = $('.posts_area').height(); //Div containing posts
			var scroll_top = $(this).scrollTop();
			var page = $('.posts_area').find('.nextPage').val();
			var noMorePosts = $('.posts_area').find('.noMorePosts').val();

			if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
				$('#loading').show();

				var ajaxReq = $.ajax({
					url: "includes/handlers/ajax_load_posts.php",
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.posts_area').find('.nextPage').remove(); //removes current next page 
						$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage 
						//once data is loaded it will stop showing the loading sign
						$('#loading').hide();
						$('.posts_area').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>




        </div>
</body>
</html>
