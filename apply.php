<?php


session_start();


$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'nsbm_property';


$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $propertyId = $_POST['property_id'];


  $email = $_SESSION['user_id']; 
      $contact = $_POST['contact'];
    $status = 'pending'; 

    
    $stmt = $conn->prepare("INSERT INTO reservation (property_id, email, status, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $propertyId, $email, $status, $contact);


    if ($stmt->execute()) {


        header('Location: list.php?success=true');


        exit();
    } else {

        echo "Error: " . $stmt->error;
    }

   
    $stmt->close();
    $conn->close();
} else {
   
    echo "Please submit the form first.";
}
?>
