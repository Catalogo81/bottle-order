<?php
    //Include Constants File
    include('../config/constants.php');

    //echo "Delete Page";

    //1. Check if the 'id' and 'image_name' values are passed/set
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //A. Get the passed values and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        // echo $id;
        // echo $image_name;

        //B. Remove the physical image file if available
        if($image_name != "")
        {
            //Image is Available. We remove it
            $path = "../images/bottle/".$image_name;

            //Remove the image
            $remove = unlink($path);

            //If image failed to remove then we add an error message and stop the process
            if($remove == false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error'> Failed to Remove Bottle Image</div>";

                //Redirect to Manage Bottle page
                header('location:'.SITEURL.'admin/manage-bottles.php');

                //Stop the Process
                die();
            }
        }

        //C. Delete data from database
        //SQL Query to delete Bottle data by id from Database
        $sql = "DELETE FROM tbl_bottle WHERE id = $id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check if the data is deleted from the database
        if($res == true)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>Bottle Deleted Successfully</div>";
            //Redirect to Manage Bottle
            header('location:'.SITEURL.'admin/manage-bottles.php');
        }
        else
        {
            //Set Fail Message and Redirect
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Bottle</div>";
            //Redirect to Manage Bottle
            header('location:'.SITEURL.'admin/manage-bottles.php');
        }
    }
    else 
    {
        //D. Redirect to Manage-Category Page 
        $_SESSION['delete'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITEURL.'admin/manage-bottles.php');
    }
?>