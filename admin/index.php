<?php include('partials/menu.php');?>

    <!-- Main Section Start -->
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>

            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            ?>

            <br><br>

            <!-- item 1 -->
            <div class="col-4 text-center">
                <h1>16</h1>
                <br/>
                Categories
            </div>
            
            <!-- item 2 -->
            <div class="col-4 text-center">
                <h1>37</h1>
                <br/>
                Bottle Items
            </div>
            
            <!-- item 3 -->
            <div class="col-4 text-center">
                <h1>500</h1>
                <br/>
                Total Orders
            </div>
            
            <!-- item 4 -->
            <div class="col-4 text-center">
                <h1>R54 000</h1>
                <br/>
                Total Revenue
            </div>

        <div class="clearfix"></div>

        </div> 
    </div>
    <!-- Main Section End -->

    </body>
</html>

<?php include('partials/footer.php');?>
