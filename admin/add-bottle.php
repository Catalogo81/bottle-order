<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Bottle</h1>

        <br><br>

        <?php
            //diplays the message if image upload failed
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Bottle Title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Bottle"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" >
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
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //no categories, display message
                                    ?>
                                        <option value="0">NO Category Found</option>
                                    <?php
                                }
                                
                            ?>
                        </select>
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

        <!-- php code to enter data to the database -->

        <?php
        
            //check if the button is clicked or not
            if(isset($_POST['submit']))
            {
                //add bottle to the database
                //echo "clicked";

                //1. get the data from the form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //check if radio button for feature and active is checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    //set default value = No
                    $active = "No";
                }
                

                //2. upload the image if selected
                //check if select image button is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //get the details from the selected image
                    $image_name = $_FILES['image']['name'];

                    //check if image is selected or not, upload image only if selected 
                    if($image_name != "")
                    {
                        //image is selected
                        //A. rename the image
                        //get the extension of selected image (jpg, png...)
                        $ext = end(explode('.', $image_name));
                        
                        //create new name for image
                        $image_name = "Bottle-Name-".rand(0000,9999).".".$ext; //new image name e.g "Bottle-Name-568.jpg"

                        //B. upload the image
                        //get the src path and destination path

                        //src path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //destination path for the image to be uploaded
                        $dst = "../images/bottle/".$image_name;

                        //finally upload bottle image
                        $upload = move_uploaded_file($src, $dst);

                        //check if image is uploaded or not
                        if($upload == false)
                        {
                            //failed to upload the image

                            //redirecct to Add Bottle pwith error message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-bottle.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //set default value = blank
                    $image_name = "";
                }

                //3. insert into the database
                //create SQL query to Svae or Add Bottle
                //for numerical values we do not need to pass value inside quotes but for string value we need to add quotes
                $sql4 = "INSERT INTO tbl_bottle SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //execute the query
                $res4 = mysqli_query($conn, $sql4);

                //check if data is inserted or not
                //4. redirect with message to Mange Bottle Page
                if($res4 == true)
                {
                    //data is inserted successfully
                    $_SESSION['add'] = "<div class = 'success'>Bottle Added Successfully!</div>";
                    header('location:'.SITEURL.'admin/manage-bottles.php');
                }
                else
                {
                    //failed to insert data  
                    $_SESSION['add'] = "<div class = 'error'>Failed to Add Bottle!</div>";
                    header('location:'.SITEURL.'admin/manage-bottles.php');
                }
                
            }
        
        
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>