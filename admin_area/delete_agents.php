<?php
if(isset($_GET['delete_agents'])){
    $delete_id = $_GET['delete_agents'];

    $delete_query = "DELETE FROM `drivers_table` WHERE driver_id = '$delete_id'";
    $delete_result= mysqli_query($con, $delete_query);
    if($delete_result){
        echo "<script>alert('Agent deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_drivers','_self')'</script>";
    }
}
?>