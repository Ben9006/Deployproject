<?php
include('../includes/connect.php');

// Check if order_id is present in the URL
if (!isset($_GET['order_id'])) {
  echo json_encode(["latitude" => 0, "longitude" => 0]);
  exit;
}

$order_id = intval($_GET['order_id']); // Make sure it's a number

// Query to fetch location
$result = $con->query("SELECT latitude, longitude FROM delivery_location WHERE order_id = $order_id");

// Check if query was successful
if ($result && $row = $result->fetch_assoc()) {
  echo json_encode($row);
} else {
  echo json_encode(["latitude" => 0, "longitude" => 0]);
}

$con->close();
?>
