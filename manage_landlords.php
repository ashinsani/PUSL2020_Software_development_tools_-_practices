<?php

$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'nsbm_property';
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, description, price, latitude, longitude, image FROM property_listing";
$result = $conn->query($sql);

$listings = [];
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $listings[] = $row;
    }
} else {
    $listings = [];
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Listings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCTSuk9Ku0_d-rZGiq95xDcR8wLPPIPH4&callback=initMap&libraries=places&v=weekly" async defer></script>
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">
    <style>
    .card-horizontal {
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
            margin-bottom: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }
        
        .card-horizontal .img-fluid {
            flex: 0 0 auto;
            width: 120px;
            height: 120px;
            margin-right: 20px;
            object-fit: cover;
            border-radius: 0.25rem;
        }
        
        .card-body-horizontal {
            flex: 1;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #f3e5f5; 
        }

        .card-title, .card-text {
            color: #333; 
        }

        .btn-update {
            background-color: #6a1b9a; 
            color: #fff;
        }

        .btn-update:hover {
            background-color: #5e35b1;
        }

        .btn-delete {
            margin-left: 10px;
        }
        .footer {
            background-color: #6a1b9a; 
            color: #ffffff; 
            padding: 20px;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .footer h3, .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #ffffff; 
            text-decoration: none;
            margin: 0 10px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
       <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">
</head>
<body>
<?php include 'landlords_nav.php'; ?>
<div class="container mt-5">
    <h2>Manage Property Listings</h2>
    <?php foreach ($listings as $listing): ?>
        <div class="card card-horizontal">
            <img src="<?php echo htmlspecialchars($listing['image']); ?>" class="img-fluid" alt="Property Image">
            <div class="card-body-horizontal">
                <div>
                    <h5 class="card-title"><?php echo htmlspecialchars($listing['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($listing['description']); ?></p>
                    <p class="card-text">Price: RS: <?php echo htmlspecialchars($listing['price']); ?></p>
                </div>
                <div class="action-buttons">
                    <a href="landlords_update.php?id=<?php echo $listing['id']; ?>" class="btn btn-primary btn-update">Update</a>
                    <a href="delete.php?id=<?php echo $listing['id']; ?>" class="btn btn-danger btn-delete" onclick="return confirm('Are you sure you want to delete this listing?');">Delete</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
