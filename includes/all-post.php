<!-- PHP insert code start -->

<?php
// include database connection
include 'database.php';
 
// delete message prompt will be here
 
// select all data
$query = "SELECT post.id, post.title, post.image, author.user_id, author.fullname, categories.c_id, categories.name, 
		post.content, post.create_at, post.status, post.modified_at FROM post JOIN author ON author.user_id = post.author_id 
		JOIN categories ON categories.c_id = post.category_id ORDER BY create_at ASC
		";
			
//$query = "SELECT id, title, image, category_id, author_id, content, create_at, modified_at FROM post ORDER BY create_at DESC, modified_at DESC";
$stmt = $con->prepare($query);
$stmt->execute();
 
// this is how to get number of rows returned
$num = $stmt->rowCount();
 
//check if more than 0 record found
if($num>0){
    // data from database will be here   
}
 
// if no records found
else{
	
	if(isset($_SESSION["author_id"]) && isset($_SESSION["author_role"]) ){
		// do nothing
	}
	else {
		echo '<div class="alert alert-danger text-center"> Looks like there is nothing fun here, 
	maybe you should <a href="get-started.php" class="alert-link text-success">login and add a new post</a> 
	and see something awesome.</div>';
	}
	 
}

?>

<!-- PHP insert code start -->

<main role="main" class="container py-4">
    <div class="container mb-12">
		<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
			<div class="col-md-12 px-0">
			<h4 class="display-12 text-center ">Explore thousands of content </h4> <br>
			  
			<form class="form col-md-12 text-center">
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<span class="input-group-text bg-dark text-white" id="basic-addon1">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
						  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
						</svg>
					</span>
				  </div>
				  <input type="text" class="form-control bg-dark text-white" placeholder="Type any keyword to search...">
				</div>
			  <button class="btn btn-outline-primary text-white" type="submit">Search...</button>
			</form>
			
			</div>
		</div>
	
		<div class="row mb-2">

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
		<!-- start of single post -->
			<div class="col-md-6">
			  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-180 position-relative">
				<div class="col-auto d-none d-lg-block">
				  <img src="uploads/<?php if("{$image}" == "") echo "nophoto.jpg"; else echo "{$image}"; ?>" width="220" height="185">
				</div>
				
				<div class="col p-3 d-flex flex-column position-static">
				  <div class="mb-1 text-muted">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-watch" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M4 14.333v-1.86A5.985 5.985 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86A5.985 5.985 0 0 1 14 8a5.985 5.985 0 0 1-2 4.472v1.861c0 .92-.746 1.667-1.667 1.667H5.667C4.747 16 4 15.254 4 14.333zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0z"/>
					  <path d="M13.918 8.993A.502.502 0 0 0 14.5 8.5v-1a.5.5 0 0 0-.582-.493 6.044 6.044 0 0 1 0 1.986z"/>
					  <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5H6a.5.5 0 0 1 0-1h1.5V5a.5.5 0 0 1 .5-.5z"/>
					</svg> <?php echo "{$create_at}"; ?>
					
					<span class="d-inline-block mb-2 text-primary float-right">
						<em class="badge badge-secondary"> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M2 2v4.586l7 7L13.586 9l-7-7H2zM1 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2z"/>
						  <path fill-rule="evenodd" d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
						</svg> <?php echo "{$name}"; ?> </em>
					</span>
				  </div>
				  <h5 class="mb-1"><?php echo "{$title}"; ?></h5>
				  <a href="view.php?id=<?php echo "{$id}"; ?>" class="stretched-link">Read more...</a>
				</div>
			  </div>
			</div> 
		<!-- end of single post -->
    <?php	
	}
	
	else 
		echo '
		<div class="alert alert-danger text-center"> Looks like there is nothing fun here, maybe you should 
		<a href="add.php" class="alert-link text-success">add a new post</a> and see something awesome.</div>' ;
  }
?>
<!-- php fetch data end -->
		</div>

	</div>
</main>