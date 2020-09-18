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
			echo '
				<div class="alert alert-danger text-center" role="alert">
					You have already registered and login! You may <a href="logout.php"><strong>logout</strong></a> if you wish to.
				</div>';
		}
		else {
			include('includes/create-account.php');
		}
	?>
	
    <!-- include confirmation modal file -->
    <?php include('includes/confirm-action.php') ?>
	
    <!-- include foot file -->
    <?php include('includes/foot.php') ?>
	
  </body>
</html>