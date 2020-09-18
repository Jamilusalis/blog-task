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
		if(isset($_SESSION["author_id"]) && isset($_SESSION["author_role"]) ){
			header('Location: add-post.php');
		}
		else {
			include('includes/login-to-account.php');
		}
	?>
	
    <!-- include confirmation modal file -->
    <?php include('includes/confirm-action.php') ?>
	
    <!-- include foot file -->
    <?php include('includes/foot.php') ?>
	
  </body>
</html>