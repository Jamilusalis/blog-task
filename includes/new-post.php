<!-- PHP insert code start -->

<?php
if($_POST){
    // include database connection
    include 'database.php';
 
    try{
        // insert query 
        // post_image=:post_image   -> to be inserted too
        $query = "INSERT INTO post SET title=:title, image=:image, category_id=:category_id, author_id=:author_id, content=:content";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $title=htmlspecialchars(strip_tags($_POST['title']));
		
		$image=!empty($_FILES["image"]["name"]) ? rand(10000,100000000) . "-" . basename($_FILES["image"]["name"]) : "";
        $image=htmlspecialchars(strip_tags($image)); 
		
		// if image is not empty, try to upload the image
		if($image){
			$target_directory = "uploads/"; $target_file = $target_directory . $image;
			// error message is empty
			$file_upload_error_messages="";
			if(empty($file_upload_error_messages)){
				if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
					// do nothing since image is moved successfully
				}
				else{
					echo "<div class='alert alert-danger'> <div>Unable to upload image. Please consider updating 
					your post to re-upload image</div> </div>";
				}
			}
			// if $file_upload_error_messages is NOT empty
			else{
				echo "<div class='alert alert-danger'>"; echo "<div>{$file_upload_error_messages}</div>";
				echo "<div>Unable to upload image. Please consider updating your post to re-upload image</div>"; echo "</div>";
			}
		} // end of if image is not empty
		
		
        $category_id=htmlspecialchars(strip_tags($_POST['category_id']));
        $author_id=$_SESSION["author_id"];
        $content=html_entity_decode($_POST['content']);
		
        // bind the parameters
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':content', $content);
         
        // execute the query
        if($stmt->execute()){
			echo '<script>alert("Record was saved successfully")</script>'; 
			header("refresh:1;all-posts.php");
			
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
			<h2 class="blog-post-title text-center text-muted text-capitalize">Create new post</h2>
			<hr>
			
			<form id="newPost" action="<?php echo html_entity_decode($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                      <input type="hidden" class="form-control" name="author_id" value="99" required>
					  <!-- <div class="row col-md-12">  -->
                        <div class="form-group col-md-7">
							<label for="">Title</label>
                          <input type="text" class="form-control" name="title" placeholder="Please enter title" required>
                        </div>
						
						<div class="form-group col-md-5">
						  <label for="">Category</label>
						  <select class="custom-select" name="category_id" aria-label="Example select with button addon" required>
							<option></option>
							<?php 
								require "database.php";// database connection
								$sql="SELECT * FROM categories"; 

								foreach ($con->query($sql) as $row) {
								?>
									<option value="<?php echo $row['c_id']; ?>"><?php echo $row['name']; ?></option>
								<?php
								}
							?>
						  </select>
						</div>
                      
                        <div class="form-group col-md-6">
							<label for="">Featured image</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="post_image" name="image" accept="image/*">
                              <label class="custom-file-label form-control" for="inputGroupFile01">Choose featured image</label>
                            </div>
                          </div>
                        </div>

                          <div class="form-group col-md-2 rounded text-center">
                            <img src="uploads/nophoto.jpg" id="show_image" style="height:70px;">
                          </div>
                        
                          <div class="form-group col-md-12">
                            <label for="basic-url">Content</label>
							<textarea class="form-control" id="content" name="content" rows="8" cols="100" required></textarea>
                          </div>
                          
                          <div class="form-group col-md-8">
							<input type='submit' value='Publish' class='btn btn-outline-primary btn-md col-md-5' />
                          </div>
            </form>
					
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>