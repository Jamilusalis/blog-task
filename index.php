<!doctype html>
<html lang="en">
  <head>
    <!-- include head file -->
    <?php include('includes/head.php') ?>
  </head>
  <body>
  	<!-- include nav-menu file -->
    <?php include('includes/nav.php') ?>
	
	<?php 
		
	?>
	
    <!-- include post file -->
    <?php 
		
		if(isset($_SESSION["author_id"]) && isset($_SESSION["author_role"]) ){
			echo '
				<div class="alert alert-info text-center" role="alert">
					Welcome '; echo $_SESSION["author_name"]; echo ' You can now 
					<a href="add-post.php"><strong>create a post</strong></a>.
				</div>';
		}
	
		include('includes/all-post.php') 
	?>

    <!-- include confirmation modal file -->
    <?php include('includes/confirm-action.php') ?>

    <!-- include foot file -->
    <?php include('includes/foot.php') ?>
  </body>
</html>