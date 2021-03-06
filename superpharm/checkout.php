<!DOCTYPE html>
<html lang="en">

<?php
require('include/config.php');
include('auth_session.php');
include('head.html'); ?>

<body>
	<!------- Header ------->
	<div id="header"></div>
	<!------- Header ------->

    <?php
        $id = $_GET["uid"];
        $query = mysqli_query($sql, "SELECT * FROM my_cart WHERE user_id = $id");
        if($query === FALSE) { 
           die(mysqli_error());
        }

        $users = mysqli_query($sql, "SELECT user_id,email,address,payment_method,contact FROM user");
            while($row = mysqli_fetch_assoc($users)){
                $email = $row['email'];
                $address = $row['address'];
                $payment_method = $row['payment_method'];
                $contact = $row['contact']; 
            } ?>

    <!----- Breadcrumb ----->
    <ul class="breadcrumb">
        <li><a href="project.php" target="_self">Home</a></li>
        <li><?php 
        	if(isset($_SESSION["username"])){
        		echo '<a href="cart.php?uid='.$id.'" target="_blank">Shopping Cart</a>'; 
        	} else { 
        		echo '<a href="account.php" target="_blank">Shopping Cart</a>'; } ?>
        </li>
        <li><a href="" target="_self">Order Confirmation</a></li>
    </ul>
    <!----- Breadcrumb ----->

    <!------- Content -------->
    <div class="container mt-20">
    	<div class="row">
    		<div class="col-auto me-auto">
    			<h1>Order Confirmation</h1>
    		</div>
    		<div class="col-auto">
    			<h2>Order Total: RM55</h2>
    		</div>
    		<div class="col-auto">
    			<a href="placeorder.php" target="_blank" class="button">Place Order</a>
    		</div>
    	</div>
        <!----- User Information ----->
    	<div class="row">
    		<div class="container mt-20 confirmation-container">
    			<div class="row">
    				<div class="col-12 col-md-6">
    					<h4>Your Information</h4>
    					<hr>
                        <p><?php echo $email; ?></p>
                        <p><?php echo $contact; ?></p>
    				</div>
    				<div class="col-12 col-md-6">
    					<h4>Shipping Address</h4>
    					<hr>
                        <input type="radio" id="add1" name="add" class="mr-10"><label for="add1"><?php echo $address; ?></label><br>
                        <input type="radio" id="add2" name="add" class="mr-10"><label for="add2" class="color-blue">Create New Address</label>
    				</div>
    				<div class="col-12 col-md-6">
    					<h4>Payment Method</h4>
    					<hr>
                        <a href="https://www.mastercardconnect.com/mccpblcui/#/public/signin" target="_blank"><input type="submit" name="payment1" value="" class="payment1" ></a>
                        <a href="https://www.paypal.com/my/home?kid=p56012245254&gclid=Cj0KCQjwgtWDBhDZARIsADEKwgOr0gRnze6HctR_XEc8JkUUoVYRutnSBf2m02JBLvaPwueEGFpNo6oaAvHiEALw_wcB&gclsrc=aw.ds" target="_blank"><input type="submit" name="payment2" value="" class="payment2"></a>
    				</div>
    			</div>
    		</div>
    	</div>
        <!----- User Information ----->
    </div>

    <!----- Product List ----->
    <div class="container">
        <div class="row">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th></th>
                        <th>Quantity</th>
                        <th>Shipping Fee</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(mysqli_num_rows($query) > 0) {
                        while($row = mysqli_fetch_assoc($query)){
                            $product_id = $row['product_id'];
                            $shopping_cart = mysqli_query($sql, "SELECT product_img,product_name,ROUND(product_price,2) AS rounded_price,quantity FROM my_cart NATURAL JOIN product WHERE product_id = $product_id");

                                while($row = mysqli_fetch_assoc($shopping_cart)){
                                    $product_name = $row['product_name'];
                                    $product_img = $row['product_img'];
                                    $product_price = $row['rounded_price'];
                                    $quantity = $row['quantity'];
                                    $subtotal = $product_price*$quantity;
                                } ?>
                            <!----- Product Details ----->
                            <tr>
                                <td class="width-100">
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($product_img).'"alt="Product Image '.($product_name).'"class="thumbnail"/>'; ?>
                                </td>
                                <td>
                                    <?php echo $product_name; ?>
                                </td>
                                <td>
                                    <?php echo $quantity; ?>
                                </td>
                                <td>
                                    RM 5
                                </td>
                                <td>
                                    RM <?php echo $subtotal; ?>
                                </td>
                            </tr>
                            <!----- Product Details ----->
                    <?php }
                    } else { // If nothing in cart
                        echo '<td>There is nothing in your shopping cart. <a href="project.php#our-product" target="_blank">Shop now!</a></td>';
                    
                    }?>
                </tbody>
            </table>
        </div>
        <!----- Order Summary ----->
        <div class="row">
            <div class="subtotal-container col-md-4 offset-md-8">
                <hr>
                <div class="row">
                    <div class="col-8 col-md-8">
                        <h5>Subtotal</h5>
                    </div>
                    <div class="col-4 col-md-4">
                        <h5>RM 50</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 col-md-8">
                        <h5>Total Shipping Fee</h5>
                    </div>
                    <div class="col-4 col-md-4">
                        <h5>RM 5</h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-8 col-md-8">
                        <h4>Order Total</h4>
                    </div>
                    <div class="col-4 col-md-4">
                        <h4>RM55</h4>
                    </div>
                </div>
            </div>
        </div>
        <!----- Order Summary ----->
        <div class="row mt-20">
            <div class="col-auto me-auto">
                <a href=<?php echo '"cart.php?uid='.$id.'" target="_self" class="backBtn"';?>><i class="fa fa-angle-double-left"></i> Back to My Cart</a>
            </div>
            <div class="col-auto pr-0">
                <a href="placeorder.php" target="_blank" class="button">Place Order</a>
            </div>
        </div>  
    </div>
    <!----- Product List ----->
    <!------- Content ------->
    
    <!------- Footer ------->
	<div id="footer" class="mt-50"></div>
	<!------- Footer ------->

</body>
</html>