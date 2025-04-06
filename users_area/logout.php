<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('You have logged out')</script>";
echo "<script>window.open('../Customer_Area/index.php','_self')</script>";

?>