<?php include('partials-front/menu.php');?>

    <!-- Validation -->
    <?php
        //check if id is passed or not
        if(isset($_GET['bottle_id']))
        {
            //Bottle id is set and get the id
            $bottle_id = $_GET['bottle_id'];

            //Get Bottle details base on bottle_id from our database
            $sql = "SELECT * FROM tbl_bottle WHERE id = $bottle_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count the rows
            $count = mysqli_num_rows($res);

            //check if data is available
            if($count == 1)
            {
                //We have data
                //Get the data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //no data
                //redirect to Home page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Bottle not passed
            //Redirect tom Home page
            header('location:'.SITEURL);
        }
    ?>

    <!-- bottle sEARCH Section Starts Here -->
    <section class="bottle-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method = "POST">
                <fieldset>
                    <legend>Selected Bottle</legend>

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
                        <h3><?php echo $title ?></h3>
                        <!-- passing the bottle title using hidden input type when user clicks on 'submit' -->
                        <input type="hidden" name="bottle" value="<?php echo $title ?>">

                        <p class="bottle-price">R<?php echo $price ?></p>
                        <!-- passing the bottle price using hidden input type when user clicks on 'submit' -->
                        <input type="hidden" name="price" value="<?php echo $price ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Kgotso Matjato" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 078xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. ma@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            
                //check if Submit button is clicked
                if(isset($_POST['submit']))
                {
                    //get all details from the form
                    //echo "Pressed";

                    $bottle = $_POST['bottle'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty;

                    $order_date = date("Y-m-d h:i:sa"); //order_date

                    $status = "Ordered"; //Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = mysqli_real_escape_string($conn, $_POST['full_name']);
                    $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);


                    //Save the order in Database
                    //Ceate SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        bottle = '$bottle',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_name',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //echo $sql2; die(); //for debugging sql query results

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check if query is executed successfully or not
                    if($res2 == true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order'] = "<div class='success text-center'>Bottle Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error text-center'>Bottle Order Unsuccessfull.</div>";
                        header('location:'.SITEURL);
                    }
                }
            
            ?>

        </div>
    </section>
    <!-- bottle sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>