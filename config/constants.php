<?php
    //Start session
    session_start();

    //Create Constants to Store NON Repeating Values
    define('SITEURL', 'http://localhost/bottle-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'bottle-order');

    #$conn = mysqli_connect('localhost', 'username', 'password') or die(mysqli_error());
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting database

    //auto reload webpage
    if(isset($_SERVER['HTTPS'])  && $_SERVER['HTTPS'] == 'on')
    {
        $url = "https://";
        #$url = "https://localhost/bottle-order/";
    }
    else
    {
        $url = "http://";
        #$url = "http://localhost/bottle-order/";
        $url.=$_SERVER['HTTP_HOST'];
        $url.=$_SERVER['REQUEST_URI'];
        $url;
    }

    $page = $url;
    $sec = "10";

?>