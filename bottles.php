<?php include('partials-front/menu.php');?>

    <!-- bottle sEARCH Section Starts Here -->
    <section class="bottle-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>bottle-search.php" method="POST">
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

                                <a href="<?php SITEURL; ?>order.php?bottle_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
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

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>