<!-- PHP insert code start -->

<?php
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('<h3 class="text-center py-4">ERROR: cannot found user account!</h3>');

// read current record's data
try {
	include 'database.php';
	
    // prepare select query
    $query2 = "SELECT email, password, token FROM author WHERE user_id = ? LIMIT 0,1";
    $stmt2 = $con->prepare($query2);

    // this is the first question mark
    $stmt2->bindParam(1, $id);
 
    // execute our query
    $stmt2->execute();
 
    // store retrieved row to a variable
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    // preparing values for use
    $email = $row['email'];
	$GLOBALS['token'] = $token = $row['token']; 
	
	if ($email == "") {
		//header('Location: get-started.php');
	}
}
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

// for password reset
if(isset($_POST['change_password'])){
    // include database connection
    include 'database.php';
 
    try {
		$email = htmlspecialchars(strip_tags($_POST['email']));
		
		// query to check if email exists
		$query = "SELECT * FROM author WHERE email = ? LIMIT 0,1";
		$stmt = $con->prepare($query);
		
		// this is the first question mark
		$stmt->bindParam(1, $email);
		
		// execute our query
		$stmt->execute();
		
		// store retrieved row to a variable
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		// preparing values for use
		$user_token = $row['token']; 
		$input_token=$_POST['token'];
		
		if ($user_token == $input_token ) {
			
			$query = "UPDATE author SET password=:password, token=:token, updated_at=:updated_at WHERE email = :email";
 
			// prepare query for execution
			$stmt = $con->prepare($query);
			
			$password = md5($_POST['password']);
			$token = ""; //set token to empty
			date_default_timezone_set("Africa/Lagos");
			$updated_at=date('Y-m-d H:i:s');
			
			// bind the parameters
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':token', $token);
			$stmt->bindParam(':updated_at', $updated_at);
			$stmt->bindParam(':email', $email);
			
			 // execute the query
			if($stmt->execute()){
				echo '<script>alert("Password was reset successfully")</script>'; 
				//header('Location: category.php');
			} else {
				echo "<div class='alert alert-danger text-center py-4'>Unable to reset password.</div>";
			}   
		
		} else {
			echo '<script>alert("Invalid verification code, please try again")</script>';
		}
	
    } // end of try
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
			<h3 class="blog-post-title text-center text-muted">Authorize password changes</h3>
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
							<strong>Password change Form</strong>
						  </div>
						<form action="<?php echo html_entity_decode($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
						  <div class="card-body">
							  <div class="form-group">
								<label for="exampleInputEmail1">Email address</label> <br/>
								<input type="text" class="form-control" id="email" name="email" readonly value="<?php echo html_entity_decode($email, ENT_QUOTES);  ?>" required>
							  </div>
							  <div class="form-group">
								<label for="examplealex">Verification code</label>
								<input type="text" class="form-control" id="token" name="token" placeholder="Check your email for verification code" required>
								<small><a href="reset-password.php">Resent verification code?</a></small>
							  </div>
							  <div class="form-group">
								<label for="exampleInputPassword1">New password</label>
								<input type="password" class="form-control" id="password" name="password" required placeholder="Please type in new password">
							  </div>
							  <input type="submit" name="change_password" class="btn btn-outline-primary btn-block" value="Change password">
						  </div>
						</form>
						</div>
					</div>
					
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>