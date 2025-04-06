<?php
include('../includes/connect.php');
if(isset($_POST['insert_cat'])){
    $category_title = $_POST['cat_title'];

    //select data from database
    $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('This category already exists')</script>";
    }else{
        
    $insert_query = "INSERT INTO `categories`(category_title) VALUES ('$category_title')";
    $insert_result = mysqli_query($con, $insert_query);
    if($insert_result){
        echo "<script>alert('Category has been inserted successfully')</script>";
    }

}}
?>


<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="insert-form mb-4">
    <!-- First Row: Input Field with Icon -->
    <div class="input-group w-90 mb-2">

        <span class="input-group-text bg-info" id="basic-addon1" mb-4><i class="fa-solid fa-receipt"></i></span>

        <div class="form-floating" style="flex-grow: 1;">
            <input type="text" class="form-control" name="cat_title" id="floatingInputGroup1" 
                   placeholder="Insert Categories" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    </div>

    <!-- Second Row: Submit Button Centered -->
    <div class="input-group justify-content-center m-auto">
    <input type="submit" class="product-btn p-2" name="insert_cat" value="Insert Categories">
    </div>
</form>
