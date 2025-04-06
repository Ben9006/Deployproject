<?php
session_start();
session_unset();
session_destroy();
echo "<script>alert('You have logged out')</script>";
echo "<script>window.open('driver_login.php','_self')</script>";

?>