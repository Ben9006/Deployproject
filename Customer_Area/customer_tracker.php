<?php include('../includes/connect.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Track Your Order</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>#map { height: 600px; }</style>
  <!-- code for linking  css file-->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- code for linking  css file-->
</head>
<body>
  <h2 style="text-align: center;">Live Delivery Tracker</h2>
  <div id="map"></div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    const orderId = 1; // Set the correct order ID

    const map = L.map('map').setView([0, 0], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const marker = L.marker([0, 0]).addTo(map);

    function fetchLocation() {
      fetch('get_location.php?order_id=' + orderId)
        .then(response => response.json())
        .then(data => {
          const lat = data.latitude;
          const lng = data.longitude;
          marker.setLatLng([lat, lng]);
          map.setView([lat, lng], 15);
        })
        .catch(err => console.error("Fetch error:", err));
    }

    setInterval(fetchLocation, 3000);
  </script>
   <a href="index.php" class="btn">Home</a>
</body>
</html>
