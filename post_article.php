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
    
    $articleTitle = $_POST['articleTitle'];
    $articleContent = $_POST['articleContent'];

    $stmt = $conn->prepare("INSERT INTO article (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $articleTitle, $articleContent);


    if ($stmt->execute()) {
        
        header('Location: create_article.php?success=true');
        exit();
    } else {
       
        echo "Error: " . $stmt->error;
    }

  
    $stmt->close();

  
    $conn->close();
}
?>
