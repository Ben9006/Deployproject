<?php
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    $get_query="SELECT * FROM `products` WHERE product_id='$edit_id'";
    $result=mysqli_query($con,$get_query);
    $row=mysqli_fetch_array($result);
    $product_title=$row['product_title'];
    //echo $product_title;
    $product_description=$row['product_description'];
    $category_id=$row['category_id'];
    $product_image=$row['product_image'];
    $product_price=$row['product_price'];

    //fetching categories\
    $select_categories="SELECT * FROM `categories` WHERE category_id='$category_id'";
    $result_categories=mysqli_query($con,$select_categories);
    $row_categories=mysqli_fetch_array($result_categories);
    $category_title=$row_categories['category_title'];

}
?>

<div class="container mt-5">
    <h1 class="text-center">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto mb-4">
            <label for="" class="form-label">Product Title</label>
            <input type="text" id="product_title" value="<?php echo $product_title?>"
            name="product_title" class="form-control" required>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" id="product_description"  value="<?php echo $product_description?>"
            name="product_description" class="form-control" required>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
        <label for="product_category" class="form-label">Product Categories</label>
            <select name="product_category" class="form-select">
                <option value="<?php echo $category_title?>"><?php echo $category_title?></option>
                <?php
                
                //fetching categories\
                $select_categories_all="SELECT * FROM `categories`";
                $result_categories_all=mysqli_query($con,$select_categories_all);
                while($row_categories_all=mysqli_fetch_array($result_categories_all)){
                    $category_title=$row_categories_all['category_title'];
                    $category_id=$row_categories_all['category_id'];
                    echo "<option value='$category_id'>$category_title</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_image" class="form-label">Product Image</label>
            <div class="d-flex">
            <input type="file" id="product_image" name="product_image" class="form-control w-90 m-auto" required>
            <img src="../img/<?php echo $product_image?>" alt="" class="product-image">
            </div>
        </div>
        <div class="form-outline w-50 m-auto mb-4">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" id="product_price"  value="<?php echo $product_price?>" name="product_price" class="form-control" required>
        </div>
        <div class="text-center">
            <input type="submit" name="edit_product" class="product-btn btn-info " value="Update">
        </div>
    </form>
</div>

<!--editing products-->
<?php
if(isset($_POST['edit_product'])){
    $product_title=$_POST['product_title'];
    $product_description=$_POST['product_description'];
    $product_category=$_POST['product_category'];
    $product_price=$_POST['product_price'];

    $product_image=$_FILES['product_image']['name'];
    $temp_image=$_FILES['$product_image']['tmp_name'];

    //checking for fields empty or not
    if($product_title=='' or $product_description=='' or $product_category=='' or $product_image=='' or $product_price==''){
        echo "<script>alert('Please fill all the fields')</script>";
    }else{
        //uploading image
        move_uploaded_file($temp_image,"./product_images/$product_image");

        //query to update products in the database
        $update_product="UPDATE `products` SET product_title='$product_title',product_description='$product_description',
        category_id='$product_category',product_image='$product_image',product_price='$product_price',date=NOW() where
        product_id='$edit_id'";
        $result_update_product=mysqli_query($con,$update_product);
        if($result_update_product){
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('./insert_products.php','_self')</script>";
        }

    }
}

?>