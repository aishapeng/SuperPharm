<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>
    <!------- Header ------->
    <div id="header"></div>
    <!------- Header ------->

    <?php
        include('include/config.php');
        $id = $_GET["pid"];

        $query = mysqli_query($sql, "SELECT * FROM product WHERE product_id = $id");
        if($query === FALSE) { 
           die(mysqli_error());
        }
        while($row = mysqli_fetch_assoc($query)){
            $product_name = $row['product_name'];
            $product_brand = $row['product_brand'];
            $product_img = $row['product_img'];
            $reward_point = $row['reward_point'];
            $description = $row['description'];
            $specification = $row['specification'];
            $product_price = $row['product_price'];
            $availability = $row['availability'];
        }    
	?>

    <p>breadcrumb here</p>

<div style="margin: 50px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($product_img).'"style="width:100%;min-height:350px"/>'; ?>
            </div>
            
            <div class="col-12 col-md-6">
                <div style="padding: 0px 20px">
                    <?php echo '<p class="b">'.$product_name.'</p>'; ?>
                    <hr>
                    
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <p class="b">Brand</p></div>
                        <div class="col-6 col-md-6"> 
                            <?php 
                            if($product_brand === NULL) {
                                echo '<p>-</p>';
                            } else {
                                echo '<p>'.$product_brand.'</p>'; 
                            }?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-6">
                            <p class="b">Reward Points</p></div>
                        <div class="col-6 col-md-6"> 
                            <?php 
                            if($reward_point === NULL) {
                                echo '<p>-</p>';
                            } else {
                                echo '<p>'.$reward_point.'</p>';
                            }?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-6">
                            <p class="b">Availability</p></div>
                        <div class="col-6 col-md-6"> 
                            <?php 
                            if($availability == TRUE) {
                                echo '<p class="in-stock">In Stock</p>';
                            } else {
                                echo '<p class="out-of-stock">Out of Stock</p>';
                            }?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-6">
                            rating here</div>
                        <div class="col-6 col-md-6"> 
                            total rating</div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-6 col-md-6">
                            <p class="price">RM</p></div>
                        <div class="col-6 col-md-6"> 
                            <?php echo '<p class="align-right">'.$product_price.'</p>'; ?>
                        </div>
                    </div>
                    <hr>
                </div>

            </div>
        </div>
    </div>
</div>

    <!------- Footer ------->
    <div id="footer"></div>
    <!------- Footer ------->
</body>
</html>