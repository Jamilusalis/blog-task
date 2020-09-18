<?php
// include database connection
include 'database.php';

try {
	
	// get record ID
	// isset() is a PHP function used to verify if a value is there or not
	$id=isset($_GET['id']) ? $_GET['id'] : die('<h3 class="text-center py-4">ERROR: Post could not be found (ID related issue)!</h3>');
	
	/*
	$defaul_id = "1"; //uncategoried ID
	$query1 = "UPDATE post SET category_id=:category_id WHERE category_id = ?";
    $stmt1 = $con->prepare($query1);
	
	$defaul_id = "1"; //uncategoried ID
	$stmt1->bindParam(':category_id', $defaul_id);
    $stmt1->bindParam(':category_id', $id);
	
	if($stmt1->execute()){
	*/
	// delete query
	$query = "DELETE FROM categories WHERE c_id = ?";
	$stmt = $con->prepare($query);
	$stmt->bindParam(1, $id);
		
	if($stmt->execute()){
		// tell the user record was deleted and redirect the user
		echo '<script>alert("Deleted successfully")</script>'; 
		header('Location: category.php');
	}
	
	else {
		die('Unable to delete record.');
	}
}

// show error
catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
}
?>