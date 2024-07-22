<?php

$conn = new mysqli('localhost', 'root', '', 'nsbm_property');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$idNumber;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $idNumber = $id ;

    $fields = [];
    $params = [];
    $types = '';

 
    if (!empty($_POST['propertyName'])) {
        $fields[] = "name=?";
        $params[] = $_POST['propertyName'];
        $types .= 's';
    }
    if (!empty($_POST['propertyDescription'])) {
        $fields[] = "description=?";
        $params[] = $_POST['propertyDescription'];
        $types .= 's';
    }
    if (!empty($_POST['propertyPrice'])) {
        $fields[] = "price=?";
        $params[] = $_POST['propertyPrice'];
        $types .= 'd';
    }
    if (!empty($_POST['locationLat']) && is_numeric($_POST['locationLat'])) {
        $fields[] = "latitude=?";
        $params[] = $_POST['locationLat'];
        $types .= 'd';
    }
    if (!empty($_POST['locationLng']) && is_numeric($_POST['locationLng'])) {
        $fields[] = "longitude=?";
        $params[] = $_POST['locationLng'];
        $types .= 'd';
    }

    $newImageFileName = ''; 

    if (isset($_FILES['propertyImages']) && $_FILES['propertyImages']['error'] === UPLOAD_ERR_OK) {
        $targetDirectory = "uploads/"; 
        $fileExtension = pathinfo($_FILES['propertyImages']['name'], PATHINFO_EXTENSION);
        $randomNumber = rand(99999, 999999); 
        $newFileName = "image_" . $randomNumber . '.' . $fileExtension; 
        $targetFilePath = $targetDirectory . $newFileName;

    
        if (move_uploaded_file($_FILES['propertyImages']['tmp_name'], $targetFilePath)) {
            echo "File uploaded successfully.";
            $newImageFileName = $newFileName;
            $fields[] = "image=?";
            $params[] = $newImageFileName;
            $types .= 's';
        } else {
            echo "Error uploading file.";
        }
    }

    
    if (count($fields) > 0) {
        $sql = "UPDATE property_listing SET " . implode(', ', $fields) . " WHERE id=?";
        $params[] = $id;
        $types .= 'i';

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        if (!$stmt->bind_param($types, ...$params)) {
            die("Binding parameters failed: " . $stmt->error);
        }
        
 
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        } else {
            echo $id;
            header('Location: landlords_update.php?id=' . $id . '&success=true');
        }

        $stmt->close();
    } else {
        echo "No fields to update.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>