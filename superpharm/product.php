<!DOCTYPE html>
<?php 
include('include/config.php'); 
include('auth_session.php'); ?>
<html lang="en">
<?php include('head.php'); ?>

<body>

	<!------- Header ------->
	<div id="header"></div>
	<!------- Header ------->

    <?php
        $id = $_GET["catid"];
        $categories = mysqli_query($sql, "SELECT * FROM category WHERE category_id = $id");
            while($row = mysqli_fetch_assoc($categories)){
                $category_name = $row['category_name'];
            } 
    ?>
    <!------- Content ------->
    <div class="row">
        <ul class="breadcrumb">
            <li><a href="project.php" target="_self">Home</a></li>
            <li><a href="#"><?php echo $category_name; ?></a></li>
        </ul>
    </div>
    <div class="container">
        <div class="row">
            <div class="filter col-3 c0l-md-3">
                <h3 class="title">Filter</h3>
                <hr>
                    <p class="b">Price</p>
                    <div class="slidecontainer">
                        <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                    </div><br>
                    <p class="center">RM xxx</p>
                <br>
                    <p class="b">Brand</p>
                    <?php
                        $query = mysqli_query($sql, "SELECT category_name FROM category LIMIT 13,17");
                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<label class="checkbox-container">'.$row['category_name'].'
                                      <input type="checkbox">
                                      <span class="checkmark"></span>
                                    </label>';
                            }
                    }?>
                <br>
                    <p class="b">Category</p>
                    <?php
                        $query = mysqli_query($sql, "SELECT category_name FROM category LIMIT 0,5");
                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<label class="checkbox-container">'.$row['category_name'].'
                                      <input type="checkbox">
                                      <span class="checkmark"></span>
                                    </label>';
                            }
                    }?>
                <br>
                    <p class="b">Condition</p>
                    <?php
                        $query = mysqli_query($sql, "SELECT category_name FROM category LIMIT 5,13");
                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<label class="checkbox-container">'.$row['category_name'].'
                                      <input type="checkbox">
                                      <span class="checkmark"></span>
                                    </label>';
                            }
                    }?>
            </div>

            <div class="col-9 col-md-9">
                <div class="container">
                    <div class="row">
                        <h1><?php echo $category_name; ?></h1>
                    </div>

                    <div class="row">
                        <?php 
                        $category_products = mysqli_query($sql, "SELECT product_id FROM product_category WHERE category_id = $id");

                        if(mysqli_num_rows($category_products) > 0) {
                            while($row = mysqli_fetch_assoc($category_products)){
                                $product_id = $row['product_id'];
                                $products_details = mysqli_query($sql, "SELECT product_img,product_name,ROUND(product_price,2) AS rounded_price FROM product NATURAL JOIN product_category WHERE product_id = $product_id AND category_id = $id");
                                    while($row = mysqli_fetch_assoc($products_details)){
                                        $product_img = $row['product_img'];
                                        $product_name = $row['product_name'];
                                        $product_price = $row['rounded_price'];
                                    ?>
                                        <div class="col-6 col-md-4 mt-20">
                                            <?php echo '<a href="product-detail.php?pid='.$product_id.'" target="_blank"><img src="data:image/jpeg;base64,'.base64_encode($product_img).'" alt="Product image" class="full-width"/>'; ?></a>
                                            <div class="row">
                                                <div class="col-auto me-auto">
                                                    <?php echo '<a href="product-detail.php?pid='.$product_id.'" target="_blank"  class="product-txt">'.$product_name.'</a>'; ?>
                                                </div>
                                                <div class="col-auto">
                                                    <?php echo '<p>RM '.$product_price.'</p>'; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }

                            }
                        } else {
                            echo '<h2 class="message-container mt-50">--- No product in this category ---</h2>';
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------- Content ------->

	<!------- Footer ------->
    <div id="footer" class="mt-50"></div>
    <!------- Footer ------->

</body>
</html>