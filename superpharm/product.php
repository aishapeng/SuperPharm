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