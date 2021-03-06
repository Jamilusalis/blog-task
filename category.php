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
			
			if($_SESSION['author_role'] == 1 ){
				// <!-- include all post by user file -->
				include('includes/add-category.php');
			}
			else {
				echo '
					<div class="alert alert-danger text-center" role="alert">
					  Sorry but only administrators are authorized to view this page!
					</div>';
			}
		}
		else {
			echo '
			<div class="alert alert-danger text-center" role="alert">
			  You are not authorized to view this page!
			</div>
			';
		}
	?>
	
    <!-- include confirmation modal file -->
    <?php include('includes/confirm-action.php') ?>

    <!-- include foot file -->
    <?php include('includes/foot.php') ?>
  </body>
</html>