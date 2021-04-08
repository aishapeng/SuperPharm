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

	<!------- Content ------->
	<div class="container">
		<div class="row">
			<!----- Ad Images ----->
			<div class="col-12 col-md-8">
				<div class="slideshow-container">
					<div class="adSlides">
					 	<img src="media_used/banner1.jpeg" alt="Ad image" class="full-width">
					</div>
					<div class="adSlides">
					 	<img src="media_used/banner2.jpeg" alt="Ad image" class="full-width">
					</div>
					<div class="adSlides">
					 	<img src="media_used/banner3.jpeg" alt="Ad image" class="full-width">
					</div>
				</div>
				<div class="center">
				 	<span class="dot" onclick="currentSlide(1)"></span> 
				 	<span class="dot" onclick="currentSlide(2)"></span> 
				 	<span class="dot" onclick="currentSlide(3)"></span> 
				</div>  
	        </div>
	        <!----- Ad Images ----->

	        <!------ Login ------->
	        <div class="col-12 col-md-4">
	            <?php
			    if(!isset($_SESSION["username"])) {

			    if (isset($_POST['username'])) {
			        $username = stripslashes($_REQUEST['username']);
			        $username = mysqli_real_escape_string($sql, $username);
			        $password = stripslashes($_REQUEST['password']);
			        $password = mysqli_real_escape_string($sql, $password);
			        $query    = "SELECT * FROM `user` WHERE username='$username'
			                     AND password='$password'";
			        $result = mysqli_query($sql, $query) or die(mysql_error());
			        $rows = mysqli_num_rows($result);

			        if ($rows == 1) {
			            $_SESSION['username'] = $username;
			            header("Refresh:0");
			        } else {
			            echo '<div class="form">
			                  <h3>Incorrect Username/password.</h3><br/>
			                  <p style="text-align: center">Click here to <a href="project.php" target="_self">Login</a> again.</p>
			                  </div>';
			        }
			    } else {
				?>
				    <form class="form" method="post" name="login">
				        <h1 class="login-title">Login</h1>
				        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
				        <input type="password" class="login-input" name="password" placeholder="Password"/>
				        <input type="submit" value="Login" name="submit" class="login-button"/>
				        <p class="link" style="text-align: center"><a href="account.php" target="_self">New Registration</a></p>
				  	</form>
				<?php
    				}
    			}
    			 else {
    				echo '<div class="form">
			        		<br><br><br><br>
			               	<h3>You have Successfully Logged In</h3>
			               	<p class="link center"><a href="logout.php" target="_self">Logout</a></p>
			  	          </div>';
    			}
    			?>
	        </div>
	        <!----- Login Form ----->
	    </div>
	</div>

	<!----- Category Slider ----->
	<div class="category">
		<p class="title">Shop By Category</p>
		<hr class="separator">
		<div class="scrollmenu">
			<?php
			$query = mysqli_query($sql, "SELECT * FROM category LIMIT 0,5");
			if(mysqli_num_rows($query) > 0) {
				while($row = mysqli_fetch_assoc($query)){
					echo '<a class="categoryHomeBtn" href="product.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
				}
			}?>
		</div>
	</div>

	<div class="category">
		<p class="title">Shop By Condition</p>
		<hr class="separator">
		<div class="scrollmenu">
			<?php
			$query = mysqli_query($sql, "SELECT * FROM category LIMIT 5,13");
			if(mysqli_num_rows($query) > 0) {
				while($row = mysqli_fetch_assoc($query)){
					echo '<a class="categoryHomeBtn" href="product.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
				}
			}?>
		</div>
	</div>
	<!----- Category Slider ----->

	<!----- Product List ----->
	<div class="category">
		<a id="our-product"></a>
		<p class="title">Our Products</p>
		<hr class="separator">	
		<div class="product-container">
			<div class="container">
				<div class="row">
					<?php
						$query = mysqli_query($sql, "SELECT product_id,product_img,product_name,ROUND(product_price,2) AS rounded_price FROM product");

						if(mysqli_num_rows($query) > 0) {
							while($row = mysqli_fetch_assoc($query)){
								$product_id = $row['product_id'];
								$product_name = $row['product_name'];
								$product_img = $row['product_img'];
								$product_price = $row['rounded_price'];

								if(!isset($_SESSION["username"])){
								echo '<div class="col-12 col-md-4 mb-0 pt-50"><a href="product-detail.php?pid='.$product_id.'" target="_blank"><img src="data:image/jpeg;base64,'.base64_encode($product_img).'" alt="Product image" class="full-width"/></a>';
								echo '<a href="product-detail.php?pid='.$product_id.'" target="_blank" class="align-left">'.$product_name.'</a>';
								echo '<div class="row"><div class="col-auto me-auto ml-20"><span class="fa fa-star rating checked"></span><span class="fa fa-star rating checked"></span><span class="fa fa-star rating checked"></span><span class="fa fa-star rating"></span><span class="fa fa-star rating"></span></div>';
								echo '<div class="col-auto mr-20">RM '.$product_price.'</div></div></div>';
								} else {
									echo '<div class="col-12 col-md-4 pt-50"><a href="product-detail.php?pid='.$product_id.'" target="_blank"><img src="data:image/jpeg;base64,'.base64_encode($product_img).'" alt="Product image" class="full-width"/></a>';
									echo '<a href="product-detail.php?pid='.$product_id.'" target="_blank" class="align-left">'.$product_name.'</a>';
									echo '<div class="row"><div class="col-auto me-auto ml-20"><span class="fa fa-star rating checked"></span><span class="fa fa-star rating checked"></span><span class="fa fa-star rating checked"></span><span class="fa fa-star rating"></span><span class="fa fa-star rating"></span></div>';
									echo '<div class="col-auto mr-20">RM '.$product_price.'</div></div></div>';
								}
							}
						}?>
				</div>
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