<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
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

        <!-- Add Category Form Start -->

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add Category Form End -->

        <?php
        
            //Check if Submit button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the Value from Category Form
                $title = $_POST['title'];

                //check if image is selected or not and check value for image name accordingly
                //print_r($_FILES['image']); //displays the array of data 

                //die(); //Break the Code here

                if(isset($_FILES['image']['name'])) //if input type 'file' has a 'image' and 'name'
                {
                    //Upload the image
                    //To uplaod the image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];

                    // Upload the image only if the image is selected
                    if($image_name != "")
                    {
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
                            $_SESSION['upload'] = "<div class='error'> Failed to Upload Image! </div>";

                            //Redirect to Add category
                            header('location:'.SITEURL.'admin/add-category.php');

                            //Stop the process to no longer add data to our database
                            die();
                        }
                    }
                }
                else
                {
                    //Dont Upload image and set image_name value as black
                    $image_name = "";
                }

                //for Radio input we need to check if button is selected or not
                if(isset($_POST['featured']))
                {
                    //get the value from From
                    $featured = $_POST['featured'];
                }
                else {
                   //set the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //get the value from From
                    $active = $_POST['active'];
                }
                else {
                   //set the default value
                    $active = "No";
                }

                //2. Create SQL Query to Insert Category into Database
                $sql = "INSERT INTO tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        ";

                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4. Check if the Quert is executed or not and data is added or not
                if($res == true)
                {
                    //Query executed and Category added
                    $_SESSION['add'] = "<div class= 'success'> Category Added Successfully! </div>";

                    //Rediect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add the Category
                    $_SESSION['add'] = "<div class= 'error'> Failed to ADD Category! </div>";

                    //Rediect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>