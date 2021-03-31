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

    <?php
    $query = mysqli_query($sql, "SELECT user_id,email,address,payment_method,contact FROM user");
        while($row = mysqli_fetch_assoc($query)){
            $user_id = $row['user_id'];
            $email = $row['email'];
            $address = $row['address'];
            $payment_method = $row['payment_method'];
            $contact = $row['contact']; 
        } 
    ?>

    <ul class="breadcrumb">
        <li><a href="project.php" target="_self">Home</a></li>
        <li><?php 
        	if(isset($_SESSION["username"])){
        		echo '<a href="cart.php?uid='.$user_id.'" target="_blank">Shopping Cart</a>'; 
        	} else { 
        		echo '<a href="account.php" target="_blank">Shopping Cart</a>'; } ?>
        </li>
        <li><a href="" target="_self">Order Confirmation</a></li>
    </ul>

    <!------- Content -------->
    <div class="container mt-20">
    	<div class="row">
    		<div class="col-auto me-auto">
    			<h1>Order Confirmation</h1>
    		</div>
    		<div class="col-auto">
    			<h2>Order Total: -</h2>
    		</div>
    		<div class="col-auto">
    			<a class="btn">PLACE ORDER</a>
    		</div>
    	</div>
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
                        <p><?php echo $address; ?></p>
    				</div>
    				<div class="col-12 col-md-6">
    					<h4>Payment Method</h4>
    					<hr>
                        <p><?php echo $payment_method; ?></p>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    
    <!------- Footer ------->
	<div id="footer" class="mt-50"></div>
	<!------- Footer ------->

</body>
</html>