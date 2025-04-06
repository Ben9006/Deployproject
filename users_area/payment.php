<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!--php code to access user id-->
<?php
$user_ip=getIPAddress();
$get_user="select * from `user_table` where user_ip='$user_ip'";
$result=mysqli_query($con,$get_user);
$run_query=mysqli_fetch_assoc($result);
//get user id from database
$user_id=$run_query['user_id'];


?>
    <div class="container">
        <h2 class="text-center text-info">Payment options</h2>
        <div class="row d-flex align-items-center justify-content-center ">

            <div class="col-md-6 mt-5 ">
            <a href="https://www.paypal.com" target="_blank"><img src="../img/Upi.jpg" alt="" class="img-fluid w-100"></a>
            </div>

            <div class="col-md-6">
            <a href="order.php?user_id=<?php echo $user_id; ?>"><h2 class="text-center">Pay offline<h2></a>
            </div>
        </div>
    </div>
</body>
</html>