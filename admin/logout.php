<?php
    //Include constants.php for SITEURL
    include('../config/constants.php');
    
    //1. Distroy the SESSION 
    session_destroy(); //unsets $_SESSION['user'] and logs the user out

    //2. Redirect to Login page
    header('location:'.SITEURL.'admin/login.php');
?>