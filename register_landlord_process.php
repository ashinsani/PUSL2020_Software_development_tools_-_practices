<?php


$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'nsbm_property';


$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $emailAddress = $conn->real_escape_string($_POST['emailAddress']);
    $password = $conn->real_escape_string($_POST['password']);

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $id = rand(99999, 999999);

    
    $stmt = $conn->prepare("INSERT INTO landlord (id, fullName, emailAddress, password) VALUES (?, ?, ?, ?)");

    
    $stmt->bind_param("isss", $id, $fullName, $emailAddress, $hashedPassword);

    if ($stmt->execute()) {
        header('Location: login.php');        
    } else {
        
        echo "Error: " . $stmt->error;
    }

 
    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();

?>
