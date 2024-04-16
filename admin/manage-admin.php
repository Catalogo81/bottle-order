<?php include('partials/menu.php');?>

        <!-- Main Section Start -->
        <div class="main-content">
            <div class="wrapper">

                <h1>Manage Admin</h1>
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
                <!-- Button to add Admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br/><br/><br/>

                <div>
                    <table class="tbl-full">
                        <tr>
                            <th>Serial Number</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>

                        <!-- Dipsplay all data from our database -->
                        <?php
                            //Quesry to Get all Admins
                            $sql = "SELECT * FROM tbl_admin";

                            //Execute the Query
                            $res = mysqli_query($conn, $sql);

                            //Check if Query is executed or not
                            if($res == TRUE)
                            {
                                //Count Rows to check if we have data in the database or not
                                $count = mysqli_num_rows($res);

                                //variable that counts the number of users in our database
                                $serial_number = 1;

                                //Check the number of rows
                                if($count > 0)
                                {
                                    //There is data in database
                                    while($rows = mysqli_fetch_assoc($res))
                                    {
                                        //while loop gets all the data from the database
                                        //while loop will run as long as we have data in database

                                        //Get individual data
                                        $id = $rows['id'];
                                        $full_name = $rows['full_name'];
                                        $username = $rows['username'];

                                        //Display the values in our HTML table
                                        ?>
                                            <tr>
                                                <td><?php echo $serial_number++; ?></td>
                                                <td><?php echo $full_name; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td>
                                                    <a href="#" class="btn-primary">Update Admin</a>
                                                    <a href="#" class="btn-danger">Delete Admin</a>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>
                
            </div> 
        </div>
        <!-- Main Section End -->

        </body>
</html>

<?php include('partials/footer.php');?>