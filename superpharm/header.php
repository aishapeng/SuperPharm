<?php 
require('include/config.php'); 
include('auth_session.php');
?>
<div class="header">
	<div class="container" style="margin:0px; max-width: 1500px;">
		<div class="row">
			<div class="col-auto me-auto">
	  			<a href="index.php"><img src="icon/logo.png" class="logo" alt="SuperPharm"></a></div>
	  		<div class="col-auto">
	  			<!-- <button class="button">My Account</button>-->
	  			<?php 
				$query = mysqli_query($sql, "SELECT * FROM user");

					while($row = mysqli_fetch_assoc($query)){
						$user_id = $row['user_id'];
					}
	  			if(!isset($_SESSION["username"])){
	  			 	echo '<div class="dropdown">
	  				<button class="dropbtn">My Account</button>
	  				<div class="dropdown-content">
	  					<a href="account.php">Login</a>
	  				</div>';
	  			} else {
					echo '<div class="dropdown">
	  				<button class="dropbtn">My Account</button>
	  				<div class="dropdown-content">
	  					<a href="account.php?uid='.$user_id.'" target="_blank">Profile</a>
	  					<a href="logout.php">Logout</a>
	  				</div>';
	  			}?>
				</div>
	  		</div>
	  	</div>
	</div>

<!------------ Not responvise gor --------------->
<!------- Navigation Bar ------->
<div id="mySidebar" class="sidebar">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
	<?php
	$query = mysqli_query($sql, "SELECT * FROM category");
	$query2 = mysqli_query($sql, "SELECT * FROM health_condition");

	if(mysqli_num_rows($query) > 0) {
		while($row = mysqli_fetch_assoc($query)){
			echo '<a href="#">'.$row['category_name'].'</a><hr class="sidebar-line">';
		}
	}

	if(mysqli_num_rows($query2) > 0) {
		while($row = mysqli_fetch_assoc($query2)){
			echo '<a href="#">'.$row['condition_name'].'</a><hr class="sidebar-line">';
		}
	}?>
</div>

<div id="navbar">
	<a id="main" class="caregoryBtn" href="javascript:openNav()">☰ Categories</a>
	<form class="search" action="" style="float: left; width: 50%">
		<input type="text" placeholder="What are you looking for" name="search">
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
  	<a href="cart.php" style="float:right;"><img src="icon/cart.svg" alt="My Cart" style="width:32px; height:25px"></a>
</div>
<!------- Navigation Bar ------->

<!-- Go to top button -->
<button onclick="topFunction()" id="goToTopBtn" title="Go to top"><i class='fas fa-chevron-up'></i></button>
<!-- Go to top button -->

<script>
	window.onscroll = function() {
		myFunction()
	};

	var navbar = document.getElementById("navbar");
	var sticky = navbar.offsetTop;

	function myFunction() {
		if (window.pageYOffset >= sticky) {
			navbar.classList.add("sticky")
		} else {
			navbar.classList.remove("sticky");
		}
    	if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		document.getElementById("goToTopBtn").style.display = "block";
		} else {
		  	document.getElementById("goToTopBtn").style.display = "none";
		}
	}

	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}

	function openNav() {
	  	document.getElementById("mySidebar").style.width = "200px";
	  	document.getElementById("main").style.marginLeft = "200px";
	}

	function closeNav() {
	  	document.getElementById("mySidebar").style.width = "0";
	  	document.getElementById("main").style.marginLeft= "0";
	}
</script>