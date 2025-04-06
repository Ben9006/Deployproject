<?php

//including connect file
include('../includes/connect.php');//getting products
function getproducts(){
    global $con;
    //condition for checking for isset or not
   if(!isset($_GET['category'])){
          $select_query="Select * from `products`";
          $result_query=mysqli_query($con,$select_query);
          while($row=mysqli_fetch_assoc($result_query)){
    
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_description=$row['product_description'];
          $product_image=$row['product_image'];
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $stock_quantity=$row['stock_quantity'];

          // Determine stock status
          if ($stock_quantity > 10) {
            $stock_status = "<span style='color:green;'>In Stock</span>";
          } else if ($stock_quantity > 0) {
            $stock_status = "<span style='color:orange;'>Only $stock_quantity units!</span>";
          } else {
            $stock_status = "<span style='color:red;'>Out of Stock</span>";
          }

          // Disable "Add to Cart" button if out of stock
          $add_to_cart_button = ($stock_quantity > 0) ? "<a href='index.php?add_to_cart=$product_id' class='btn'>Add to cart</a>" : "<button class='btn' disabled>Out of Stock</button>";
    
          echo "<div class='swiper-slide box'>
          <img src='../admin_area/product_images/$product_image'>
          <h1>$product_title</h1>
          <p>$product_description</p>
          <div class='price'>Price: $product_price/-</div>
          <p>Stock: $stock_status</p>
          <div class='stars'>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star-half'></i>
                </div>
                $add_to_cart_button
    
                </div>";
                }
    }
}

//getting unique categories
function get_unique_categories(){
  global $con;

  //condition for checking for isset or not
 if(isset($_GET['category'])){
  $category_id=$_GET['category'];
        $select_query="Select * from `products` where category_id='$category_id'";
        $result_query=mysqli_query($con,$select_query);

        //counting the number of rows pre in the database
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
          echo "<h1 class='text-center text-danger'>Sorry no products available in this category</h1>";
        }


        while($row=mysqli_fetch_assoc($result_query)){
  
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_image=$row['product_image'];
        $product_price=$row['product_price'];
        $category_id=$row['category_id'];
  
        echo "<div class='swiper-slide box'>
        <img src='../admin_area/product_images/$product_image'>
        <h1>$product_title</h1>
        <p>$product_description</p>
        <div class='price'>Price: $product_price/-</div>
        <div class='stars'>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star'></i>
              <i class='fa fa-star-half'></i>
              </div>
              <a href='index.php?add_to_cart=$product_id' class='btn'>Add to cart</a>
  
              </div>";
              }
  }
}


//displaying the categories
function getcategories(){
  global $con;
  $select_categories="Select * from `categories`";
    $result_categories=mysqli_query($con,$select_categories);

    while($row_categories=mysqli_fetch_assoc($result_categories)){
        $category_title=$row_categories['category_title'];
        $category_id=$row_categories['category_id'];
        
        echo "<div class='box'>
        <h3>$category_title</h3>
        <a href='index.php?category=$category_id' class='btn'>Shop</a></div>";
    }
}


//searching products
function search_product(){
  global $con;
  if(isset($_GET['search_data_product'])){
  $search_data_value=$_GET['search_data'];

          $search_query="Select * from `products` where product_title like '%search_data_value%'";
          $result_query=mysqli_query($con,$search_query);
          while($row=mysqli_fetch_assoc($result_query)){
    
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_description=$row['product_description'];
          $product_image=$row['product_image'];
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
    
          echo "<div class='swiper-slide box'>
          <img src='../admin_area/product_images/$product_image'>
          <h1>$product_title</h1>
          <p>$product_description</p>
          <div class='price'>Price: $product_price/-</div>
          <div class='stars'>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star-half'></i>
                </div>
                <a href='index.php?add_to_cart=$product_id' class='btn'>Add to cart</a>
    
                </div>";
           }
  }
}
 //get ip address function
 function getIPAddress() {  
  //whether ip is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip = $_SERVER['HTTP_CLIENT_IP'];  
      }  
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether ip is from the remote address  
  else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
   }  
   return $ip;  
}  
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip; 


function cart() {
  global $con;

  if (isset($_GET['add_to_cart'])) {
      $ip = getIPAddress();
      $product_id = $_GET['add_to_cart'];

      // Check product stock
      $stock_check_query = "SELECT stock_quantity FROM `products` WHERE product_id='$product_id'";
      $stock_result = mysqli_query($con, $stock_check_query);
      $stock_data = mysqli_fetch_assoc($stock_result);
      $stock_quantity = $stock_data['stock_quantity'];

      if ($stock_quantity <= 0) {
          echo "<script>alert('This product is out of stock!');</script>";
          return;
      }

      // Check if product is already in the cart
      $check_query = "Select * from `cart_details` where ip_address='$ip' and product_id='$product_id'";
      $result = mysqli_query($con, $check_query);
      $num_of_rows = mysqli_num_rows($result);

      if ($num_of_rows > 0) {
          echo "<script>alert('Product is already in the cart!');</script>";
      } else {
          $insert_query = "insert into `cart_details` (product_id, ip_address, quantity) VALUES ('$product_id', '$ip', 0)";
          $run_query = mysqli_query($con, $insert_query);

          echo "<script>alert('Product added to cart!');</script>";
          echo "<script>window.location.href='index.php';</script>";
      }
  }
}

//total cart function
function total_cart_price() {
  global $con;
  $ip = getIPAddress();
  $total_price = 0;
  $cart_query= "select * from `cart_details`where ip_address='$ip'";
  $result = mysqli_query($con, $cart_query);
  while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['product_id'];
    $select_product = "select * from `products` where product_id='$product_id'";
    $result_product = mysqli_query($con, $select_product);
    while ($row_product_price = mysqli_fetch_array($result_product)) {
      $product_price = array($row_product_price['product_price']);
      $product_values = array_sum($product_price);
      $total_price +=$product_values;
    }
  }
  echo $total_price;
}


//get user order details
function get_user_order_details() {
  global $con;
  $username=$_SESSION['username'];
  $get_details="Select * from `user_table` where username='$username'";
  $result_query = mysqli_query($con, $get_details);
  while($row_query=mysqli_fetch_array($result_query)){
    $user_id=$row_query['user_id'];
    if(!isset($_GET['edit_account'])){
      if(!isset($_GET['my_orders'])){
        if(!isset($_GET['delete_account'])){
        $get_orders="Select * from `user_orders` where user_id='$user_id' and order_status='pending'";  
        $result_orders_query = mysqli_query($con, $get_orders);
        $row_count=mysqli_num_rows($result_orders_query);
        if($row_count>0){
          echo "<h3 class='text-center text-sucess my-5 fs-2'>You have <span class='text-danger'>$row_count</span> pending order</h3>
          <p class='text-center fs-2'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>"; 
        }else{
          echo "<h3 class='text-center text-sucess my-5 fs-2'>You have zero pending order</h3>
          <p class='text-center fs-2'><a href='../Customer_Area/index.php' class='text-dark'>Explore More</a></p>";
        }
        }
      }
    }
  }
} 


// Complaints function
function send_complaints(){
  global $con;
  if(isset($_POST['contact'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $insert_query="insert into `contact_table` (username,email,message,date) values('$username','$email','$message',NOW())";
    $result=mysqli_query($con,$insert_query);

    // Check if the query was successful
    if ($result) {
        echo "<script>alert('Complaint submitted successfully!');</script>";
        echo "<script>window.open('../Customer_Area/index.php''_self')</script>";
    } else {
        echo "<script>alert('Error submitting complaint: " . mysqli_error($con) . "');</script>";
    }
}
}
?>