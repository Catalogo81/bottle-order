<?php include('partials-front/menu.php');?>

    <!-- bottle sEARCH Section Starts Here -->
    <section class="bottle-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Bottle</legend>

                    <div class="bottle-menu-img">
                        <img src="images/300ml.png" alt="330ml" class="img-responsive img-curve">
                    </div>
    
                    <div class="bottle-menu-desc">
                        <h3>Bottle Title</h3>
                        <p class="bottle-price">R3.3</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Kgotso Matjato" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 078xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. ma@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- bottle sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>