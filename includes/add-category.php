<!-- PHP insert code start -->

<?php
	// include database connection
	include 'database.php';
	 
	// delete message prompt will be here
	 
	// select all data
	$query = "SELECT categories.c_id, categories.name, categories.status, categories.created_at, 
		categories.updated_at, categories.admin_id, author.user_id, author.fullname FROM categories
        JOIN author ON author.user_id = categories.admin_id WHERE status = 0 ORDER BY name ASC";
	$stmt = $con->prepare($query);
	$stmt->execute();
	 
	// this is how to get number of rows returned
	$num = $stmt->rowCount();
?>

<?php
if(isset($_POST['save'])){
    // include database connection
    include 'database.php';
 
    try{
        // insert query 
        $query1 = "INSERT INTO categories SET name=:name, admin_id=:admin_id";
 
        // prepare query for execution
        $stmt1 = $con->prepare($query1);
	
        $name=htmlspecialchars(strip_tags($_POST['name']));
		$admin_id = $_SESSION["author_id"];
        
        // bind the parameters
        $stmt1->bindParam(':name', $name);
		$stmt1->bindParam(':admin_id', $admin_id);
         
        // execute the query
        if($stmt1->execute()){
			echo '<script>alert("Record was saved successfully")</script>'; 
			header('refresh:0;category.php');
        } else {
            echo "<div class='alert alert-danger text-center py-4'>Unable to save record.</div>";
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
			<h2 class="blog-post-title text-center text-muted">Manage Category</h2>
			<hr>
		<form action="<?php echo html_entity_decode($_SERVER["PHP_SELF"]);?>" method="post">
		<div class="form-row">	
			<div class="form-group col-md-4">
				<label for="">Category name</label>
                <input type="text" class="form-control" name="name" placeholder="Please enter category name" required>
				<br>
				<input type='submit' value='Create category' name="save" class='py-2 btn btn-outline-primary btn-md col-md-5' /> 
            </div>
		</form>	
			<div class="form-group col-md-8 py-4">
			<div class="table-responsive-sm">
			  <table class="table table-sm table-hover table-bordered">
				<caption>List of categories</caption>
				  <thead>
					<tr class="">
					  <th>Category name</th>
					  <th>Added by</th>
					  <th>Last modify</th>
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
					  <td><?php echo "{$name}"; ?></td>
					  <td><?php echo "{$fullname}"; ?></td>
					  <td><?php if("{$updated_at}" == "") echo "N/A"; else echo "{$updated_at}"; ?></td>
					  <td>
					  
						<a type="button" class="btn btn-outline-secondary btn-sm" 
						href="edit-category.php?id=<?php echo "{$c_id}"; ?>">
							<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
							  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
							</svg>
						</a>
						
						<a type="button" class="btn btn-outline-danger btn-sm"
						onclick="delete_category(<?php echo "{$c_id}"; ?>);">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
						  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
						</svg>
						</a>
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
			</div>
			
		</div>
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>