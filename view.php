<?php

$conn = new mysqli('localhost', 'root', '', 'nsbm_property');


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
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCTSuk9Ku0_d-rZGiq95xDcR8wLPPIPH4"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/add.css">
    <link rel="stylesheet" href="css/landlords_nav.css">
    <link rel="stylesheet" href="css/landlords.css">

</head>
<body>
<?php include 'warden_nav.php'; ?>

<div id="map" style="height: 400px;"></div>


<div class="modal" id="propertyModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Property Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Name: <span id="propertyName"></span></p>
        <p>Description: <span id="propertyDescription"></span></p>
        <p>Price: <span id="propertyPrice"></span></p>
 
      </div>
    </div>
  </div>
</div>

<script>
let map;
let markers = [];

function initMap() {
    const mapOptions = {
        zoom: 8,
        center: new google.maps.LatLng(-34.397, 150.644)
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);


    const listings = <?php echo json_encode($listings); ?>;
    listings.forEach(function(listing) {
        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(listing.latitude, listing.longitude),
            map: map,
            title: listing.name
        });

        marker.addListener('click', function() {
            
            $('#propertyName').text(listing.name);
            $('#propertyDescription').text(listing.description);
            $('#propertyPrice').text(listing.price);
           
            $('#propertyModal').modal('show');
        });

        markers.push(marker);
    });
}

$(document).ready(function() {
    initMap();
});
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
