<?php

session_start();


$mysqli = new mysqli("localhost", "root", "", "nsbm_property");


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $fullName = $mysqli->real_escape_string($_POST['fullName']);
    $emailAddress = $mysqli->real_escape_string($_POST['emailAddress']);
    $password = $mysqli->real_escape_string($_POST['password']);


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   
    $stmt = $mysqli->prepare("INSERT INTO warden (fullName, emailAddress, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullName, $emailAddress, $hashed_password);


    if ($stmt->execute()) {
        header("Location: create_warden.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }


    $stmt->close();
}


$mysqli->close();
?>
