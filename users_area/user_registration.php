<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
<!--bootstrap css link-->
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
   <div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-12 col-xl-6">
            <form action="" method="post" enctype="multipart/form-data">
                <!--username field-->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">Username</label>
                    <input type="text" name="user_username" id="user_username" class="form-control" 
                    placeholder="Enter Username" auto-complete="off" required>
                </div>
                <!--email field-->
                <div class="form-outline mb-4">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" name="user_email" id="user_email" class="form-control" 
                    placeholder="Enter your email" auto-complete="off" required>
                </div>
                <!--image field-->
                <div class="form-outline">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" name="user_image" id="user_image" class="form-control" required>
                </div>
                <!--password field-->
                <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" name="user_password" id="user_password" class="form-control" 
                    placeholder="Enter your password" auto-complete="off" required>
                </div>
                <!--confirm password field-->
                <div class="form-outline mb-4">
                <label for="conf_user_password" class="form-label">Confirm Password</label>
                    <input type="password" name="conf_user_password" id="conf_user_password" class="form-control" 
                    placeholder="Confirm password" auto-complete="off" required>
                </div>
                <!--Address field-->
                <div class="form-outline mb-4">
                    <label for="user_address" class="form-label">Address</label>
                    <input type="text" name="user_address" id="user_address" class="form-control" 
                    placeholder="Enter your address" auto-complete="off" required>
                </div>
                <!--contact field-->
                <div class="form-outline mb-4">
                    <label for="user_contact" class="form-label">Contact</label>
                    <input type="text" name="user_contact" id="user_contact" class="form-control" 
                    placeholder="Enter your mobile number" auto-complete="off" required>
                </div>
                
                <div class="mt-4 pt-2">
                    <input type="submit" value="Register" class="bg-info py-2 px-3 
                    border-0"  name="user_register">
                    <p class="small fw-bold">Already have an account? <a href="user_login.php" class="text-danger"> Login Here</a></p>
                </div>

            </form>
        </div>
    </div>
   </div> 
   <a href="../Customer_Area/index.php" class="btn btn-primary px-3">Home</a>
</body>
</html>

<!--php code-->
<?php
if(isset($_POST['user_register'])){
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();

    //select query
    $select_query = "select* FROM `user_table` WHERE username = '$user_username' or user_email = '$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    if($row_count > 0){
        echo "<script>alert('Username already exists')</script";
    }else if($user_password!=$conf_user_password){
        echo "<script>alert('Password and confirm password does not match')</script>";
    }
    
    else{
        //insert query
    move_uploaded_file($user_image_tmp,"./user_images/$user_image");

    //insert the data into the database
    $insert_query = "insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_address,user_mobile)
    values('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
    $sql_execute=mysqli_query($con,$insert_query);
    }

    //selecting the cart items
    $select_cart_items="Select * FROM `cart_details` WHERE ip_address = '$user_ip'";
    $result_cart=mysqli_query($con,$select_cart_items);
    $row_count=mysqli_num_rows($result_cart);
    if($row_count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('../Customer_Area/index.php','_self')</script>";
    }
 
}


?>