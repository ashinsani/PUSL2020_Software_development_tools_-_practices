<?php

session_start();


if (!isset( $_SESSION['user_id'])) {
   
}


$property = null;


$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'nsbm_property';
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $id = $conn->real_escape_string($id);
    $id = (int)$id;

 
    $stmt = $conn->prepare("SELECT * FROM property_listing WHERE id = ?");
    $stmt->bind_param("i", $id);

   
    $stmt->execute();

 
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      
        $property = $result->fetch_assoc();
    } else {
        echo "No property found with the ID: $id";
    }

   
    $stmt->close();
} else {
    echo "No ID provided.";
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Listings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">
</head>
    <style>
      body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }
       
        .property-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .btn-primary {
            background-color: #6a1b9a;
            border: none;
            padding: 0.75rem 1.25rem;
        }
        .btn-primary:hover {
            background-color: #5e35b1;
        }
        .form-group label {
            font-weight: bold;
        }.img-fluid, #propertyMap {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    border-radius: 5px; 
    margin-bottom: 20px; 
}

.property-image .img-fluid {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    margin-bottom: 20px;
}.img-fluid, #propertyMap {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    border-radius: 5px; 
    margin-bottom: 20px; 
    max-width: 600px; 
    max-height: 400px; 
    width: 100%; 
    height: auto; 
    display: block; 
    margin-left: auto;
    margin-right: auto;
}


.property-image .img-fluid {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    margin-bottom: 20px;
    max-width: 600px;
    max-height: 400px;
    width: 100%;
    height: auto;
    display: block;
    margin-left: auto;
    margin-right: auto;
}


#propertyMap {
    max-width: 600px;
    max-height: 400px;
    width: 100%; 
    height: auto; 
display: block;
    margin-left: auto;
    margin-right: auto;
}

    </style>
</head>
<body>
<?php include 'student_nav.php'; ?>



<div class="container">
    <?php if ($property): ?>
        <div class="row">
            <div class="col-md-6">
               
                <img src="<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image" class="img-fluid">
            </div>
     
            <div class="col-md-6">
              
                <div id="propertyMap" style="height: 400px;"></div>
            </div>

        </div>
               <hr>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <h2 class="mb-3"><?php echo htmlspecialchars($property['name']); ?></h2>
                <p class="text-muted mb-2"><?php echo htmlspecialchars($property['description']); ?></p>
                <p class="font-weight-bold mb-4">Price: <?php echo htmlspecialchars($property['price']); ?> LKR</p>
                
          
                <form action="apply.php" method="post" class="mb-5">
                    <input type="hidden" name="property_id" value="<?php echo htmlspecialchars($property['id']); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

                    <div class="form-group mb-4">
                        <label for="contact">Your Contact Number:</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center">Listing not found.</p>
    <?php endif; ?>
</div>


<script>
  function initMap() {
    var propertyLocation = {lat: <?php echo $property['latitude']; ?>, lng: <?php echo $property['longitude']; ?>};
    var map = new google.maps.Map(document.getElementById('propertyMap'), {
      zoom: 15,
      center: propertyLocation
    });
    var marker = new google.maps.Marker({
      position: propertyLocation,
      map: map
    });
  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCTSuk9Ku0_d-rZGiq95xDcR8wLPPIPH4&callback=initMap"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
