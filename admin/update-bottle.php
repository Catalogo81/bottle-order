<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Bottle</h1>
        <br><br>

        <?php
            //Display info messages
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>

        <!-- Update Bottle Form Start -->

        <?php
            //get data from manage bottle page
            //check if the id is set or not
            if(isset($_GET['id']))
            {
                //Get the id and all other details
                //echo "Getting the DATA";
                $id = $_GET['id'];

                //Create sql query to get all other details
                $sql2 = "SELECT * FROM tbl_bottle WHERE id = $id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //count the rows to check whether id is valid or not
                $count = mysqli_num_rows($res2);

                if($count == 1)
                {
                    //get all the data
                    $row2 = mysqli_fetch_assoc($res2);

                    $title = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $current_image = $row2['image_name'];
                    $current_category = $row2['category_id'];
                    $featured = $row2['featured'];
                    $active = $row2['active'];
                }
                else
                {
                    //redirect to manage bottle with session message
                    $_SESSION['no-bottle-found'] = "<div class='error'>Bottle not found</div>";
                    header('location:'.SITEURL.'admin/manage-bottles.php');
                }
            }
            else
            {
                //redirect to manage bottle
                header('location:'.SITEURL.'admin/manage-bottles.php');
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data"> <!-- enctype for posting file data -->

            <table class="tbl-30">
                <tr>
                    <td> Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td> Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"> <?php echo $description; ?> </textarea>
                    </td>
                </tr>

                <tr>
                    <td> Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                //Display image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/bottle/<?php echo $current_image ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                //Display message
                                echo "<div class='error'>Image Not Available</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td> New Image: </td>
                    <td>
                        <input type="file" name="image" value="">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //php code to display categories from database
                                //1. create SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                                //execute query
                                $res = mysqli_query($conn, $sql);

                                //count rows to check if we have categories or not
                                $count = mysqli_num_rows($res);

                                //if count > 0 we have categories else we do not have categories
                                if($count > 0)
                                {
                                    //we have categories
                                    //2. display on dropdown
                                    while($row = mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $category_id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                            <option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $title; ?></option>
                                        <?php

                                        //echo "<option value='0'>Category Not Available.</option>";
                                    }
                                }
                                else
                                {
                                    //no categories, display message
                                    ?><option value="0">NO Category Found</option><?php

                                    //echo "<option value='0'>Category Not Available.</option>";
                                }
                                
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td> Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td> Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?> ">
                        <input type="hidden" name="id" value="<?php echo $id; ?> ">

                        <input type="submit" name="submit" value="Update Bottle" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>

        <!-- Update Bottle Form End -->

        <?php
            //error_reporting(E_ALL);
            ob_start();
            //Check if Submit button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get all values from Bottle Form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //echo "$current_image";
                
                
                //2. Update the new image if selected
                //check if image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image details
                    $image_name = $_FILES['image']['name'];

                    //check if the image is available or not
                    if($image_name != "")
                    {
                        //image available
                        //A. Upload new image
                        //Auto Rename our Image
                        //Get the Extension of our image (jpg, png, gif, etc)
                        $image_name_parts = explode('.', $image_name);
                        $ext = end($image_name_parts);

                        //Rename the image
                        $image_name = "Bottle_Name_".rand(0000, 9999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/bottle/".$image_name;

                        //Finally Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check if image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload == false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class= 'error'> Failed to Upload new Image! </div>";

                            //Redirect to Add category
                            header('location:'.SITEURL.'admin/manage-bottles.php');

                            //Stop the process to no longer add data to our database
                            die();
                        }

                        //echo $current_image;

                        //B. remove current image if available
                        if($current_image != "")
                        {
                            $remove_path = "../images/bottle/".$current_image;

                             // Debugging: Output the path
                            //echo "Path to remove: $remove_path";

                            $remove = unlink($remove_path);

                            // Debugging: Output the result of unlink
                            //echo "Unlink result: $remove";

                            //check if the image is removed or not
                            //if failed to remove display message and stop process
                            if($remove != false) //*****************************************FIX THIS BUG: if($remove == false)************************************************ */
                            {
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin/manage-bottles.php');
                                die(); //stop the process
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3. Update the database
                $sql3 = "UPDATE tbl_bottle SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                //execute the Query and Save in Database
                $res3 = mysqli_query($conn, $sql3);

                //4. Redirect to manage bottle with message
                //Check if executed or not
                if($res3 == true)
                {
                    //Query executed and Bottle updated
                    $_SESSION['add'] = "<div class='success'>Bottle Updated Successfully! </div>";

                    //Rediect to Manage Bottle Page
                    header('location:'.SITEURL.'admin/manage-bottles.php');
                    // End buffering and flush output
                    ob_end_flush();
                    exit(); // Ensure script stops execution after header redirect
                }
                else
                {
                    //Failed to Add the Bottle
                    $_SESSION['add'] = "<div class= 'error'>Failed to Update Bottle! </div>";

                    //Rediect to Manage Bottle Page
                    header('location:'.SITEURL.'admin/manage-bottles.php');
                     // End buffering and flush output
                    ob_end_flush();
                    exit(); // Ensure script stops execution after header redirect
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>