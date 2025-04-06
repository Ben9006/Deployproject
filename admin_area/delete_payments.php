<?php
if(isset($_GET['delete_payments'])){
    $delete_id = $_GET['delete_payments'];

    $delete_query = "DELETE FROM `user_payments` WHERE payment_id = '$delete_id'";
    $delete_result= mysqli_query($con, $delete_query);
    if($delete_result){
        echo "<script>alert('Payment deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_payments','_self')'</script>";
    }
}
?>