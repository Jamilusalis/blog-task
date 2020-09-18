<!-- PHP insert code start -->

<?php
	// include database connection
	include 'database.php';
	
	// select all data
	$query = "SELECT * from author ORDER BY fullname ASC";
	
	$stmt = $con->prepare($query);
	$stmt->execute();
	 
	// this is how to get number of rows returned
	$num = $stmt->rowCount();
	
	
	/*
	// store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

     // preparing values for use
     $author_id = $row['author_id'];
	
	SELECT count(*) as total_record FROM post WHERE author_id = 15
	
	// select all data
	$query1 = "select count(*) from post as total_post where author_id = $author_id";
	
	$stmt1 = $con->prepare($query1);
	$stmt1->execute();
	 
	// store retrieved row to a variable
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

     // preparing values for use
     $author_id = $row['author_id'];
     $total_post = $row['total_post']; */
	
?>


<!-- PHP insert code end -->

<main role="main" class="container py-4">
  <div class="container card mb-12">
  
	<div class="row mb-2">
		<div class="col-md-12 blog-main py-4"> 
		  <div class="blog-post"><!-- /.blog-post -->
			<h2 class="blog-post-title text-center text-muted">List of User</h2>
			<hr>

			<div class="table-responsive-sm">
			  <table class="table table-sm table-hover table-bordered">
				  <thead>
					<tr class="">
					  <th>Name</th>
					  <th>Email</th>
					  <th>Create on</th>
					  <th>Role</th>
					 <!-- <th>Post</th>
					  <th>Category</th> -->
					</tr>
				  </thead>
				  <tbody>
			<!-- php fetch data start -->  
					<?php
					// fetch() is faster than fetchAll()
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
						// extract row
						extract($row);	
					?>
						<?php 
						  if($num > 0){
							  // data from database will be here 
							  
						  ?>
					<tr>
					  <td><?php echo "{$fullname}"; ?></td>
					  <td><?php echo "{$email}"; ?></td>
					  <td><?php echo "{$created_at}"; ?></td>
					  <td><?php if("{$role}" == 1) echo "Admin"; else echo "Authur"; ?></td>
					 <!-- 
					  <td>  </td>
					  <td></td>
					  -->
					</tr>
						<?php
						}
						
						}
					?>
			<!-- php fetch data end -->
				  </tbody>
				</table>
			</div>
			

		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>