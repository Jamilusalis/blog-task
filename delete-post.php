<?php
// include database connection
include 'includes/database.php';

try {
	
	// get record ID
	// isset() is a PHP function used to verify if a value is there or not
	$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

	// delete query
	$query = "DELETE FROM post WHERE id = ?";
	$stmt = $con->prepare($query);
	$stmt->bindParam(1, $id);
	
	if($stmt->execute()){
		// tell the user record was deleted and redirect the user
		echo '<script>alert("Deleted successfully")</script>'; 
		header('refresh:0;all-posts.php');
	}else{
		die('Unable to delete record.');
	}
}

// show error
catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
}
?>