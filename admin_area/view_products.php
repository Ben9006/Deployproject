<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- code for linking css file-->
    <link rel="stylesheet" type="" href="Admin.css">


    <title>Document</title>
</head>
<body>
    <h1 class="text-center text-success">All Products</h1>
    <table class="table-border">
        <thead class="table-head">
            <tr>
                <th>Product ID</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Price</th>
                <th>Total Sold</th>
                <th>Status</th>
                <th>Stock quantity</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $get_products="Select * from `products`";
            $result=mysqli_query($con,$get_products);
            $number=0;
            while($row=mysqli_fetch_assoc($result)){
                $product_id=$row['product_id'];
                $product_title=$row['product_title'];
                $product_image=$row['product_image'];
                $product_price=$row['product_price'];
                $stock_quantity=$row['stock_quantity'];
                $status=$row['status'];
                $number++;
                ?>
                <tr>
                <td><?php echo $number ?></td>
                <td><?php echo $product_title?></td>
                <td><img src='../img/<?php echo $product_image?>' class='product-image'/></td>
                <td><?php echo $product_price?>/-</td>
                <td><?php
                $get_count="Select * from `orders_pending` where product_id='$product_id'";
                $result_count=mysqli_query($con,$get_count);
                $rows_count=mysqli_num_rows($result_count);
                echo $rows_count;
                ?>
                </td>
                <td><?php echo $status?></td>
                <td><?php echo $stock_quantity?></td>
                <td><a href='index.php?edit_products=<?php echo $product_id?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='index.php?delete_product=<?php echo $product_id?>'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <?php
            }
?>
            
        </tbody>
    </table>
</body>
</html>