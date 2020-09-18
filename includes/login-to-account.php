<!-- PHP insert code start -->

<?php

if(isset($_POST['login'])){
    include 'database.php';
 
    try{
		// query to check if email exists
		$email=htmlspecialchars(strip_tags($_POST['email']));
		$password = md5($_POST['password']);
		
		$query = "SELECT * FROM author WHERE email = '".$email."' AND password = '".$password."' LIMIT 0,1 ";
		$stmt = $con->prepare($query);
		$stmt->execute();
		
		// if user match, assign values to sessions
		if($stmt->execute()){
		  // store retrieved row to a variable
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row > 0){
				extract($row);
				// assign values to object properties
				$_SESSION['author_id'] = $row['user_id'];
				$_SESSION['author_name'] = $row['fullname'];
				$_SESSION['author_email'] = $row['email'];
				$_SESSION['author_role'] = $row['role'];
				
				echo '<script>alert("Login successful")</script>';
				header("Location: ./index.php");
			}
			else {
				echo '<script>alert("You have entered an incorrect email or password, please check and try.")</script>'; 	
			}
		}
		else {
			echo '<script>alert("Unable to process your request, please try again.")</script>'; 	
		}
	}
	
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}

?>

<!-- PHP insert code end -->

<main role="main" class="container py-4">
  <div class="container card mb-12">
  
	<div class="row mb-2">
		<div class="col-md-12 blog-main py-4"> 
		  <div class="blog-post"><!-- /.blog-post -->
			<h3 class="blog-post-title text-center text-muted">Login to write a post</h3>
			<hr>
			
                      <div class="form-row">
					  <!-- <div class="row col-md-12">  -->
                    
					<!-- Login form -->
					<div class="form-group col-md-4">
						
                    </div>
					
					<!-- Login form -->
					<div class="form-group col-md-4">
						<div class="card">
						  <div class="card-header ">
							<strong>Login form</strong>
						  </div>
						<form action="<?php echo html_entity_decode($_SERVER["PHP_SELF"]);?>" method="post">
						  <div class="card-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="password" name="password" required>
								<small><a href="reset-password.php">Forgot password?</a></small>
							</div>
							<input type="submit" name="login" class="btn btn-outline-primary btn-block" value="Login">
						</form>
						
						<a href="register.php" class="btn my-2 btn-outline-primary btn-block text-center">Create new account</a>
						 </div>
						</div>
						
                    </div>
					
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>