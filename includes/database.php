<?php

$host = "localhost";
$db_name = "wajepa_blog_tasks";
$username = "root";
$password = "";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

catch(PDOException $exception){
    echo "Error establishing a database connection: " . $exception->getMessage();
}
?>