<?php
// Include the database connection file
include 'db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

   
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("ss", $username, $hashedPassword);

   
    if ($stmt->execute()) {
        
        echo "Sign up successful.";
    } else {
   
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

 
    $stmt->close();
}


$conn->close();
?>
