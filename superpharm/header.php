<?php 
require('include/config.php'); 
include('auth_session.php'); 

$query = mysqli_query($sql, "SELECT * FROM user");
while($row = mysqli_fetch_assoc($query)){
	$user_id = $row['user_id'];
}?>
<div class="header">
	<div class="container header-width">
		<div class="row">
			<div class="col-auto me-auto">
	  			<a href="project.php" target="_self"><img src="icon/logo.png" alt="SuperPharm" class="logo"/></a></div>
	  		<!----- My Account Dropdown Menu ----->
            <div class="col-auto">
	  			<?php
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
            <!----- My Account Dropdown Menu ----->
	  	</div>
	</div>
</div>

<!----- Sticky Navigation Bar ----->
<!----- Category Sidebar ----->
<div id="mySidebar" class="sidebar">
	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
	<br>
	<?php
	$query = mysqli_query($sql, "SELECT * FROM category");

	if(mysqli_num_rows($query) > 0) {
		while($row = mysqli_fetch_assoc($query)){
			echo '<a href="product.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a><hr class="sidebar-line">';
		}
	}?>
</div>
<!----- Category Sidebar ----->

<div id="navbar">
	<a href="project.php" target="_self" class="active">Home</a>
	<a id="main" class="categoryBtn" href="javascript:openNav()">☰ Categories</a>
	<form class="search search-bar" action="">
		<input type="text" placeholder="What are you looking for" name="search">
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
  	<?php echo '<a href="cart.php?uid='.$user_id.'" target="_blank" class="fl-right"><img src="icon/cart.svg" alt="My Cart" class="my-cart-icon"></a>'; ?>
</div>
<!----- Sticky Navigation Bar ----->

<!------- Go to top button ------->
<button onclick="topFunction()" id="goToTopBtn" title="Go to top"><i class='fas fa-chevron-up'></i></button>
<!------- Go to top button ------->

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

    ///// Ad Images /////
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
    ////////////////////

    ///// Sidebar /////
	function openNav() {
	  	document.getElementById("mySidebar").style.width = "200px";
	  	document.getElementById("main").style.marginLeft = "200px";
	}

	function closeNav() {
	  	document.getElementById("mySidebar").style.width = "0";
	  	document.getElementById("main").style.marginLeft= "0";
	}
    ///////////////////

    ///// Edit Information Form /////
    function openEditForm() {
        document.getElementById("popupForm").style.display = "block";
      }
  	function closeEditForm() {
    	document.getElementById("popupForm").style.display = "none";
  	}
    ///////////////
</script>