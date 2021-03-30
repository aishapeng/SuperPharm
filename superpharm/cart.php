<!DOCTYPE html>
<?php 
require('include/config.php');
include('auth_session.php'); ?>
<html lang="en">
<?php include('head.php'); ?>

<body>
	<!------- Header ------->
	<div id="header"></div>
	<!------- Header ------->
    <ul class="breadcrumb">
        <li><a href="project.php" target="_self">Home</a></li>
        <li><a href="" target="_self">Shopping Cart</a></li>
    </ul>

	<?php
		if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
		
        $id = $_GET["uid"];

        $query = mysqli_query($sql, "SELECT * FROM my_cart WHERE user_id = $id");
        if($query === FALSE) { 
           die(mysqli_error());
        }

		    echo '<div class="container">
		    	<div class="row"><h1>Shopping Cart</h1></div>
		        <div class="row">
		    		<div class="col-12 col-md-9">	
					    <table class="styled-table">
						    <thead>
						        <tr>
						            <th>Product</th>
						            <th></th>
						            <th>Quantity</th>
						            <th>Price</th>
						            <th></th>
						        </tr>
						    </thead>
						    <tbody>';

        while($row = mysqli_fetch_assoc($query)){
            $product_id = $row['product_id'];

            $shopping_cart = mysqli_query($sql, "SELECT product_img,product_name,ROUND(product_price,2) AS rounded_price,quantity FROM my_cart NATURAL JOIN product WHERE product_id = $product_id");

            if($shopping_cart===NULL){
            	echo '<h1 class="center">No Item in your cart</h1>';
            }
	        while($row = mysqli_fetch_assoc($shopping_cart)){
	            $product_name = $row['product_name'];
	            $product_img = $row['product_img'];
	            $product_price = $row['rounded_price'];
	            $quantity = $row['quantity'];
	            $subtotal = $product_price*$quantity;
	        } ?>
		    		<tr>
			            <td class="width-100">
			            	<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($product_img).'" alt="Product image" class="thumbnail"/>'; ?>
	            		</td>
			            <td>
			            	<?php echo $product_name; ?>
			            </td>
			            <td>
			            	<div class="quantity buttons_added">
	                    <input type="button" value="-" class="minus">
	                    <?php echo '<input type="number" step="1" min="1" max="" name="quantity" value="'.$quantity.'" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">'; ?>
	                    <input type="button" value="+" class="plus">
	           				</div>
	            		</td>
	            		<td>
	            			RM <?php echo $subtotal; ?>
	            		</td>
	            		<td class="pos-absolute">
	            			<a href="#" title="Remove" target="_self" class="bin"><i class="fa fa-trash"></i></a>
	            		</td>
		        	</tr>
		        <?php } ?>
			    	</tbody>
				</table>
			</div>

			<div class="col-12 col-md-3">
				<div class="order-summary">
					<p class="center b">ORDER SUMMARY</p>
					<hr>
					<div class="row">
						<div class="col-6 col-md-6">
							<p>Items: </p>
						</div>
						<div class="col-6 col-md-6">
							<p>RM </p>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<form action="">
							  	<label for="shipping">Shipping</label>
							  	<select name="shippings" id="shippings" class="full-width">
							    	<option value="jnt">J&T</option>
							    	<option value="pos">Pos Laju</option>
								</select>
							</form>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<br>
							<form action="">
								<label for="shipping">Promo Code</label>
								<input type="" name="" class="full-width">
							</form>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-6 col-md-6">
							<p class="center b">TOTAL</p>
						</div>
						<div class="col-6 col-md-6">
							<p>RM</p>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-12">
							<?php echo '<a class="checkoutBtn full-width" href="checkout.php?uid='.$id.'" target="_blank">Checkout</a>'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="row">
				<div class="col-6 col-md-3">
					<a href="project.php" class="backBtn"><i class="fa fa-angle-double-left"></i> Continue Shopping</a>
				</div>
			</div>	
	</div>
	<?php 
		
		}else {
				echo '<div class="message-container"><h1>Please <a href="account.php">log in</a> first.</h1></div>';
			} ?>

	<!------- Footer ------->
	<div id="footer" class="mt-50"></div>
	<!------- Footer ------->
</body>
</html>