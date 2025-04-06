<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){

    $product_title=$_POST['product_title'];
    $product_description=$_POST['description'];
    $product_category=$_POST['product_categories'];
    $product_price=$_POST['product_price'];
    $stock_quantity=$_POST['stock_quantity'];
    $product_status='true';

    //accessing images 
    $product_image=$_FILES['product_image']['name'];

    //accessing tmp name
    $temp_image=$_FILES['product_image']['tmp_name'];

    //checking empty condition
    if($product_title=='' or $product_description=='' or $product_category=='' or $product_price=='' or $product_image=='' or $stock_quantity==''){
        echo "<script>alert('Please fill all fields')</script>";
        exit();
    }else{
        move_uploaded_file($temp_image, "./product_images/" . $product_image);

        //insert_query
        $insert_query="insert into `products` (product_title,product_description,category_id,product_image,product_price,stock_quantity,date,status)
        values('$product_title','$product_description','$product_category','$product_image','$product_price','$stock_quantity',NOW(),'$product_status')";

         $result_query=mysqli_query($con,$insert_query);
         if($result_query){
            echo "<script>alert('Product inserted successfully')</script>";
        }
    }
  
}

   
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Insert Products</title>

<!--bootstrap css link-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!--font awesome cdn link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- code for linking css file-->
<link rel="stylesheet" type="text/css" href="Admin.css">
</head>

<body class="bg-light fs-5">
    <div class="container mt-3">
        <h1 class="text-center fs-1 fw-bold">Insert Products</h1>
        <!--form starts here-->
        <form action="" method="post" enctype="multipart/form-data">

            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product-title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product-title" class="form-control fs-5" placeholder="Enter Product title " auto-complete="off" required>
            </div>

            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label ">Product description</label>
                <input type="text" name="description" id="description" class="form-control fs-5" placeholder="Enter Product description" auto-complete="off" required>
            </div>

            <!--categories-->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_categories"  id="product_categories" class="form-select fs-5">
                    <option value="">Select category</option>
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_select = mysqli_query($con, $select_query);
                    while($row=mysqli_fetch_assoc($result_select)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo " <option value='$category_id'>$category_title</option>";
                    }
                    ?>              
                </select>
            </div>

            <!--image--> 
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image" class="form-label ">Product image </label>
                <input type="file" name="product_image" id="product_image" class="form-control fs-5" required>
            </div>

            <!--price-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control fs-5" placeholder="Enter Product price" auto-complete="off" required>
            </div>

            <!-- Stock Quantity -->
            <div class="form-outline mb-4 w-50 m-auto">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control fs-5" placeholder="Enter Stock Quantity" required>
            </div>

            <!--submit-->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="product-btn" value="Insert Product">
            </div>

            <a href="index.php" class="product-btn me-auto">Admin Page</a>
        </form>

    </div>
</body>
</html>