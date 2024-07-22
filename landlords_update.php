<?php
$conn = new mysqli('localhost', 'root', '', 'nsbm_property');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$propertyName = '';
$propertyDescription = '';
$propertyPrice = '';
$propertyLatitude = '';
$propertyLongitude = '';
$imagePath = '';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

 
    $stmt = $conn->prepare("SELECT * FROM property_listing WHERE id = ?");
    $stmt->bind_param("i", $id);


    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();


    if ($row) {
        $propertyName = $row['name'];
        $propertyDescription = $row['description'];
        $propertyPrice = $row['price'];
        $propertyLatitude = $row['latitude'];
        $propertyLongitude = $row['longitude'];
        $imagePath = $row['image'];
    } else {
        echo "No property found with the ID: $id";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Property Listing</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCTSuk9Ku0_d-rZGiq95xDcR8wLPPIPH4&callback=initMap&libraries=places&v=weekly" async defer></script>
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php include 'landlords_nav.php'; ?>

    <?php
  
    if(isset($_GET['success']) && $_GET['success'] == 'true') {
      
        echo '<div class="alert alert-success" role="alert">
        Property  update successfully!
              </div>';
    }
    ?>
<div class="container mt-5">
    <h2>Edit Property Listing</h2>
    <form action="update_listing.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Include the ID to identify the record -->
        <div class="form-group">
            <label for="propertyName">Property Name:</label>
            <input type="text" class="form-control" id="propertyName" name="propertyName" value="<?php echo htmlspecialchars($propertyName); ?>" required>
        </div>
        <div class="form-group">
            <label for="propertyDescription">Description:</label>
            <textarea class="form-control" id="propertyDescription" name="propertyDescription" rows="3" required><?php echo htmlspecialchars($propertyDescription); ?></textarea>
        </div>
        <div class="form-group">
            <label for="propertyPrice">Price:</label>
            <input type="number" class="form-control" id="propertyPrice" name="propertyPrice" value="<?php echo htmlspecialchars($propertyPrice); ?>" required>
        </div>
        <div class="form-group">
            <label for="propertyImages">Current Image:</label>
            <?php if ($imagePath): ?>
                <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Property Image" class="img-thumbnail">
            <?php endif; ?>
            <input type="file" class="form-control-file" id="propertyImages" name="propertyImages">
        </div>
        <div class="form-group">
            <label for="propertyLocation">Location:</label>
            <div id="map" style="height: 400px;"></div>
            <input type="hidden" id="location-lat" name="locationLat" value="<?php echo htmlspecialchars($propertyLatitude); ?>">
            <input type="hidden" id="location-lng" name="locationLng" value="<?php echo htmlspecialchars($propertyLongitude); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
  let map;
  let marker;

  function initMap() {
  
    const initialPosition = { lat: <?php echo floatval($propertyLatitude); ?>, lng: <?php echo floatval($propertyLongitude); ?> };

    map = new google.maps.Map(document.getElementById("map"), {
      center: initialPosition,
      zoom: 8
    });

    marker = new google.maps.Marker({
      position: initialPosition,
      map: map,
      draggable: true
    });

    google.maps.event.addListener(marker, 'dragend', function(event) {
      document.getElementById('location-lat').value = event.latLng.lat();
      document.getElementById('location-lng').value = event.latLng.lng();
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCTSuk9Ku0_d-rZGiq95xDcR8wLPPIPH4&callback=initMap&libraries=places&v=weekly" async defer></script>

</body>
</html>