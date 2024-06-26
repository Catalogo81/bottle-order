<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br/><br/>

        <?php
            //Display the message for adding a category
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            //Display the message for removing a category image
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            //Display the message for deleting a category data
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            //Display the message when no category is found
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            //Display the message when category is updated
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            //Display the message when upload image is updated
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            //Display the message when failed to upload image is updated
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>

        <br><br>

        <!-- Button to add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br/><br/><br/>

        <div>
            <table class="tbl-full">
                <tr>
                    <th>Serial Number</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php

                    //Query t get all Category from Database
                    $sql = "SELECT * FROM tbl_category";

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
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

                            //break php and add html for displaying data in html table
                            ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                            //Check whether image name is available or not
                                            if($image_name != "")
                                            {
                                                //Dislpay the image
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px">
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
                                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-primary">Update Category</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
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
                                    <div class="error"> No Category Added. </div>
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