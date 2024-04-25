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

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories text-center" >
        <div class="container">
            <h2 class="text-center">Explore Bottles</h2>

            <?php
            
                //create SQL Query to display Categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                //execute the query
                $res = mysqli_query($conn, $sql);
                //echo "conn: " . print_r($conn);

                //count the rows to check if category is available or not
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    //category is available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //get the values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                            <!-- Category item -->
                            <a href="<?php echo SITEURL; ?>category-bottles.php?category_id=<?php echo $id ?>">
                            <div class="box-3 float-container">
                                <?php
                                    //check if image is available or not
                                    if($image_name == "")
                                    {
                                        //display message
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="330ml" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text"><?php echo $title ?></h3>
                            </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    //category is not avilable
                    echo "<div class='error'>Categories currently unavailable...</div>";
                }
            
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- bottle MEnu Section Starts Here -->
    <section class="bottle-menu">
        <div class="container">
            <h2 class="text-center">Bottle Menu</h2>

            <?php
            
            //create SQL Query to display Bottles from database that are active and featured
            $sql2 = "SELECT * FROM tbl_bottle WHERE active='Yes' AND featured='Yes' LIMIT 6";

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

        <p class="text-center">
            <a href="#">See All Bottles</a>
        </p>
    </section>
    <!-- Bottle Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>