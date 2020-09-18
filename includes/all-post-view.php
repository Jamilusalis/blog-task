<!-- PHP insert code start -->

<?php
	// include database connection
	include 'database.php';
	 
	$author_id = $_SESSION["author_id"];
	 
	// select all data
	$query = "SELECT post.id, post.title, post.image, author.user_id, author.fullname, categories.c_id, categories.name, 
			post.content, post.create_at, post.status, post.modified_at FROM post JOIN author ON author.user_id = post.author_id 
			JOIN categories ON categories.c_id = post.category_id  WHERE user_id = $author_id ORDER BY `post`.`modified_at`  DESC
				";
	
	//$query = "SELECT id, title, image, category_id, author_id, content, create_at, status, modified_at FROM post 
	//ORDER BY create_at DESC, modified_at DESC";
	
	$stmt = $con->prepare($query);
	$stmt->execute();
	 
	// this is how to get number of rows returned
	$num = $stmt->rowCount();

?>


<!-- PHP insert code end -->

<main role="main" class="container py-4">
  <div class="container card mb-12">
  
	<div class="row mb-2">
		<div class="col-md-12 blog-main py-4"> 
		  <div class="blog-post"><!-- /.blog-post -->
			<h2 class="blog-post-title text-center text-muted">Manage Your Post</h2>
			<hr>

			<div class="table-responsive-sm">
			  <table class="table table-sm table-hover table-bordered">
				  <thead>
					<tr class="">
					  <th>Title</th>
					  <th>Category</th>
					  <th>Author</th>
					  <th>Last Modified</th>
					  <th></th>
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
					  <td><?php echo "{$title}"; ?></td>
					  <td><?php echo "{$name}"; ?></td>
					  <td><?php echo "{$fullname}"; ?></td>
					  <td><?php if("{$modified_at}" == "") echo "N/A"; else echo "{$modified_at}"; ?></td>
					  <td>
						
						<a type="button" class="btn btn-outline-primary btn-sm"
						href='view.php?id=<?php echo "{$id}"; ?>'>
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z"/>
						  <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
						</svg>
						</a>
						
						<a type="button" class="btn btn-outline-secondary btn-sm" href="edit-post.php?id=<?php echo "{$id}"; ?>">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
							  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
						</a>
						
						<button type="button" class="btn btn-outline-danger btn-sm"
						onclick='delete_post(<?php echo "{$id}"; ?>);'>
						<svg onclick='delete_post({$id});' width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						</svg>
						</button>
					  </td>
					</tr>
						<?php	
						}
						
						else {
							echo '
						<tr>
						  <td colspan="4">No records found</td>
						</tr>';
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