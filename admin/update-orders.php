<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
            //get data from manage order page
            //check if the id is set or not
            if(isset($_GET['id']))
            {
                //Get the id and all other details
                //echo "Getting the DATA";
                $id = $_GET['id'];

                //Create sql query to get all other details
                $sql = "SELECT * FROM tbl_order WHERE id = $id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //count the rows to check whether id is valid or not
                $count = mysqli_num_rows($res);

                if($count == 1) //one id wil have only one value of data
                {
                    //details available
                    //get all the data
                    $row = mysqli_fetch_assoc($res);

                    $bottle = $row['bottle'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    //details not available
                    //redirect to manage order with session message
                    //$_SESSION['no-bottle-found'] = "<div class='error'>Bottle not found</div>";
                    header('location:'.SITEURL.'admin/manage-orders.php');
                }
            }
            else
            {
                //redirect to manage bottle
                header('location:'.SITEURL.'admin/manage-orders.php');
            }
        ?>
    
        <!-- Update Order Form Start -->
        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td> Bottle: </td>
                    <td><b> <?php echo $bottle ?> </b></td>
                </tr>

                <tr>
                    <td> Price: </td>
                    <td><b>R <?php echo $price ?> </b></td>
                </tr>

                <tr>
                    <td> Quantity: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>"></input>
                    </td>
                </tr>

                <tr>
                    <td> Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td> Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td> Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td> Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td> Customer Address: </td>
                    <td>
                        <textarea type="text" name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <!-- pass as hidden data to update order by id when user presses on submit -->
                        <input type="hidden" name="id" value="<?php echo $id; ?> ">
                        <!-- pass as hidden data to update order price when user presses on submit -->
                        <input type="hidden" name="price" value="<?php echo $price; ?> ">

                        <input type="submit" name="update" value="Update Order" class="btn-primary">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Update Order Form End -->

        <?php
        
            //check is update button is clicked or not
            if(isset($_POST['update']))
            {
                //echo "Clicked";

                //1. Get all values from Order Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];
                
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Update the database
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id = $id
                ";

                //Execute the Query and Save in Database
                $res2 = mysqli_query($conn, $sql2);

                //Redirect to manage order with message
                //Check if executed or not
                if($res2 == true)
                {
                    //Query executed and Order updated
                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully! </div>";

                    //Rediect to Manage Bottle Page
                    header('location:'.SITEURL.'admin/manage-orders.php');
                    // End buffering and flush output
                    ob_end_flush();
                    exit(); // Ensure script stops execution after header redirect
                }
                else
                {
                    //Failed to update the Bottle
                    $_SESSION['update'] = "<div class= 'error'>Failed to Update Order! </div>";

                    //Rediect to Manage orders Page
                    header('location:'.SITEURL.'admin/manage-orders.php');
                     // End buffering and flush output
                    ob_end_flush();
                    exit(); // Ensure script stops execution after header redirect
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>