<!-- PHP insert code start -->

<?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('<h3 class="text-center py-4">ERROR: Post could not be found (ID related issue)!</h3>');
 
//include database connection
include 'database.php';
 
// read current record's data
try {
    // prepare select query
	$query = "SELECT post.id, post.title, post.image, author.user_id, author.fullname, categories.c_id, categories.name, 
		post.content, post.create_at, post.status, post.modified_at FROM post JOIN author ON author.user_id = post.author_id 
		JOIN categories ON categories.c_id = post.category_id WHERE id = ? LIMIT 0,1";
		
    // $query = "SELECT id, title, image, category_id, author_id, content, create_at, modified_at FROM post WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // preparing values for use
    $id = $row['id'];
    $title = $row['title'];
    $image = $row['image'];
    $category_id = $row['name'];
    $author_id = $row['fullname'];
    $content = $row['content'];
    $create_at = $row['create_at'];
    $modified_at = $row['modified_at'];
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>

<!-- PHP insert code end -->

<main role="main" class="container py-4">
  <div class="container card mb-12">
  
	<div class="row mb-2">
		<div class="col-md-12 blog-main py-4"> 
		  <div class="blog-post"><!-- /.blog-post -->
			<h2 class="blog-post-title"><?php echo html_entity_decode($title, ENT_QUOTES); ?></h2>
				<p class="blog-post-meta">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-watch" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M4 14.333v-1.86A5.985 5.985 0 0 1 2 8c0-1.777.772-3.374 2-4.472V1.667C4 .747 4.746 0 5.667 0h4.666C11.253 0 12 .746 12 1.667v1.86A5.985 5.985 0 0 1 14 8a5.985 5.985 0 0 1-2 4.472v1.861c0 .92-.746 1.667-1.667 1.667H5.667C4.747 16 4 15.254 4 14.333zM13 8A5 5 0 1 0 3 8a5 5 0 0 0 10 0z"/>
					  <path d="M13.918 8.993A.502.502 0 0 0 14.5 8.5v-1a.5.5 0 0 0-.582-.493 6.044 6.044 0 0 1 0 1.986z"/>
					  <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5H6a.5.5 0 0 1 0-1h1.5V5a.5.5 0 0 1 .5-.5z"/>
					</svg> <?php echo html_entity_decode($create_at, ENT_QUOTES); ?> 
					
					&nbsp;&nbsp;
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
					</svg>
					<a href="#"><?php echo html_entity_decode($author_id, ENT_QUOTES); 'in' ?></a>
					
					&nbsp;&nbsp;
					<em class="badge badge-secondary">
					<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tag" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M2 2v4.586l7 7L13.586 9l-7-7H2zM1 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2z"/>
						<path fill-rule="evenodd" d="M4.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
					</svg> 
					<a href="#" class="text-white"><?php echo html_entity_decode($category_id, ENT_QUOTES); 'Category.' ?></a>
					</em>
				</p>
			<hr>
			
			<div class="table-responsive-sm"><?php echo html_entity_decode($content, ENT_QUOTES); ?></div>
			<small class="card-text text-muted py-4">
              <?php if(html_entity_decode($modified_at, ENT_QUOTES) == "") echo ""; else echo "Last updated on: ". html_entity_decode($modified_at, ENT_QUOTES);  ?>
            </small>
		  </div><!-- /.blog-post --> 
		</div><!-- /.blog-main -->
	</div>
	
  </div>
</main>