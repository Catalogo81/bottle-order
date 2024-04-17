<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bottle Order Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Store Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="categories.html">Categories</a>
                    </li>
                    <li>
                        <a href="bottles.html">Bottles</a>
                    </li>
                    <li>
                        <a href="#">About</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!-- bottle sEARCH Section Starts Here -->
    <section class="bottle-search text-center">
        <div class="container">
            
            <h2>Bottles on Your Search <a href="#" class="text-white">"..."</a></h2>

        </div>
    </section>
    <!-- bottle sEARCH Section Ends Here -->



    <!-- bottle MEnu Section Starts Here -->
    <section class="bottle-menu">
        <div class="container">
            <h2 class="text-center">Bottle Menu</h2>

            <!-- item 1 -->
            <div class="bottle-menu-box">
                <div class="bottle-menu-img">
                    <img src="images/300ml_bottles.jpeg" alt="330ml" class="img-responsive img-curve">
                </div>

                <div class="bottle-menu-desc">
                    <h4>330ml Bottle</h4>
                    <p class="bottle-price">R3.3</p>
                    <p class="bottle-detail">
                        The bottle features a secure screw-on cap, preventing leaks and spills. Its transparent design allows for easy visibility of the contents inside. 
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <!-- item 2 -->
            <div class="bottle-menu-box">
                <div class="bottle-menu-img">
                    <img src="images/500ml_bottles.jpeg" alt="500ml" class="img-responsive img-curve">
                </div>

                <div class="bottle-menu-desc">
                    <h4>500ml Bottle</h4>
                    <p class="bottle-price">R5.3</p>
                    <p class="bottle-detail">
                        The bottle features a secure screw-on cap, preventing leaks and spills. Its transparent design allows for easy visibility of the contents inside.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <!-- item 3 -->
            <div class="bottle-menu-box">
                <div class="bottle-menu-img">
                    <img src="images/1000ml_bottles.avif" alt="1000ml" class="img-responsive img-curve">
                </div>

                <div class="bottle-menu-desc">
                    <h4>1000ml Bottle</h4>
                    <p class="bottle-price">R7.3</p>
                    <p class="bottle-detail">
                        The bottle features a secure screw-on cap, preventing leaks and spills. Its transparent design allows for easy visibility of the contents inside.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <!-- item 4 -->
            <div class="bottle-menu-box">
                <div class="bottle-menu-img">
                    <img src="images/5L_10L.jpeg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="bottle-menu-desc">
                    <h4>5L's and 10L's</h4>
                    <p class="bottle-price">R...</p>
                    <p class="bottle-detail">
                        The bottle features a secure screw-on cap, preventing leaks and spills. Its transparent design allows for easy visibility of the contents inside. 10L and 5L Bottles coming soon.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Coming Soon...</a>
                </div>
            </div>


            <div class="clearfix"></div>
            
        </div>

    </section>
    <!-- bottle Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>