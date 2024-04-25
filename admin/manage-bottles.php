<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Bottles</h1>

        <br/><br/>

        <!-- Button to add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-bottle.php" class="btn-primary">Add Bottle</a>
        <br/><br/><br/>

        <?php
            //Display the message for successfully adding a bottle data
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['success']))
            {
                echo $_SESSION['success'];
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['error']))
            {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }

            //Display the message for deleting a bottle data
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            //Display the message when upload image is updated
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            //Display the message when unothorized user tried to delete a bottle
            if(isset($_SESSION['unauthorized']))
            {
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }

            //Display the message when failed to upload image is updated
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
            
            //Display the message when upload image is updated
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

        
        ?>

        <div>
            <table class="tbl-full">
                <!-- Heading Rows -->
                <tr>
                    <th>Serial Number</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Query t get all Category from Database
                    $sql = "SELECT * FROM tbl_bottle";

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count Rows
                    $count = mysqli_num_rows($res);

                    //Create Serial Number variable and assign value = 1
                    $sn = 1;

                    //Check if we have data in the databse or not
                    if($count > 0)
                    {
                        //We have data in database
                        //Get data and display it
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get values from indivisual colomns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            //break php and add html for displaying data in html table
                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td>R<?php echo $price; ?></td>

                                    <td>
                                        <?php 
                                            //Check whether image name is available or not
                                            if($image_name != "")
                                            {
                                                //Dislpay the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/bottle/<?php echo $image_name;?>" width="100px">
                                                <?php
                                            }
                                            else
                                            {
                                                //Display the message
                                                echo "<div class = 'error'> No Image Added </div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-bottle.php?id=<?php echo $id; ?>" class="btn-primary">Update Bottle</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-bottle.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Bottle</a>
                                    </td>
                                </tr>
                            <?php

                        }
                    }
                    else
                    {
                        //We do not have data
                        //Display message inside table
                        ?>
                            <tr>
                                <td colspan="6">
                                    <div class="error"> No Bottles Added Yet. </div>
                                </td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
        </div>

    </div>
    
</div>

</body>
</html>

<?php include('partials/footer.php');?>