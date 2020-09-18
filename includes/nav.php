<?php 
	// Start the session
	session_start();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark ">
      <a class="navbar-brand" href="index.php">MJTech Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" 
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
 
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
		
		<?php
			if(isset($_SESSION["author_id"]) && isset($_SESSION["author_role"]) ){	
				//echo "User found";
				echo '
					<li class="nav-item">
					  <a class="nav-link" href="add-post.php">New Post</a>
					</li>
					
					<li class="nav-item">
					  <a class="nav-link" href="all-posts.php">Manage Post</a>
					</li>
					';
				
				// if role is = 1 'admin', redirect to nav and show admin nav
				if($_SESSION['author_role'] == 1 ){
					// echo "I am admin";
					echo '
						<li class="nav-item">
						 <a class="nav-link" href="category.php">Manage Category </a>
						</li>
						
						<li class="nav-item">
						 <a class="nav-link" href="list-users.php">Manage Users</a>
						</li>
						';
				}	
				if($_SESSION['author_role'] == 0 ){
					// echo "I am an author";
					echo '
					

					';
					
					//echo $_SESSION["author_name"];
					//echo $_SESSION["author_email"];
				}	
			} // end checking of session
		?>
        </ul>
		  
		<?php  
			if(isset($_SESSION["author_id"]) && isset($_SESSION["author_role"]) ){
				echo '<form class="form-inline my-2 my-lg-0">
					<a type="button" href="logout.php" class="btn btn-outline-danger btn-sm text-white">Logout</a>
				</form>';
			}
			else {
				// echo "user not found";
				echo '
				<form class="form-inline my-2 my-lg-0">
					<a type="button" class="btn btn-outline-primary btn-sm text-white" href="get-started.php">Write a post</a>
				</form>
				';
				
			} //end of else statement
		?>
      </div>
</nav>
