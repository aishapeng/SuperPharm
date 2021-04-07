<!DOCTYPE html>
<?php 
require('include/config.php');
include('auth_session.php'); ?>
<html lang="en">
<?php include('head.html'); ?>

<body>
	<!------- Header ------->
	<div id="header"></div>
	<!------- Header ------->
	
    <ul class="breadcrumb">
        <li><a href="project.php" target="_self">Home</a></li>
        <li><a href="" target="_self">Shopping Cart</a></li>
    </ul>

    <!------- Content ------->
	<?php
		if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
		
        $id = $_GET["uid"];
        $query = mysqli_query($sql, "SELECT * FROM my_cart WHERE user_id = $id");
        if($query === FALSE) { 
           die(mysqli_error());
        }

        $users = mysqli_query($sql, "SELECT user_id FROM user");
        while($row = mysqli_fetch_assoc($users)){
            $user_id = $row['user_id'];
        }
        
        if(isset($_POST['delete'])){ 
            $product_id = $_POST['product_id'];

            $cart = "DELETE FROM my_cart WHERE product_id = $product_id AND user_id = $id";
            if (mysqli_query($sql, $cart)) {
                header("Refresh:0");
            } else {
                echo "Error: " . $cart . " " . mysqli_error($sql);
             }
             mysqli_close($sql);
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

        if(mysqli_num_rows($query) > 0) { //If got item in cart table
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
		        	<!------- Show Product List ------->
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
	            		<td class="align">

	            			<form method="post" action="">
	            				<input type="hidden" name="product_id" value=<?php echo '"'.$product_id.'"'; ?>>
	            				<input type="submit" name="delete" value="" class="remove">
	            			</form>
	            		</td>
		        	</tr>
		        <?php }
				} else {
					echo '<td>There is nothing in your shopping cart. <a href="project.php#our-product" target="_blank">Shop now!</a></td>';
				
		        }?>
			    	</tbody>
				</table>
				<div class="col-12 col-md-6 mb-20">
					<a href="project.php" class="backBtn"><i class="fa fa-angle-double-left"></i> Continue Shopping</a>
				</div>
			</div>

			<!------- Order Summary ------->
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
						<div class="col-12 col-md-12 center">
							<?php echo '<a class="button" href="checkout.php?uid='.$id.'" target="_blank">Checkout</a>'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php 
		} else {
				echo '<div class="message-container"><h1>Please <a href="account.php">log in</a> first.</h1></div>';
			} ?>
	<!------- Content ------->

	<!------- Footer ------->
	<div id="footer" class="mt-50"></div>
	<!------- Footer ------->
</body>
</html>