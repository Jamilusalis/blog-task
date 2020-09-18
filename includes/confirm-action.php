<!-- Confirmation modal -->
<div class="modal fade" id="confirmAction" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	<form action="<?php echo html_entity_decode($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this post? This action cannot be undone and will be unable to recover.
		<input type="text" value="" name="id" id="post_id">
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
          <a type="button" class="btn btn-danger" name="delete_post" onclick="window.location = 'delete.php?id=' + id;">Yes, delete it!</a>
      </div>
	</form>  
    </div>
  </div>
</div>
<!-- Confirmation modal -->



<!-- Login Modal -->
<div class="modal fade" id="SignInModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<form method="POST" action="login.php">
		  <div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" id="password" name="password" required>
		  </div>
		  <div class="">
			<input type="submit" name="login" class="btn btn-outline-primary btn-block" value="Login">
		  </div>
		</form>
		
		<hr/>
		
		<div class="form-group text-muted">
			Forgot password? <a href ="#" data-toggle="modal" data-target="#PassResetModal" 
				data-dismiss="modal"> Reset </a>
			<span class="float-right">
				Don't have account?
				<a href="#" target="_blank" data-toggle="modal" data-target="#SignUpModal" 
				data-dismiss="modal"> Sign up </a> 
			</span>
		</div>
	  
      </div>
    </div>
  </div>
</div>

<!-- Sign up Modal -->
<div class="modal fade" id="SignUpModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Create your account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<form action="register.php" method="post">
		  <div class="form-group">
			<label for="examplealex">Full name</label>
			<input type="text" class="form-control" id="name" name="name" required>
		  </div>
		  <div class="form-group">
			<label for="exampleInputEmail1">Email address</label>
			<input type="email" class="form-control" id="email" name="email" required>
		  </div>
		  <div class="form-group">
			<label for="exampleInputPassword1">Password</label>
			<input type="password" class="form-control" id="password" name="password" required>
		  </div>
		  <div class="">
			<input type="submit" name="create" class="btn btn-outline-primary btn-block" value="Create account">
		  </div>
		</form>
		
		<hr/>
		
		<div class="form-group text-muted">
			Have an existing account?
			<a href="#" class="text-center" data-toggle="modal" data-target="#SignInModal" data-dismiss="modal"> 
				Sign in
			</a>
		</div>
		
      </div>
    </div>
  </div>
</div>


<!-- Reset Password Modal -->
<div class="modal fade" id="PassResetModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Find your account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<form>
		  <div class="form-group">
			<label for="exampleInputEmail1">
				Please enter your account's verified email address and we will send you a password reset link.
			</label>
			<input type="email" class="form-control" id="username" name="username" required>
		  </div>
		  <div class="">
			<input type="submit" name="create" class="btn btn-outline-primary btn-block" value="Send password reset email">
		  </div>
		</form>
		
		<hr/>
		
		<div class="form-group text-muted">
			Remeber your password?
			<a href="#" class="text-center" data-toggle="modal" data-target="#SignInModal" data-dismiss="modal"> 
				Sign in
			</a>
		</div>
		
      </div>
    </div>
  </div>
</div>