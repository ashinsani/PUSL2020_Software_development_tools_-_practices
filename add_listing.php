<?php

$conn = new mysqli('localhost', 'root', '', 'nsbm_property');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $propertyName = $_POST['propertyName'];
    $propertyDescription = $_POST['propertyDescription'];
    $propertyPrice = $_POST['propertyPrice'];
    $locationLat = $_POST['locationLat'];
    $locationLng = $_POST['locationLng'];

    $imagePath = ''; 

   
    if (isset($_FILES['propertyImages']['name'][0]) && $_FILES['propertyImages']['error'][0] === UPLOAD_ERR_OK) {
        $file = $_FILES['propertyImages']['tmp_name'][0];
        $fileExtension = pathinfo($_FILES['propertyImages']['name'][0], PATHINFO_EXTENSION);
        $randomNumber = rand(99999, 999999);
        $newFileName = "image_" . $randomNumber . '.' . $fileExtension; 
        $targetDirectory = "uploads/";
        $targetFilePath = $targetDirectory . $newFileName;

      
        if (move_uploaded_file($file, $targetFilePath)) {
            echo "File uploaded successfully.";
            $imagePath = $targetFilePath;
        } else {
            echo "Error uploading file.";
        }
    }

    session_start();


    $landlordEmail = $_SESSION['landlord_email'] ?? null;
   
    $sql = "INSERT INTO property_listing (name, description, price, latitude, longitude, image, landlord_email) VALUES (?, ?, ?, ?, ?, ?,?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param('ssdddss', $propertyName, $propertyDescription, $propertyPrice, $locationLat, $locationLng, $imagePath,$landlordEmail);
    
 
    if ($stmt->execute()) {
        header('Location: add.php?success=true');

    } else {
        echo "Error adding record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
