    <?php
    include("includes/header.php");
    ?>
        <!-- Making this page to redict a user to profile page when he searches a user name in http bar -->
            <div class="profile-container"> <!--adding a new selector to style the box-->
                <h4>This is a temporary profile page!</h4>

                <div class="user-details-container">
                <a href="<?php echo $userLoggedIn; ?>">  <img src="<?php echo $user['profile_pic']; ?>"> </a>
                <div class="user-details">
                    <a href="<?php echo $userLoggedIn; ?>"><?php echo $user['first_name'] . " " . $user['last_name']; ?></a>
                    <br>
                    <?php echo "Posts: " . $user['num_posts']. "<br>"; 
                        echo "Likes: " . $user['num_likes'];
                    ?>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>