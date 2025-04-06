<?php
include('../includes/connect.php');
include('../functions/common_function.php');

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}

//getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query = "select * from `cart_details` where ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query);
$invoice_number = mt_rand();
$status = 'Pending';
$count_products = mysqli_num_rows($result_cart_price);

while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "select * from `products` where product_id=$product_id";
    $run_price=mysqli_query($con,$select_product);

    while($row_product_price=mysqli_fetch_array($run_price)){
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}


// getting qty from cart
$get_cart = "select * from `cart_details`";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity=mysqli_fetch_array($run_cart);
$quantity=$get_item_quantity['quantity'];
if($quantity==0){
    $quantity=1;
    $subtotal=$total_price;
}
else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
}

//inserting into orders table
$insert_order = "insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status)
values ('$user_id','$subtotal','$invoice_number','$count_products',NOW(),'$status')";
$result_query = mysqli_query($con, $insert_order);
if($result_query){
    echo "<script>alert('Order submitted successfully!');</script>";
    echo "<script>window.open('profile.php','_self');</script>";
}

//orders pending
$insert_pending_order = "insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status)
values ('$user_id','$invoice_number','$product_id','$quantity','$status')";
$result_pending_orders = mysqli_query($con, $insert_pending_order);

// 🔹 Reduce stock quantity in the database
$cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart = mysqli_query($con, $cart_query);

while ($row_cart = mysqli_fetch_array($result_cart)) {
    $product_id = $row_cart['product_id'];
    $cart_quantity = $row_cart['quantity'];

    // Reduce stock in the products table
    $update_stock_query = "UPDATE `products` SET stock_quantity = stock_quantity - $cart_quantity WHERE product_id='$product_id'";
    mysqli_query($con, $update_stock_query);
}

//delete items from cart
$empty_cart = "delete from `cart_details` where ip_address='$get_ip_address'";
$run_delete = mysqli_query($con, $empty_cart);
?>
