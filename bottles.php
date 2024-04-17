<?php include('partials-front/menu.php');?>

    <!-- bottle sEARCH Section Starts Here -->
    <section class="bottle-search text-center">
        <div class="container">
            
            <form action="bottle-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Bottles.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- bottle sEARCH Section Ends Here -->

    <!-- bottle MEnu Section Starts Here -->
    <section class="bottle-menu">
        <div class="container">
            <h2 class="text-center">Bottle Menu</h2>
            
            <?php
            
            //create SQL Query to display Bottles from database that are active
            $sql2 = "SELECT * FROM tbl_bottle WHERE active='Yes'";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count the rows to check if bottle is available or not
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0)
            {
                //bottle is available
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    //get the values like id, title, image_name
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name = $row2['image_name'];

                    ?>
                        <!-- Bottle item -->
                        <div class="bottle-menu-box">
                            <div class="bottle-menu-img">
                                <?php
                                
                                    //check if image is available or not
                                    if($image_name == "")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //image is available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>/images/bottle/<?php echo $image_name ?>" alt="330ml" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="bottle-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="bottle-price">R<?php echo $price; ?></p>
                                <p class="bottle-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    <?php
                }
            }
            else
            {
                //category is not avilable
                echo "<div class='error'>Bottles currently unavailable....</div>";
            }
        
            ?>      

            <!-- <div class="bottle-menu-box">
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

            item 4
            <div class="bottle-menu-box">
                <div class="bottle-menu-img">
                    <img src="images/5L_10L.jpeg" alt="10L and 5L" class="img-responsive img-curve">
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
            </div> -->

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>