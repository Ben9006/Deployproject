<?php
include('../includes/connect.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Grocify Grocery checkout page</title>

<!-- code for font awesome cdn-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- code for font awesome cdn-->

<!-- code for linking  css file-->
<link rel="stylesheet" type="text/css" href="checkout.css">
<!-- code for linking  css file-->

<!-- code for swiper from CDN-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<!-- code for swiper from CDN-->


<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<!-- header section -->
<header class="header">
    <a href="#" class="logo"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Grocify </a>

<nav class="navbar">
    <a href="../Customer_Area/index.php">Home</a>
    <a href="../users_area/user_registration.php">Register</a>
</nav>

<!-- welcome section-->
<div class="welcome-section">

<?php
if(!isset($_SESSION['username'])){ 
    echo "<a href='#'>Welcome Guest</a>";
}else{
    echo "<a href='#'>Welcome ".$_SESSION['username']."</a>";
}
if(!isset($_SESSION['username'])){ 
    echo "<a href='user_login.php'>login</a>";
}else{
    echo "<a href='logout.php'>logout</a>";
}
?>
</div>

</header>

<!-- header section -->



<section class="checkout">
<div class="row px-1">
    <div class="col-md-12">
        <div class="row">
        <?php
            if(!isset($_SESSION['username'])){
                include('user_login.php');
            }else{
                include('payment.php');
            }
        ?>
        </div>
    </div>
</div>
</section>

 <!-- footer section-->
<div class="footer">
    <p>All rights reserved © 2025 Grocify</p>
</div>

 <!-- footer section-->


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>


</body>
</html>
