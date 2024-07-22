<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservation</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css"></head>
<body>

<?php include 'student_nav.php'; ?>

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

 
    $sql = "SELECT * FROM reservation";
    $result = $conn->query($sql);

  
    if ($result->num_rows > 0) {
      
        while($row = $result->fetch_assoc()) {
            ?>
            <div class="container mt-4">
                <div class="card">
                    <div class="card-header">
                        Reservation Details
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>ID:</strong> <?php echo $row['reservation_id']; ?></li>
                        <li class="list-group-item"><strong>Property ID:</strong> <?php echo $row['property_id']; ?></li>
                        <li class="list-group-item"><strong>Email:</strong> <?php echo $row['email']; ?></li>
                        <li class="list-group-item"><strong>Status:</strong> <?php echo $row['status']; ?></li>
                        <li class="list-group-item"><strong>Created At:</strong> <?php echo $row['created_at']; ?></li>
                        <li class="list-group-item"><strong>Updated At:</strong> <?php echo $row['updated_at']; ?></li>
                        <li class="list-group-item"><strong>Contact:</strong> <?php echo $row['contact']; ?></li>
                    </ul>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<div class='container mt-4'>No reservations found.</div>";
    }

  
    $conn->close();
    ?>

  
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
