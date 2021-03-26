<!DOCTYPE html>
<?php include('include/config.php'); ?>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<title>SuperPharm</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>
	<link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script> 
		$(function(){
	  		$("#header").load("header.html"); 
	  		$("#footer").load("footer.html"); 
		});
	</script> 
	<link rel="shortcut icon" href="capsules.svg"/>
</head>
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
					 	<img src="banner1.jpeg" style="width:100%">
					</div>
					<div class="adSlides">
					 	<img src="banner2.jpeg" style="width:100%">
					</div>
					<div class="adSlides">
					 	<img src="banner3.jpeg" style="width:100%">
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
	        <div class="col-12 col-md-4">
	            <p>login/register form here</p>
	        </div>
	    </div>
	</div>


	<div class="category">
		<p class="title">Shop By Category</p>
		<br>
		<div class="scrollmenu">
			<?php
			$query = mysqli_query($sql, "SELECT * FROM category");
			while($row = mysqli_fetch_assoc($query)){
				$category_name = $row["category_name"];
			}?>
			
			<button class="categoryBtn"><?php echo $category_name; ?></button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
		</div>
	</div>

	<div class="category">
		<p class="title">Shop By Condition</p>
		<br>
		<div class="scrollmenu">
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
			<button class="categoryBtn">Testing</button>
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
	<div id="footer"></div>
	<!------- Footer ------->

</body>
</html>