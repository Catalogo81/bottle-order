<?php include('partials-front/menu.php');?>

    <!-- bottle sEARCH Section Starts Here -->
    <section class="bottle-search text-center">
        <div class="container">
            <?php 
                //Initialize Search keyword
                $search = "";

                //get value is not null
                if(isset($_POST['search']) && $_POST['search'] != "") {
                    // $search = $_POST['search'];
                    
                    //SQL Injection Prevention
                    $search = mysqli_real_escape_string($conn, $_POST['search']);
                }
                //echo $search;
            ?>
            
            <h2>Bottles on Your Search <a href="#" class="text-white"><?php echo $search ?></a>...</h2>

        </div>
    </section>
    <!-- bottle sEARCH Section Ends Here -->

    <!-- bottle MEnu Section Starts Here -->
    <section class="bottle-menu">
        <div class="container">
            <h2 class="text-center">Bottle Menu</h2>

            <?php
                //SQL Query to Get bottles based on search keyword (keyword = title or description)
                $sql = "SELECT * FROM tbl_bottle WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //execute the Query
                $res = mysqli_query($conn, $sql);
                //echo "conn: " . print_r($conn);

                //count Rows
                $count = mysqli_num_rows($res);

                //Check if bottle is available or not
                if($count > 0)
                {
                    //bottle available
                    while( $row = mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        
                        //diplay the details in html tag
                        ?>
                            <!-- item 1 -->
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
                                    <img src="images/300ml_bottles.jpeg" alt="330ml" class="img-responsive img-curve">
                                </div>

                                <div class="bottle-menu-desc">
                                    <h4><?php echo $title ?></h4>
                                    <p class="bottle-price">R<?php echo $price ?></p>
                                    <p class="bottle-detail">
                                        <!-- The bottle features a secure screw-on cap, preventing leaks and spills. Its transparent design allows for easy visibility of the contents inside.  -->
                                        <?php echo $description ?>
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
                    //bottle not available
                    echo "<div class='error'>Bottle not found.</div>";
                } 
            
            ?>

            <div class="clearfix"></div>
            
        </div>

    </section>
    <!-- bottle Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>