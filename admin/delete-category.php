<?php
    //Include Constants File
    include('../config/constants.php');

    //echo "Delete Page";

    //Check if the 'id' and 'image_name' values are passed/set
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Get the vaues and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        // echo $id;
        // echo $image_name;

        //Remove the physical image file if available
        if($image_name != "")
        {
            //Image is Available. We remove it
            $path = "../images/category/".$image_name;

            //Remove the image
            $remove = unlink($path);

            //If image failked to remve then we ad an error message and stop the process
            if($remove == false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error'> Failed to Remove Category Image</div>";

                //Redirect to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');

                //Stop the Process
                die();
            }
        }

        //Delete data from database
        //SQL Query to delete category data by id from Database
        $sql = "DELETE FROM tbl_category WHERE id = $id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check if the data is deleted from the database
        if($res == true)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set Fail Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else 
    {
        //Redirect to Manage-Category Page 
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>