<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile Page</title>

<!-- code for font awesome cdn-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- code for font awesome cdn-->

<!-- code for linking  css file-->
<link rel="stylesheet" type="text/css" href="profile.css">
<!-- code for linking  css file-->

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<!-- header section -->
<header class="header">
    <a href="#" class="logo"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Grocify </a>

<nav class="navbar">
    <a href="../Customer_Area/index.php">home</a>
    <a href="profile.php">My Account</a>
</nav>

<div class="icons">
    <div class="fa fa-bars" id="menu-btn"></div>
    <div class="fa fa-search" id="search-btn"></div>
    <div class="fa fa-shopping-cart" id="cart-btn"></div>
</div>

<form class="search-form" action="../Customer_Area/search_product.php" method="GET">
    <input type="search" id="search-box" placeholder="search here..." name="search_data">
    <button type="submit"value="search" class="search-btn" name="search_data_product"><i class="fa fa-search"></i></button>
</form>



</header>

<!-- header section -->

<!-- welcome section-->
 <div class="welcome-section">

    <?php
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
    ?>
 </div>

<!--home section-->
<div class="row mt-5">

    <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height:70vh;">

        <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4 class="text-center fs-4">Your Profile</h4></a>
        </li>
        
        <?php
        $username=$_SESSION['username'];
        $user_image="Select * from `user_table` where username='$username'";
        $user_image=mysqli_query($con,$user_image);
        $row_image=mysqli_fetch_array($user_image);
        $user_image=$row_image['user_image'];
        echo "<li class='nav-item'>
        <img src='./user_images/$user_image' alt='' class='profile_image my-4'>
        </li>";
        ?>
        <li class="nav-item">
            <a href="profile.php" class="nav-link text-light">Pending Orders</a>
        </li>
        <li class="nav-item">
            <a href="profile.php?edit_account" class="nav-link text-light">Edit Account</a>
        </li>
        <li class="nav-item">
            <a href="profile.php?my_orders" class="nav-link text-light">My orders</a>
        </li>
        <li class="nav-item">
            <a href="profile.php?my_orders" class="nav-link text-light">My orders</a>
        </li>
        <li class="nav-item">
            <a href="profile.php?delete_account" class="nav-link text-light">Delete Account</a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link text-light">Logout</a>
        </li>    
        </ul>          
    </div>

    <div class="col-md-10">
    <?php get_user_order_details();
    if(isset($_GET['edit_account'])){
        include('edit_account.php');
    }
    if(isset($_GET['my_orders'])){
        include('user_orders.php');
    }
    if(isset($_GET['delete_account'])){
        include('delete_account.php');
    }
    ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="../Customer_Area/js/script.js"></script>


</body>
</html>