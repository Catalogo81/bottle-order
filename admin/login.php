<?php include('../config/constants.php') ?>

<html>
    <head>
        <title>Login - Bottle Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <!-- Login Form Start -->
            <form action="" method="post" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form End -->

            <br><br><br><br>
            <p class="text-center">All rights reserved. Designed By <a href="#">Kgotso Matjato</a></p>
        </div>
    </body>
</html>

<?php

    //Check if Submit button is clicked or not
    if(isset($_POST['submit'])){

        //Process for Login
        //1. Get the Data from Login Form
        //$username = $_POST['username'];
        //$password = md5($_POST['password']);

        //SQL Injection Prevention
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //2. Check if SQL user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute SQL Query
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check if user exists or not
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            //User is Available and Login Successfull
            $_SESSION['login'] = "<div class='success'> Login Successful! </div>";

            //Checks if user is logged in or not, and save its username as a value
            $_SESSION['user'] = $username; //this value will remail as is until user logs out

            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User is not Available and Login Failed
            $_SESSION['login'] = "<div class='error text-center'> Username or Password do not exist. Try again! </div>";

            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }

?>