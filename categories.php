<?php include('partials-front/menu.php');?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories text-center">
        <div class="container">
            <h2 class="text-center">Explore Bottles</h2>

            <?php
            
                //create SQL Query to display Categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //execute the query
                $res = mysqli_query($conn, $sql);

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
                            <a href="category-bottles.html">
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
                    echo "<div class='error'>Categories currently unavailable....</div>";
                }
            
            ?>
        
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>