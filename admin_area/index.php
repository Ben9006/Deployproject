<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <!--bootstrap css link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- code for linking css file-->
    <link rel="stylesheet" type="" href="Admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<!--first child-->
<header class="header">
    <a href="index.php" class="logo"> <i class="fa fa-shopping-basket"
     aria-hidden="true"></i>Grocify</a>

    <!-- welcome section-->
<div class="welcome">
    <?php
    if(!isset($_SESSION['admin_name'])){ 
        echo "<a href='#'>Welcome Guest</a>";
    }else{
        echo "<a href='#'>Welcome ".$_SESSION['admin_name']."</a>";
    }
    
    if(!isset($_SESSION['admin_name'])){ 
        echo "<a href='admin_login.php'>login</a>";
    }else{
        echo "<a href='admin_logout.php'>logout</a>";
    }
    ?>
</div>
</header>
<!--first child-->

<!-- Second child-->
<div class="home">
    <h3> Manager details</h3>
</div>
<!-- Second child-->

<section class="home_2">
    <div class="row">
        <div class="col-auto d-flex justify-content-center">
            <div class="col-auto d-flex justify-content-space-center">

            <button class="click-btn"><a href="insert_products.php" class="nav-link">Insert Products</a></button>
            <button class="click-btn"><a href="index.php?view_products" class="nav-link">View Products</a></button>
            <button class="click-btn"><a href="index.php?insert_category" class="nav-link">Insert Categories</a></button>
            <button class="click-btn"><a href="index.php?view_categories" class="nav-link">View Categories</a></button>
            <button class="click-btn"><a href="index.php?list_orders" class="nav-link">Orders</a></button>
            <button class="click-btn"><a href="index.php?list_payments" class="nav-link">Payments</a></button>
            <button class="click-btn"><a href="index.php?list_users" class="nav-link">Users</a></button>
            <button class="click-btn"><a href="index.php?list_drivers" class="nav-link">Delivery Agents</a></button>
            <button class="click-btn"><a href="index.php?complaints" class="nav-link">Complaints</a></button>
            </div>
        </div>
    </div>
</section>
             <!-- third child-->
     <div class="container my-3">
            <?php 
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['view_products'])){
                include('view_products.php');
            }
            if(isset($_GET['edit_products'])){
                include('edit_products.php');
            }
            if(isset($_GET['delete_product'])){
                include('delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('view_categories.php');
            }
            if(isset($_GET['edit_category'])){
                include('edit_category.php');
            }
            if(isset($_GET['delete_category'])){
                include('delete_category.php');
            }
            if(isset($_GET['list_orders'])){
                include('list_orders.php');
            }
            if(isset($_GET['delete_orders'])){
                include('delete_orders.php');
            }
            if(isset($_GET['list_payments'])){
                include('list_payments.php');
            }
            if(isset($_GET['delete_payments'])){
                include('delete_payments.php');
            }
            if(isset($_GET['list_users'])){
                include('list_users.php');
            }
            if(isset($_GET['delete_users'])){
                include('delete_users.php');
            }
            if(isset($_GET['list_drivers'])){
                include('list_drivers.php');
            }
            if(isset($_GET['complaints'])){
                include('complaints.php');
            }
            if(isset($_GET['delete_complaints'])){
                include('delete_complaints.php');
            }
            ?>
         </div>


 <!-- footer section-->
 <div class="footer">
    <p>All rights reserved © 2025 Grocify</p>
</div>
 <!-- footer section-->

<!-- bootstrap js link-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
