<!DOCTYPE html>
<html lang="en">
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
<body><?php include 'landlords_nav.php'; ?>
    <?php
  
    if(isset($_GET['success']) && $_GET['success'] == 'true') {
      
        echo '<div class="alert alert-success" role="alert">
        Property  added successfully!
              </div>';
    }
    ?>




<div class="container mt-5">
    <h2>Add Property Listing</h2>
    <form action="add_listing.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="propertyName">Property Name:</label>
            <input type="text" class="form-control" id="propertyName" name="propertyName" required>
        </div>
        <div class="form-group">
            <label for="propertyDescription">Description:</label>
            <textarea class="form-control" id="propertyDescription" name="propertyDescription" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="propertyPrice">Price:</label>
            <input type="number" class="form-control" id="propertyPrice" name="propertyPrice" required>
        </div>
        <div class="form-group">
            <label for="propertyImages">Images:</label>
            <input type="file" class="form-control-file" id="propertyImages" name="propertyImages[]" multiple>
        </div>
        <div class="form-group">
  <label for="propertyLocation">Location:</label>
  <div id="map" style="height: 400px;"></div>
  <input type="text" id="location-lat" name="locationLat">
  <input type="text" id="location-lng" name="locationLng">
</div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
  let map;
  let marker;

  function initMap() {
    const initialPosition = { lat: -34.397, lng: 150.644 };

    map = new google.maps.Map(document.getElementById("map"), {
      center: initialPosition,
      zoom: 8
    });

    marker = new google.maps.Marker({
      position: initialPosition,
      map: map,
      draggable: true 
    });


    google.maps.event.addListener(map, 'click', function(event) {
      placeMarker(event.latLng);
    });

    function placeMarker(location) {
     
      if (!marker) {
        marker = new google.maps.Marker({
          position: location,
          map: map,
          draggable: true 
        });
      } else {
    
        marker.setPosition(location);
      }
 
      document.getElementById('location-lat').value = location.lat();
      document.getElementById('location-lng').value = location.lng();
    }
  }
</script>


</body>
</html>
