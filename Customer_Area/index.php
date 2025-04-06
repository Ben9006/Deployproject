<?php
session_start();
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Grocify Grocery Store</title>

<!-- code for font awesome cdn-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- code for font awesome cdn-->

<!-- code for linking  css file-->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- code for linking  css file-->

<!-- code for swiper from CDN-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<!-- code for swiper from CDN-->


<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<!-- header section -->
<header class="header">
    <a href="#" class="logo"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Grocify </a>

<nav class="navbar">
    <a href="index.php">home</a>
    <a href="#features">features</a>
    <a href="#products">products</a>
    <a href="#categories">categories</a>
    <a href="#Contact">contact us</a>

    <?php
    if(isset($_SESSION['username'])){ 
        echo "<a href='../users_area/profile.php'>My Account</a>";
    }else{
        echo "<a href='../users_area/user_registration.php'>Register</a>";
    }
    ?>
</nav>

<div class="icons">
    <div class="fa fa-bars" id="menu-btn"></div>
    <div class="fa fa-search" id="search-btn"></div>
    <div class="fa fa-shopping-cart" id="cart-btn"></div>
</div>

<form class="search-form" action="search_product.php" method="GET">
    <input type="search" id="search-box" placeholder="search here..." name="search_data">
    <button type="submit"value="search" class="search-btn" name="search_data_product"><i class="fa fa-search"></i></button>
</form>


<!-- Cart Section-->
<div class="shopping-cart">
    <div class="cart-container">
        <form action="" method="POST">
        <table class="table">
            <!--<thead>
                <tr>
                    <th>Product title</th>
                    <th>Product Image</th>
                    <th class="quantity">Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>-->
                <!--php code to display the dynamic data-->
                <?php
              
                $ip = getIPAddress();
                $total_price = 0;
                $cart_query= "select * from `cart_details` where ip_address='$ip'";
                $result = mysqli_query($con, $cart_query);
                $result_count=mysqli_num_rows($result);
                if($result_count > 0){
                    echo "
                    <thead>
                <tr>
                    <th>Product title</th>
                    <th>Product Image</th>
                    <th class='quantity'>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th>Operations</th>
                </tr>
            </thead> 
            <tbody>";

                while ($row = mysqli_fetch_array($result)) {
                  $product_id = $row['product_id'];
                  $select_product = "select * from `products` where product_id='$product_id'";
                  $result_product = mysqli_query($con, $select_product);
                  while ($row_product_price = mysqli_fetch_array($result_product)) {
                    $product_price = array($row_product_price['product_price']); // [200][300]
                    $price_table=$row_product_price['product_price'];
                    $product_title=$row_product_price['product_title'];
                    $product_image=$row_product_price['product_image'];
                    $product_values = array_sum($product_price); //[500]
                    $total_price +=$product_values; //500
                ?>

                <tr>
                    <td><?php echo$product_title?></td>
                    <td><img src="../admin_area/product_images/<?php echo$product_image?>" alt="" width="50px" height="50px"></td>
                    <td><input type="text" name="qty" id="" class="input-box"></td>
                    <?php
                    $ip = getIPAddress();
                    if(isset($_POST['update_cart'])){
                        $quantities= $_POST['qty'];
                        $update_cart = "update `cart_details` set quantity=$quantities where ip_address='$ip'";
                        $result_quantity = mysqli_query($con, $update_cart);
                        $total_price=$total_price*$quantities;

                    }
                    ?>
                    <td><?php echo$price_table?>/-</td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo$product_id?>"></td>
                    <td>
                    <!--<button class="btn-cart">Update</button>-->
                    <input type="submit" value="Update" name="update_cart" class="btn-cart">
                    <!--<button class="btn-cart">Remove</button>-->   
                    <input type="submit" value="Remove" name="remove_cart" class="btn-cart">
                    <td>
                </tr>

                <?php
                }
            }
            }
            else{
                echo"<h2 style='padding:20px;'>Your cart is empty!</h2>";
            }
            ?>
            </tbody>
        </table>
        <!--subtotal-->

        <div class="d-flex">
            <?php
            $ip = getIPAddress();
            $cart_query= "select * from `cart_details` where ip_address='$ip'";
            $result = mysqli_query($con, $cart_query);
            $result_count=mysqli_num_rows($result);
            if($result_count > 0){
                echo"<h4 class='subtotal'>Subtotal: <strong class='text-info'> $total_price/-</strong></h4>
            <a href=index.php' class='btn-cart'>Continue Shopping</a> 
            <a href='../users_area/checkout.php'class='btn-cart'>Checkout</a>";
            }else{
                echo"<a href='index.php' class='btn-cart'>Continue Shopping</a>";
            }
            ?>
        </div>
        </form>
        
        <!--function for removing items-->
        <?php
        function remove_cart_item(){
            global $con;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['removeitem'] as $remove_id){
                    $delete_query="delete from `cart_details` where product_id=$remove_id";
                    $run_delete=mysqli_query($con,$delete_query);
                    if($run_delete){
                        echo"<script>window.open('index.php','_self')</script>";
                    }
                }
            }
        }
        echo remove_cart_item();
    ?>

    <!--<div class="total">Total Price: ksh <span id="cart-total"><?php total_cart_price(); ?>/-</span></div>-->
   
</div>

<!--calling cart function-->
<?php
cart();
?>
<!--Cart section-->

</header>

<!-- header section -->


<!-- welcome section-->
<div class="welcome-section">
    
    <?php
    /*
    if(!isset($_SESSION['username'])){ 
        echo "<a href='#'>Welcome Guest</a>";
    }else{
        echo "<a href='#'>Welcome ".$_SESSION['username']."</a>";
    }
    
    if(!isset($_SESSION['username'])){ 
        echo "<a href='../users_area/user_login.php'>login</a>";
     }else{
        echo "<a href='../users_area/logout.php'>logout</a>";
    }
        */
    ?>
 </div>


<!-- banner section-->
 <section class="home" id="home">
      <div class="content">
        <h3>Order Fresh <span>Groceries</span> Now</h3>
        <p>Welcome to Grocify, your one-stop online grocery shop! Where you can search and checkout any product
             of your  with a good experience. Happy shopping! </p>

      </div>
 </section>
<!-- banner section-->

<!-- our feature section-->
<section class="features" id="features">
    <h1 class="heading"> Our <span>Features</span></h1>

    <div class="box-container">
        <div class="box">
            <img src="image/feature-img-2.png">
            <h3>Delivery</h3>
            <P>Delivery at your doorstep</P>

            <a href="customer_tracker.php" class="btn">Track Now</a>
        </div>
    
    </div>
 </section>
<!-- our feature section-->

<!-- our products section-->
<section class="products" id="products">
    <h1 class="heading">Our <span>Products</span></h1>

    <div class="swiper product-sliders">

        <div class="swiper-wrapper">

                 <!--fetching products-->
                <?php
                //calling the product function
                getproducts();
                get_unique_categories();
                //$ip = getIPAddress();  
                //echo 'User Real IP Address - '.$ip; 
                ?>
        </div>
    </div>

</section>
 <!-- our products section-->

 <!-- products category section-->

 <section class="categories" id="categories">
    <h1 class="heading"> Product <span>Categories</span></h1>
    <div class="box-container">

    <?php
    //calling the category function
    getcategories();
    ?>   
       
</section>

 <!-- products category section-->

<!-- Contact Us Section -->
<section class="contact" id="Contact">
    <h1 class="heading"> Contact <span>Us</span></h1>

    <div class="contact-container">
        <form action="" method="POST">
            <label for="name">Username</label>
            <input type="text" id="username" name="username" required placeholder="Enter your name" autocapitalize="none">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Enter your email" autocapitalize="none">

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required placeholder="Write your message" autocapitalize="none"></textarea>

            <button type="submit" class="btn" name="contact">Send Message</button>

        </form>
    </div>
    <?php
    send_complaints();
    ?>
</section>


 <!-- footer section-->
<div class="footer">
    <p>All rights reserved © 2025 Grocify</p>
    <p>For more information, contact us at: <strong>+254 1125 94945 </strong></p>
        <p>Follow us on:</p>
        <div class="social-icons">
            <a href="https://wa.me/+254112594945" target="_blank">
                <img src="../img/whatsapp-icon.jpg" alt="WhatsApp">
            </a>
            <a href="https://facebook.com/yourpage" target="_blank">
                <img src="../img/facebook-icon.jpg" alt="Facebook">
            </a>
            <a href="https://instagram.com/yourpage" target="_blank">
                <img src="../img/instagram-icon.jpg" alt="Instagram">
            </a>
        </div>
</div>
 <!-- footer section-->


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>


</body>
</html>
