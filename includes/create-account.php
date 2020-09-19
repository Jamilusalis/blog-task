<!-- PHP insert code start -->

<?php

if(isset($_POST['create'])){
    // include database connection
    include 'database.php';
 
    try{
		// query to check if email exists
		$email=htmlspecialchars(strip_tags($_POST['email']));
		
		$query1 = "SELECT email FROM author WHERE email = ? LIMIT 0,1 ";
		
		$stmt1 = $con->prepare($query1);
 
		// this is the first question mark
		$stmt1->bindParam(1, $email);
	 
		// execute our query
		$stmt1->execute();
	 
		// store retrieved row to a variable
		$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
	 
		// if email exists, assign values to object properties for easy access and use for php sessions
		if($row1 > 0){
			// return true because email exists in the database
			echo '<script>alert("The email you specified is already registered with another account.")</script>'; 
		}
		else {
			
			// insert query 
			$query = "INSERT INTO author SET fullname=:fullname, email=:email, password=:password";
			
			// prepare query for execution
			$stmt = $con->prepare($query);
			
			// posted values
			$fullname=htmlspecialchars(strip_tags($_POST['fullname']));
			$email=htmlspecialchars(strip_tags($_POST['email']));
			
			$password = md5($_POST['password']);
			
			// bind the parameters
			$stmt->bindParam(':fullname', $fullname);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
         
			// execute the query
			if($stmt->execute()){
				echo '<script>alert("Account created successful, you may proceed to login")</script>'; 
				header('refresh:1;get-started.php');
				
			} else {
				echo "<div class='alert alert-danger text-center py-4'>Unable to create user account.</div>";
			}	
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
			<h3 class="blog-post-title text-center text-muted">Create a new account</h3>
			<hr>
			
                      <div class="form-row">
					  <!-- <div class="row col-md-12">  -->
                    
					<!-- Login form -->
					<div class="form-group col-md-4">
						
                    </div>
					
					<!-- Sign up form -->
					<div class="form-group col-md-4">
						 <div class="card">
						  <div class="card-header">
							<strong>Registration form</strong>
						  </div>
						<form action="<?php echo html_entity_decode($_SERVER["PHP_SELF"]);?>" method="post">
						  <div class="card-body">
							  <div class="form-group">
								<label for="examplealex">Fullname</label>
								<input type="text" class="form-control" id="fullname" name="fullname" required>
							  </div>
							  <div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" class="form-control" id="email" name="email" required>
							  </div>
							  <div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="password" name="password" required>
							  </div>
							  <input type="submit" name="create" class="btn btn-outline-primary btn-block" value="Create account">
						</form>	
							
					<a href="get-started.php" class="btn my-2 btn-outline-primary btn-block text-center">Login to your account</a>
							
						 </div>
						</div>
					</div>
					
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>