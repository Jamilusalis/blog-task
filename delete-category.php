<?php
// include database connection
include 'includes/database.php';

try {
	
	// get record ID
	// isset() is a PHP function used to verify if a value is there or not
	$id=isset($_GET['id']) ? $_GET['id'] : die('<h3 class="text-center py-4">ERROR: Post could not be found (ID related issue)!</h3>');
	
	//$defaul_id = "1"; //uncategoried ID
	
	$query1 = "UPDATE post 
					SET category_id=:category_id
					WHERE category_id = :id";	//image=:image, 
 
        // prepare query for execution
        $stmt1 = $con->prepare($query1);
	
        $name=1;
		
		date_default_timezone_set("Africa/Lagos");
		$updated_at=date('Y-m-d H:i:s');
        
        // bind the parameters
        $stmt1->bindParam(':category_id', $name);
		$stmt1->bindParam(':id', $id);
		
	if($stmt1->execute()){
		
		$query = "DELETE FROM categories WHERE c_id = ?";
		$stmt = $con->prepare($query);
		$stmt->bindParam(1, $id);
			
		if($stmt->execute()){
			// tell the user record was deleted and redirect the user
			echo '<script>alert("Deleted successfully")</script>'; 
			header('refresh:0;category.php');
		}
		
		else {
			die('Unable to delete record.');
		}
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