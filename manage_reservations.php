<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCTSuk9Ku0_d-rZGiq95xDcR8wLPPIPH4&callback=initMap&libraries=places&v=weekly" async defer></script>
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>


<body><?php include 'landlords_nav.php'; ?>


<body>
    <div class="container mt-4">
        <h2>Reservations</h2>

        <?php
       
        session_start();


        $landlordEmail = $_SESSION['landlord_email'] ?? null;

       
        $host = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'nsbm_property';

      
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

   
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

      
        function updateStatus($conn, $reservationId, $status) {
            $stmt = $conn->prepare("UPDATE reservation SET status = ? WHERE reservation_id = ?");
            $stmt->bind_param("si", $status, $reservationId);
            $stmt->execute();
            $stmt->close();
        }

     
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['accept'])) {
                updateStatus($conn, $_POST['reservation_id'], 'accepted');
            } elseif (isset($_POST['reject'])) {
                updateStatus($conn, $_POST['reservation_id'], 'rejected');
            }
        }

        $stmt = $conn->prepare("SELECT r.*, p.name AS property_name FROM reservation r 
        JOIN property_listing p ON r.property_id = p.id 
        WHERE p.landlord_email = ? AND r.status = 'pending'");
$stmt->bind_param("s", $landlordEmail);
$stmt->execute();
$result = $stmt->get_result();

      
        if ($result->num_rows > 0) {
         
            while ($row = $result->fetch_assoc()) {
 
?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Reservation ID: <?php echo $row['reservation_id']; ?></h5>
                        <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
                        <p class="card-text"><strong>Contact:</strong> <?php echo $row['contact']; ?></p>
                        <form action="" method="post">
                            <input type="hidden" name="reservation_id" value="<?php echo $row['reservation_id']; ?>">
                            <button type="submit" name="accept" class="btn btn-success">Accept</button>
                            <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <?php

            echo "<p>No pending reservations found.</p>";
        }

   
        $conn->close();
        ?>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
