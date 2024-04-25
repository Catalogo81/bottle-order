<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Orders</h1>

        <!-- Button to add Admin -->
        <br/><br/><br/>

        <?php
            //Display the message for updating a order image
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br/><br/>

        <div>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Bottle</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

                <?php
                    //Get all the orders from Database
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //diplaying latest order first

                    //Execute Query
                    $res = mysqli_query($conn, $sql);

                    //Count the rows
                    $count = mysqli_num_rows($res);
                    
                    $sn = 1; //create a serial number and set its initial value to 1

                    if($count > 0)
                    {
                        //Orders are available
                        while($row = mysqli_fetch_assoc($res))
                        {
                            //get all order details
                            $id = $row['id'];
                            $bottle = $row['bottle'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                            ?>
                            
                                <tr>
                                    <td><?php echo $sn++; ?>.</td>
                                    <td><?php echo $bottle; ?></td>
                                    <td>R<?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td>R<?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>

                                    <td>
                                        <?php 
                                            //Ordered, On Delivery, Delivered, Cancelled
                                            
                                            if($status == "Ordered")
                                            {
                                                echo "<label><b>$status</label></b>";
                                            }
                                            elseif($status == "On Delivery")
                                            {
                                                echo "<label style='color: orange;'><b>$status</b></label>";
                                            }
                                            elseif($status == "Delivered")
                                            {
                                                echo "<label style='color: green;'><b>$status</b></label>";
                                            }
                                            elseif($status == "Cancelled")
                                            {
                                                echo "<label style='color: red;'><b>$status</b></label>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td style="width: 150px;">
                                        <a href="<?php echo SITEURL; ?>admin/update-orders.php?id=<?php echo $id; ?>" class="btn-primary" class="btn-primary">Update Order</a>
                                    </td>
                                </tr>
                                
                            <?php
                        }
                    }
                    else
                    {
                        //Orders not available
                        echo "<tr><td colspan='12' class='error'>Orders not Available.</td></tr>";
                    }
                ?>

            </table>
        </div>

    </div>
    
</div>

</body>
</html>

<?php include('partials/footer.php');?>