<!-- PHP insert code start -->

<?php

// for password reset
if(isset($_POST['reset'])){
    // include database connection
    include 'database.php';
 
    try{
		// query to check if email exists
		$email=htmlspecialchars(strip_tags($_POST['email']));
		$query1 = "SELECT * FROM author WHERE email = ? LIMIT 0,1 ";
		$stmt1 = $con->prepare($query1);
		
		// this is the first question mark
		$stmt1->bindParam(1, $email);
		
		// execute our query
		$stmt1->execute();
		
		// store retrieved row to a variable
		$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
		
		// if email exists, assign values to object properties for easy access and use for php sessions
		if($row1 > 0){
			
			$query = "UPDATE author SET token=:token WHERE email = :email";
			
			// prepare query for execution
			$stmt = $con->prepare($query);
		
			// posted values and token generator
			$n = 20;
			$token = bin2hex(random_bytes($n));
			$email=htmlspecialchars(strip_tags($_POST['email']));
			
			// bind the parameters
			$stmt->bindParam(':token', $token);
			$stmt->bindParam(':email', $email);
			
			// send an email to user
			$from_name="MJTech Blog";
			$from_email="support@mjtech.com.ng";
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: {$from_name} <{$from_email}> \n";
			
			// send confimation email
			$send_to_email=$_POST['email'];
			$send_to_fullname=$row1['fullname'];
			
			//get user's IP
			if(!empty($_SERVER['HTTP_CLIENT_IP'])){
				//ip from share internet
				$user_ip = $_SERVER['HTTP_CLIENT_IP'];
			}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				//ip pass from proxy
				$user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
				$user_ip = $_SERVER['REMOTE_ADDR'];
			}
			
			$body = "Hi {$send_to_fullname}.<br /><br />
				<p> We have a request to update your account password from: IP: {$user_ip}. <br /><br />
				To confirm your new password changes, please copy & paste the following verification code 
				into the required form: </p> <br /> <strong>{$token}</strong>";
			$subject="Confirmation of password reset for your account on MJTech Blog";
			
			$user_id = $row1['user_id'];
			
			// execute the query
			if($stmt->execute()){
				echo '<script>alert("Please check your email for further instruction")</script>';
				//header('Location: authorize-changes.php?id=?id= + $user_id ');
				
				if(mail($send_to_email, $subject, $body, $headers)){
					//header('Location: authorize-changes.php?id= echo "{$c_id}";');
				}
				else{
					echo '<script>alert("An error occur while sending you a verification code to your email. 
					Please try again by filling the password reset form..")</script>'; 
				}
			}
			// if execute the query failed
			else {
				echo "<div class='alert alert-danger text-center py-4'>We're unable to reset your account, please try again.</div>";
			}
			
		}
		else {
			// return because email does not exists in the database
			echo '<script>alert("We cannot find anyone with this email, please check the spelling and try again.")</script>'; 
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
			<h3 class="blog-post-title text-center text-muted">Reset your password</h3>
			<hr>
                  <div class="form-row">
					  <!-- <div class="row col-md-12">  -->
                    
					<!-- Login form -->
					<div class="form-group col-md-4">
						
                    </div>
					
					<!-- Reset password form -->
					<div class="form-group col-md-4">
						<div class="card">
						  <div class="card-header">
							<strong>Reset Password Form</strong>
						  </div>
						<form action="<?php echo html_entity_decode($_SERVER["PHP_SELF"]);?>" method="post">
						  <div class="card-body">
							  <div class="form-group">
								<label for="exampleInputEmail1">
									Please enter your account's verified email address and we will send you a 
									password reset verification code.
								</label>
								<input type="email" value="
								<?php 
								if(isset($_SESSION["author_id"]) && isset($_SESSION["author_role"]) ){
									echo $_SESSION["author_email"];
								}
								
								?>" class="form-control" id="email" name="email" required>
							  
							  </div>
							  <input type="submit" name="reset" class="btn btn-outline-primary btn-block" value="Send password reset email">
						</form>
						
						<?php  
							if(isset($_SESSION["author_id"]) && isset($_SESSION["author_role"]) ){
								// do nothing
							}
							else {
								echo '
								<a href="get-started.php" class="btn my-2 btn-outline-primary btn-block text-center">Login to your account</a>
								<a href="register.php" class="btn my-2 btn-outline-primary btn-block text-center">Create a new account</a>
								';
							}
						?>
						
						
						  </div>
						</div>
                    </div>
					
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>