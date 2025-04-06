<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
<!--bootstrap css link-->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
   <div class="container-fluid my-3 ">
    <h2 class="text-center fs-1 fw-bold">User Login</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6 mt-5">
            <form action="" method="post">
                <!--username field-->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label fs-5">Username</label>
                    <input type="text" name="user_username" id="user_username" class="form-control" 
                    placeholder="Enter Username" auto-capitalize="off" required>
                </div>
                <!--password field-->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label fs-5">Password</label>
                    <input type="password" name="user_password" id="user_password" class="form-control" 
                    placeholder="Enter your password" required>
                </div>               
                <!--Register field-->
                <div class="mt-4">
                    <input type="submit" value="Login" class="bg-info py-2 px-3 
                    border-0"  name="user_login">
                    <p class="small fw-bold">Don't have an account? <a href="user_registration.php" class="text-danger">Register</a></p>
                </div>

            </form>
        </div>
    </div>
   </div> 
</body>
</html>


<!--checking if the credentials are valid in the database-->
<?php
if(isset($_POST['user_login'])){
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query="Select * from `user_table` where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();

    //cart items
    $select_query_cart="Select * from `cart_details` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    
    if($row_count>0){ 
        $_SESSION['username'] = $user_username;
        if(password_verify($user_password,$row_data['user_password'])){
            $_SESSION['username'] = $user_username;
            //echo "<script>alert('Login successful')</script>";
            if($row_count==1 && $row_count_cart==0){
                $_SESSION['username'] = $user_username;
                echo "<script>alert('login successful')</script>"; //if you don't have any items in the cart
                echo "<script>window.open('profile.php','_self')</script>";
            }else{
                $_SESSION['username'] = $user_username;
                echo "<script>alert('login successful')</script>"; //if you have items in the cart
                echo "<script>window.open('payment.php','_self')</script>";
            }
        } else{
            echo "<script>alert('Invalid credentials')</script>";
        }
    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>