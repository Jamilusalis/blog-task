<!-- PHP update code start -->
<?php 
	// isset() is a PHP function used to verify if a value is there or not
	$id=isset($_GET['id']) ? $_GET['id'] : die('<h3 class="text-center py-4">ERROR: Post could not be found (ID related issue)!</h3>');
	
	//include database connection
	include 'database.php';
	
?>

<?php

// check if form was submitted
if($_POST){

	try{
	
		// in this case, it seemed like we have so many fields to pass and 
		// it is better to label them and not use question marks
		$query = "UPDATE post 
					SET title=:title, category_id=:category_id, content=:content, modified_at=:modified_at 
					WHERE id = :id";

		// prepare query for excecution
		$stmt = $con->prepare($query);

		// posted values
		$title=htmlspecialchars(strip_tags($_POST['title']));
		$category_id=htmlspecialchars(strip_tags($_POST['category_id']));
		date_default_timezone_set("Africa/Lagos");
		$modified_at=date('Y-m-d H:i:s');
		
		//$image=!empty($_FILES["image"]["name"])
		//		? sha1_file($_FILES['image']['tmp_name']) . "-" . basename($_FILES["image"]["name"])
		//		: "";
        // $image=htmlspecialchars(strip_tags($image));
		$content=html_entity_decode($_POST['content']);

		// bind the parameters
		$stmt->bindParam(':title', $title);
		$stmt->bindParam(':category_id', $category_id);
		// $stmt->bindParam(':image', $image);
		$stmt->bindParam(':content', $content);
		$stmt->bindParam(':modified_at', $modified_at);
		$stmt->bindParam(':id', $id);
		
		// Execute the query
		if($stmt->execute()){
			echo '<script>alert("Record was updated successfully")</script>'; 
			
		/*	// now, if image is not empty, try to upload the image
			if($image){

				// sha1_file() function is used to make a unique file name
				$target_directory = "uploads/";
				$target_file = $target_directory . $image;
				$file_type = pathinfo($target_file, PATHINFO_EXTENSION);

				// error message is empty
				$file_upload_error_messages="";
				// make sure that file is a real image
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check!==false){
					// submitted file is an image
				}else{
					$file_upload_error_messages.="<div>Submitted file is not an image.</div>";
				}
				
				// make sure submitted file is not too large, can't be larger than 5 MB
				if($_FILES['image']['size'] > (5120000)){
					$file_upload_error_messages.="<div>Image must be less than 5 MB in size.</div>";
				}
				
				// if $file_upload_error_messages is still empty
				if(empty($file_upload_error_messages)){
					// it means there are no errors, so try to upload the file
					if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
						
					}
					else{
						echo "<div class='alert alert-danger'>";
							echo "<div>Unable to upload photo.</div>";
						echo "</div>";
					}
				}

				// if $file_upload_error_messages is NOT empty
				else{
					// it means there are some errors, so show them to user
					echo "<div class='alert alert-danger'>";
						echo "<div>{$file_upload_error_messages}</div>";
					echo "</div>";
				}
			}
			*/
			
		}else{
			echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
		}	
	}
	// show errors
	catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
} 

?>


<?php

// read current record's data
try {
    // prepare select query
    $query = "SELECT id, title, image, category_id, author_id, content FROM post WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare($query);

    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

     // preparing values for use
	 $GLOBALS['id'] = $row['id'];
     $title = $row['title'];
     $image = $row['image'];
     $category_id = $row['category_id'];
     $author_id = $row['author_id'];
     $content = $row['content'];
	 
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>
<!-- PHP update code start -->

<main role="main" class="container py-4">
  <div class="container card mb-12">
  
	<div class="row mb-2">
		<div class="col-md-12 blog-main py-4"> 
		  <div class="blog-post"><!-- /.blog-post -->
			<h2 class="blog-post-title text-center text-muted text-capitalize">Update post</h2>
			<hr>
			
			<form action="<?php echo html_entity_decode($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post" enctype="multipart/form-data">
                      <div class="form-row">
                      <input type="hidden" class="form-control" name="author_id" value="99" required>
					  <!-- <div class="row col-md-12">  -->
                        <div class="form-group col-md-7">
							<label for="">Title</label>
                          <input type="text" class="form-control" name="title" placeholder="Please enter title" value="<?php echo htmlspecialchars($title, ENT_QUOTES);  ?>" required>
                        </div>
						
						<div class="form-group col-md-5">
						  <label for="">Category</label>
						 <select class="custom-select" name="category_id" aria-label="Example select with button addon" required>
								<option value="<?php // echo htmlspecialchars($category_id, ENT_QUOTES);  ?>">
									<?php // echo htmlspecialchars($category_id, ENT_QUOTES);  ?>
								</option> 
								
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
                            <div class="custom-file" id="for_img">
                              <input type="file" class="custom-file-input" id="post_image" name="image" accept="image/*">
                              <label class="custom-file-label form-control" for="inputGroupFile01">Choose featured image</label>
                            </div>
                          </div>
                        </div>

                          <div class="form-group col-md-2 rounded text-center">
                            <img src="uploads/<?php if("{$image}" == "") echo "nophoto.jpg"; else echo "{$image}"; ?>" id="show_image" style="height:70px;">
                          </div>
                        
                          <div class="form-group col-md-12">
                            <label for="basic-url">Content</label>
							<textarea class="form-control" id="content" name="content" rows="8" cols="100" required><?php echo html_entity_decode($content, ENT_QUOTES);  ?></textarea>
                          </div>
                          
                          <div class="form-group col-md-8">
							<button type='button' onclick='window.location = "all-post.php"' class='btn btn-outline-danger btn-md col-md-3'>Cancel </button>
							&nbsp;&nbsp;&nbsp;
							<input type='submit' value='Update' class='btn btn-outline-primary btn-md col-md-5' />
                          </div>
            </form>
					
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>

<script>
	document.getElementById('for_img').style.visibility="visible";
</script>