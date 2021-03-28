<!DOCTYPE html>
<?php include('include/config.php'); ?>
<html lang="en">
<?php include('head.php'); ?>

<body>

	<!------- Header ------->
	<div id="header"></div>
	<!------- Header ------->

	<!------- Content ------->
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-8">
				<div class="slideshow-container">
					<div class="adSlides">
					 	<img src="media_used/banner1.jpeg" style="width:100%">
					</div>
					<div class="adSlides">
					 	<img src="media_used/banner2.jpeg" style="width:100%">
					</div>
					<div class="adSlides">
					 	<img src="media_used/banner3.jpeg" style="width:100%">
					</div>
				</div>
				<div style="text-align:center">
				 	<span class="dot" onclick="currentSlide(1)"></span> 
				 	<span class="dot" onclick="currentSlide(2)"></span> 
				 	<span class="dot" onclick="currentSlide(3)"></span> 
				</div>

				<script>
					var slideIndex = 0;
					showSlides(slideIndex);

					function plusSlides(n) {
					  showSlides(slideIndex += n);
					}

					function currentSlide(n) {
					  showSlides(slideIndex = n);
					}

					function showSlides(n) {
						var i;
						var slides = document.getElementsByClassName("adSlides");
						var dots = document.getElementsByClassName("dot");
						for (i = 0; i < slides.length; i++) {
						slides[i].style.display = "none";  
						}
						slideIndex++;
						if (slideIndex > slides.length) {slideIndex = 1}    
						for (i = 0; i < dots.length; i++) {
						dots[i].className = dots[i].className.replace(" active", "");
						}
						slides[slideIndex-1].style.display = "block";  
						dots[slideIndex-1].className += " active";
						setTimeout(showSlides, 5000); // Change image every 5 seconds
					}
				</script>    
	        </div>
	        <!---------- Login Form ------------>
	        <div class="col-12 col-md-4">
	            <?php
			    require('include/config.php');
			    session_start();
			    // When form submitted, check and create user session.
			    if (isset($_POST['username'])) {
			        $username = stripslashes($_REQUEST['username']);    // removes backslashes
			        $username = mysqli_real_escape_string($sql, $username);
			        $password = stripslashes($_REQUEST['password']);
			        $password = mysqli_real_escape_string($sql, $password);
			        // Check user is exist in the database
			        $query    = "SELECT * FROM `user` WHERE username='$username'
			                     AND password='$password'";
			        $result = mysqli_query($sql, $query) or die(mysql_error());
			        $rows = mysqli_num_rows($result);
			        if ($rows == 1) {
			            $_SESSION['username'] = $username;
			            // Redirect to user dashboard page
			            echo "<div class='form'>
			        			<br><br>
			        			<h3>Hi, <strong>".$username."</strong><br><br>
			                 	<h3>You have Successfully Logged In</h3>
			                 	<p class='link'><a href='logout.php'>Logout</h3></p>
			                  </div>";
			        } else {
			            echo "<div class='form'>
			                  <h3>Incorrect Username/password.</h3><br/>
			                  <p class='link'>Click here to <a href='index.php'>Login</a> again.</p>
			                  </div>";
			        }
			    } else {
				?>
				    <form class="form" method="post" name="login">
				        <h1 class="login-title">Login</h1>
				        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
				        <input type="password" class="login-input" name="password" placeholder="Password"/>
				        <input type="submit" value="Login" name="submit" class="login-button"/>
				        <p class="link"><a href="registration.php">New Registration</a></p>
				  </form>
				<?php
    				}
    			?>
	        </div>
	        <!---------- Login Form ------------>
	    </div>
	</div>


	<div class="category">
		<p class="title">Shop By Category</p>
		<hr class="separator">
		<div class="scrollmenu">
			<?php
			$query = mysqli_query($sql, "SELECT * FROM category");
			if(mysqli_num_rows($query) > 0) {
				while($row = mysqli_fetch_assoc($query)){
					echo '<button class="categoryBtn">'.$row['category_name'].'</button>';
				}
			}?>
		</div>
	</div>

	<div class="category">
		<p class="title">Shop By Condition</p>
		<hr class="separator">
		<div class="scrollmenu">
			<?php
			$query = mysqli_query($sql, "SELECT * FROM health_condition");
			if(mysqli_num_rows($query) > 0) {
				while($row = mysqli_fetch_assoc($query)){
					echo '<button class="categoryBtn">'.$row['condition_name'].'</button>';
				}
			}?>
		</div>
	</div>
	

	<div class="category">
		<p class="title">Our Products</p>
		<hr class="separator">	

		<div class="product-container">
			<div class="container">
				<div class="row">
					<?php
						$query = mysqli_query($sql, "SELECT * FROM product");
						if(mysqli_num_rows($query) > 0) {
							while($row = mysqli_fetch_assoc($query)){
								echo '<div class="col-12 col-md-4"><a href="product.php"><img src="data:image/jpeg;base64,'.base64_encode( $row['product_img'] ).'"style=width:100%;/></a>';
								echo '<a href="product.php" class="product-container">'.$row['product_name'].'</a>';
								echo '<p class="product-container">RM '.$row['product_price'].'</p></div>';
							}
						}?>
				</div>
			</div>
		</div>
	</div>



	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <br>    
	<!------- Content ------->

	<!------- Footer ------->
	<?php include('footer.php'); ?>
	<!------- Footer ------->

</body>
</html>