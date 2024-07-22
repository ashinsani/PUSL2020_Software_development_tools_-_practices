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


if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $listingId = $_GET['id'];


    $stmt = $conn->prepare("UPDATE property_listing SET status = 'approved' WHERE id = ?");
    $stmt->bind_param("i", $listingId);

  
    if ($stmt->execute()) {




        header('Location: advertisement.php?success=true');
    } else {
        echo "Error updating record: " . $conn->error;
    }


    $stmt->close();
    $conn->close();
} else {
    echo "Invalid ID.";
}

?>
