<?php include('partials-front/menu.php');?>

    <!-- Validation -->
    <?php
        //check if id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];

            //Get Category title base on category_id from our database
            $sql = "SELECT title FROM tbl_category WHERE id = $category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);

            //Get the title
            $category_title = $row['title'];
        }
        else
        {
            //Category not passed
            //Redirect tom Home page
            header('location:'.SITEURL);
        }
    ?>

    <!-- bottle sEARCH Section Starts Here -->
    <section class="bottle-search text-center">
        <div class="container">
            
            <h2> Bottle Type: <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

        </div>
    </section>
    <!-- bottle sEARCH Section Ends Here -->


    <!-- bottle MEnu Section Starts Here -->
    <section class="bottle-menu">
        <div class="container">
            <h2 class="text-center">Bottle Menu</h2>

            <?php 

                //Create SQL Query to Get bottles based on Selected Category
                $sql2 = "SELECT * FROM tbl_bottle WHERE category_id = $category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the rows
                $count = mysqli_num_rows($res2);

                //Check if bottle is available or not
                if($count > 0)
                {
                    //bottle is available
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        //get the details from our DB
                        $title = $row2['title'];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $image_name = $row2['image_name'];

                        //display the data in our html tags
                        ?>
                            <!-- item 1 -->
                            <div class="bottle-menu-box">
                                <div class="bottle-menu-img">
                                    <?php
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
                                    <h4><?php echo $title ?> Bottle</h4>
                                    <p class="bottle-price">R<?php echo $price ?></p>
                                    <p class="bottle-detail">
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
                    echo "<div class='error'>Bottles not available....</div>";
                }

                $category_title = $row['title'];
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>