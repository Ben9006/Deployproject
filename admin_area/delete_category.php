<?php
if(isset($_GET['delete_category'])){
    $delete_category=$_GET['delete_category'];

    $delete_query="DELETE FROM `categories` WHERE category_id = '$delete_category'";
    $delete_result = mysqli_query($con, $delete_query);
    if($delete_result){
        echo "<script>alert('Category is deleted successfully')</script>";
        echo "<script>window.location.href='./index.php?view_categories','_self'</script>";
    }
}

?>