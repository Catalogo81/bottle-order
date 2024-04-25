<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>

        <!-- to show message when admin is successfully added or not -->
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //displays the Session Message
                unset($_SESSION['add']); //removes the Session Message
            }
        ?>

        <br/><br/>

        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Full Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

    </div>

</div>

<?php include('partials/footer.php');?>

<?php
    //Proccess the value from the Form and Save it in the Database

    //Check if the submit button is clicked or not
    if(isset($_POST['submit'])) //checks whether value of button submit is past through Post method
    {
        //Button Clicked
        //echo "Button Clicked";

        //1. process data by getting it from the Form using Post method
        //echo $full_name = $_POST['full_name'];
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']); //md5 is a PHP encryption method

        //2. SQL Query to save data into Database
        #sql query: database_column_name = 'form_value'
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        //3. Execute Query and Save in Database
        //code saved in the constants.php file
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check if (Query is Executed) data is inserted or not and display success message
        if($res == TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to display message
            $_SESSION['add'] = "Admin Added Successfully!";

            //Redirect Page to manage-admin
            header("location:".SITEURL.'/admin/manage-admin.php'); //. is used to concatenate
        }
        else
        {
            //Data Not Inserted
            //echo "Failed to Insert Data";
            //Create a Session Variable to display message
            $_SESSION['add'] = "Failed to Add Admin!";

            //Redirect Page to add-admin
            header("location:".SITEURL.'/admin/add-admin.php'); //. is used to concatenate
        }
    }
?>