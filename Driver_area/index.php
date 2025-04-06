<?php
include('../includes/connect.php');
session_start();
if (!isset($_SESSION['driver_id'])) {
  header("Location: driver_login.php");
  exit();
}

$driver_id = $_SESSION['driver_id'];

$query = "SELECT op.*, u.username, u.user_address 
        FROM orders_pending op
        JOIN user_table u ON op.user_id = u.user_id
        WHERE op.driver_id = $driver_id AND op.order_status != 'Delivered'";

$result = mysqli_query($con, $query);
?>
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Dashboard</title>
        <!--bootstrap css link-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- code for linking css file-->
    <link rel="stylesheet" type="" href="../admin_area/Admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header class="header">
    <a href="index.php" class="logo"> <i class="fa fa-shopping-basket"
     aria-hidden="true"></i>Grocify</a>

    <!-- welcome section-->
<div class="welcome">
    <?php
    if(!isset($_SESSION['driver_name'])){ 
        echo "<a href='#'>Welcome Guest</a>";
    }else{
        echo "<a href='#'>Welcome ".$_SESSION['driver_name']."</a>";
    }
    
    if(!isset($_SESSION['driver_name'])){ 
        echo "<a href='driver_login.php'>login</a>";
    }else{
        echo "<a href='driver_logout.php'>logout</a>";
    }
    ?>
</div>
</header>
  <h2 style="text-align: center; margin-top: 150px;">Sharing Your Location...</h2>

  <script>
    const orderId = 1; // Set correct order ID

    function sendLocation(position) {
      fetch('update_location.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          order_id: orderId,
          latitude: position.coords.latitude,
          longitude: position.coords.longitude
        })
      }).then(response => {
        if (!response.ok) {
          console.error("Failed to update location");
        }
      });
    }

    function errorHandler(err) {
      alert('Error getting location: ' + err.message);
    }

    function updateLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(sendLocation, errorHandler, {
          enableHighAccuracy: true,
          maximumAge: 0
        });
      } else {
        alert("Geolocation is not supported");
      }
    }

    updateLocation();
  </script>

<h3 class="text-center text-success mt-5">All Orders</h3>
<table class="table-border mt-5">
    <thead class="table-head text-center">
        <?php
        $get_orders="Select * from `user_orders`";
        $result=mysqli_query($con,$get_orders);
        $row=mysqli_num_rows($result);
        

        if($row==0){
            echo "<h2 class='text-danger text-center mt-5'>No Orders Found</h2>";
        }else{
            echo "<tr>
            <th>S1 No</th>
            <th>User ID</th>
            <th>Due amount</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody class=''>";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $number++;
                $order_id=$row_data['order_id'];
                $user_id=$row_data['user_id'];
                $amount_due=$row_data['amount_due'];
                $invoice_number=$row_data['invoice_number'];
                $total_products=$row_data['total_products'];
                $order_date=$row_data['order_date'];
                $order_status=$row_data['order_status'];
                echo"<tr>
            <td>$number</td>
            <td>$user_id</td>
            <td>$amount_due</td>
            <td>$invoice_number</td>
            <td>$total_products</td>
            <td>$order_date</td>
            <td>$order_status</td>
        </tr>";
            }
        }
        ?>
    </tbody>
</table>

<h3 class="text-center text-success mt-5">All Payments</h3>
<table class="table-border mt-5">
    <thead class="table-head text-center">
        <?php
        $get_users="Select * from `user_table`";
        $result=mysqli_query($con,$get_users);
        $row=mysqli_num_rows($result);
        


        if($row==0){
            echo "<h2 class='text-danger text-center mt-5'>No Users Found</h2>";
        }else{
            echo "<tr>
            <th>S1 No</th>
            <th>User ID</th>
            <th>username</th>
            <th>User email</th>
            <th>User Address</th>
            <th>User Mobile</th>
        </tr>
        </thead>
        <tbody class=''>";
            $number=0;
            while($row_data=mysqli_fetch_assoc($result)){
                $number++;
                $user_id=$row_data['user_id'];
                $username=$row_data['username'];
                $user_email=$row_data['user_email'];
                $user_address=$row_data['user_address'];
                $user_mobile=$row_data['user_mobile'];
                echo"<tr>
            <td>$number</td>
            <td>$user_id</td>
            <td>$username</td>
            <td>$user_email</td>
            <td>$user_address</td>
            <td>$user_mobile</td>
        </tr>";
            }
        }
        ?>
    </tbody>
</table>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div style="border:1px solid #000; padding:10px; margin-bottom:10px;">
            <p><strong>Order ID:</strong> <?= $row['order_id'] ?></p>
            <p><strong>Customer:</strong> <?= $row['username'] ?></p>
            <p><strong>Address:</strong> <?= $row['user_address'] ?></p>
            <p><strong>Status:</strong> <?= $row['order_status'] ?></p>
            <form method="POST" action="update_status.php">
                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                <select name="status">
                    <option value="Picked Up">Picked Up</option>
                    <option value="Delivered">Delivered</option>
                </select>
                <button type="submit" name="update_status">Update Status</button>
            </form>
        </div>
    <?php } ?>
</body>
</html>
