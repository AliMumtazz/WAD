<?php
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT id, username, password FROM users WHERE username = ?";

    $stmt = $conn->prepare($sql);
  
    $stmt->bind_param("s", $username);
    
    $stmt->execute();

    $stmt->store_result();

    
    if ($stmt->num_rows == 1) {
       
        $stmt->bind_result($id, $db_username, $db_password);

        
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
           
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            header("Location: home.html"); 
            exit();
        } else {
            
            echo "Invalid username or password.";
        }
    } else {
        
        echo "Invalid username or password.";
    }

    $stmt->close();
}


$conn->close();
?>
