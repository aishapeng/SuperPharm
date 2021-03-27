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
	<link rel="shortcut icon" href="icon/capsules.svg"/>
</head>
<body>

	<!------- Header ------->
	<div id="header"></div>
	<!------- Header ------->

	<!------- Content ------->
    <div class="container">
        <div class="row">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pictures</a></li>
                <li><a href="#">Summer 15</a></li>
                <li>Italy</li>
            </ul>
        </div>

        <div class="row">
            <div class="filter col-3">
                <h3 class="title">Filter</h3>
                <hr>
                    <h4>Price</h4>
                    <div class="slidecontainer">
                        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                    </div>
                    <p class="text-center">RM xxx</p>
                <br>
                    <h4>Brand</h4>
                    <?php
                        $query = mysqli_query($sql, "SELECT product_brand FROM product");
                        if(mysqli_num_rows($query) > 0) {
                            echo '<ul>';
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<li><a href=#>'.$row['product_brand'].'</a></li>';
                            }
                            echo '</ul>';
                    }?>
                <br>
                    <h4>Category</h4>
                    <?php
                        $query = mysqli_query($sql, "SELECT category_name FROM category");
                        if(mysqli_num_rows($query) > 0) {
                            echo '<ul>';
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<li><a href=#>'.$row['category_name'].'</a></li>';
                            }
                            echo '</ul>';
                    }?>
                <br>
                    <h4>Condition</h4>
                    <?php
                        $query = mysqli_query($sql, "SELECT condition_name FROM health_condition");
                        if(mysqli_num_rows($query) > 0) {
                            echo '<ul>';
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<li><a href=#>'.$row['condition_name'].'</a></li>';
                            }
                            echo '</ul>';
                    }?>
            </div>

            <div class="col-9">
            
            </div>
        </div>
    </div>
	<!------- Content ------->

	<!------- Footer ------->
	<div id="footer"></div>
	<!------- Footer ------->

</body>
</html>