<?php
if(isset($_GET['delete_complaints'])){
    $delete_complains=$_GET['delete_complaints'];

    $delete_query="DELETE FROM `contact_table` WHERE contact_id = '$delete_complains'";
    $delete_result = mysqli_query($con, $delete_query);
    if($delete_result){
        echo "<script>alert('Complain is deleted successfully')</script>";
        echo "<script>window.location.href='./index.php?complaints','_self'</script>";
    }
}

?>