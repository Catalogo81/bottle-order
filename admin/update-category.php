<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            //Display info messages
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>

        <!-- Update Category Form Start -->

        <?php
            //get data from manage category page
            //check if the id is set or not
            if(isset($_GET['id']))
            {
                //Get the id and all other details
                //echo "Getting the DATA";
                $id = $_GET['id'];

                //Create sql query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id = $id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //count the rows to check whether id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $feature = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');
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
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                //Display image
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image ?>" width="150px">
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
                    <td> Featured: </td>
                    <td>
                        <input <?php if($feature == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($feature == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
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
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>

        <!-- Update Category Form End -->

        <?php
        
            //Check if Submit button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get all values from Category Form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                
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
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name = "Bottle_Category_".rand(000, 999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check if image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload == false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class= 'error'> Failed to Upload Image! </div>";

                            //Redirect to Add category
                            header('location:'.SITEURL.'admin/manage-category.php');

                            //Stop the process to no longer add data to our database
                            die();
                        }

                        //B. remove current image if available
                        if($current_image != "")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //echo $remove_path;

                            //check if the image is removed or not
                            //if failed to remove display message and stop process
                            if($remove != false) //*****************************************FIX THIS BUG: if($remove == false)************************************************ */
                            {
                                //failed to remove image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
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
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                //execute the Query and Save in Database
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirect to manage category with message
                //Check if executed or not
                if($res2 == true)
                {
                    //Query executed and Category updated
                    $_SESSION['add'] = "<div class='success'>Category Updated Successfully! </div>";

                    //Rediect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add the Category
                    $_SESSION['add'] = "<div class= 'error'>Failed to Update Category! </div>";

                    //Rediect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>