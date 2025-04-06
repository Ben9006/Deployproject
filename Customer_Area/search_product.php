<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Results - Grocify</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Linking CSS file -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Swiper CSS for Product Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<!-- Search Results Section -->
<section class="products" id="products">
    <h1 class="heading"><span>Products</span></h1>

    <div class="swiper product-sliders">
        <div class="swiper-wrapper">
            <?php 
            if(isset($_GET['search_data_product'])) {
                $search_data_value = $_GET['search_data'];

                // Corrected query to search for product
                $search_query = "SELECT * FROM `products` WHERE product_title LIKE '%$search_data_value%'";
                $result_query = mysqli_query($con, $search_query);
                
                // Check if products exist
                if(mysqli_num_rows($result_query) > 0) {
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_image = $row['product_image'];
                        $product_price = $row['product_price'];

                        echo "<div class='swiper-slide box'>
                            <img src='../admin_area/product_images/$product_image'>
                            <h1>$product_title</h1>
                            <p>$product_description</p>
                            <div class='price'>Price: $product_price/-</div>
                            <a href='index.php?add_to_cart=$product_id' class='btn'>Add to cart</a>
                        </div>";
                    }
                } else {
                    echo "<h1 class='text-center text-danger'>No products found!</h1>";
                }
            } else {
                echo "<h1 class='text-center text-danger'>No search query entered.</h1>";
            }
            ?>
        </div>
    </div>

    <!-- Return to Homepage Button -->
    <div class="return-home">
        <a href="index.php" class="btn">Return to Homepage</a>
    </div>
</section>
<!-- End Search Results Section -->

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
