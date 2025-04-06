<?php
include('../includes/connect.php');

// Get JSON input
$input = json_decode(file_get_contents("php://input"), true);

// Check if data is received properly
if (!isset($input['order_id'], $input['latitude'], $input['longitude'])) {
  http_response_code(400); // Bad request
  echo json_encode(["status" => "error", "message" => "Missing data"]);
  exit;
}

// Sanitize input
$order_id = intval($input['order_id']);
$lat = floatval($input['latitude']);
$lng = floatval($input['longitude']);

// Save to database
$query = "REPLACE INTO delivery_location (order_id, latitude, longitude, updated_at)
          VALUES ($order_id, $lat, $lng, NOW())";

if ($con->query($query)) {
  echo json_encode(["status" => "success"]);
} else {
  echo json_encode(["status" => "error", "message" => $con->error]);
}

$con->close();
?>
