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
        $id = $_GET["pid"];

        $query = mysqli_query($sql, "SELECT product_img,product_name, product_brand,reward_point,description,specification,ROUND(product_price,2) AS rounded_price,availability FROM product WHERE product_id = $id");
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
            $product_price = $row['rounded_price'];
            $availability = $row['availability'];
        }

        $users = mysqli_query($sql, "SELECT user_id FROM user");
        while($row = mysqli_fetch_assoc($users)){
            $user_id = $row['user_id'];
        }
        if(isset($_POST['save'])){ 
            $user_id = $_POST['user_id'];  
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $cart = "INSERT INTO my_cart (user_id,product_id,quantity)
            VALUES ('$user_id','$product_id','$quantity')";
            if (mysqli_query($sql, $cart)) {
                echo "New record created successfully !";
            } else {
                echo "Error: " . $cart . " " . mysqli_error($sql);
             }
             mysqli_close($sql);
        }

	?>

    <ul class="breadcrumb">
        <li><a href="project.php" target="_self">Home</a></li>
        <li><a href="project.php#our-product" target="_self">Our Product</a></li>
        <li><a href="" target="_self"><?php echo $product_name; ?></a></li>
    </ul>

    <div class="mt-50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-5">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($product_img).'"alt="Product Image" class="product"/>'; ?>
                </div>
                
                <div class="col-12 col-md-7">
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
                            <div class="col-12 col-md-12">
                                <span class="fa fa-star rating checked"></span>
                                <span class="fa fa-star rating checked"></span>
                                <span class="fa fa-star rating checked"></span>
                                <span class="fa fa-star rating"></span>
                                <span class="fa fa-star rating"></span>
                                <span> (100 reviews)</span>
                            </div>
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

                        <form method="post" action="">
                            <input type="hidden" name="user_id" value=<?php echo '"'.$user_id.'"'; ?>>
                            <input type="hidden" name="product_id" value=<?php echo '"'.$id.'"'; ?>>
                            
                            <div class="row">    
                                <div class="col-4 col-md-8 align-end">
                                    <div class="quantity buttons_added">
                                        <input type="button" value="-" class="minus">
                                        <input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                        <input type="button" value="+" class="plus">
                                    </div>
                                </div>
                                <div class="col-4 col-md-2 align-end">
                                    <?php 
                                    if($availability==1){ echo '<input type="submit" name="save" value="" class="add">';
                                    }?>
                                </div>
                                <div class="col-4 col-md-2">
                                    <a class="wishlist" href="" target="_self" title="Add To Wishlist"><i class="fa fa-heart"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="tabset">
                            <!-- Tab 1 -->
                            <input type="radio" name="tabset" id="tab1" aria-controls="description" checked>
                            <label for="tab1">Description</label>
                            <!-- Tab 2 -->
                            <input type="radio" name="tabset" id="tab2" aria-controls="specification">
                            <label for="tab2">Specification</label>
                            <!-- Tab 3 -->
                            <input type="radio" name="tabset" id="tab3" aria-controls="reviews">
                            <label for="tab3">Reviews</label>
                          
                            <div class="tab-panels">
                                <section id="description" class="tab-panel">
                                    <h2>Description</h2>
                                    <br>
                                    <p>
                                        <?php 
                                        if($description === NULL){
                                            echo '--- No Description ---';
                                        } else {
                                            echo $description;
                                        }?>    
                                    </p>
                                </section>
                                <section id="specification" class="tab-panel">
                                    <h2>Specification</h2>
                                    <br>
                                    <p>
                                        <?php 
                                        if($specification === NULL){
                                            echo '--- No Specification ---';
                                        } else {
                                            echo $specification;
                                        }?>    
                                    </p>
                                </section>
                                <section id="reviews" class="tab-panel">
                                    <h2>Reviews</h2>
                                    <br>
                                    <div class="row rating-container">
                                        <h5>Product Rating</h5>
                                        <div class="col-6 col-md-4">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="text-bold text-red">4.5/5.0 (100 reviews)</span>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <div class="row">
                                                <div class="col-6 col-md-3 rating">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span>(20)</span>
                                                </div>
                                                <div class="col-6 col-md-3 rating">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span>(30)</span>
                                                </div>
                                                <div class="col-6 col-md-3 rating">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span>(30)</span>
                                                </div>
                                                <div class="col-6 col-md-3 rating">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span>(10)</span>
                                                </div>
                                                <div class="col-6 col-md-3 rating">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span>(10)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="mt-20">
                                        <div class="row">
                                            <div class="col-3 col-md-2">
                                                <img src="media_used/user.png" class="user">
                                            </div>
                                            <div class="col-9 col-md-10">
                                                <div class="row">
                                                    <p class="b">Username</p>
                                                </div>
                                                <div class="rating">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span>(4.0)</span>
                                                </div>
                                                <div class="row">
                                                    <p>Comment here here here.</p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-3 col-md-3">
                                                        <img src="media_used/review1.jpg" class="review">
                                                    </div>
                                                    <div class="col-3 col-md-3">
                                                        <img src="media_used/review2.jpg" class="review">
                                                    </div>
                                                    <div class="col-3 col-md-3">
                                                        <img src="media_used/review3.jpg" class="review">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-50">
                                            <div class="col-10 col-md-10">
                                                <input type="text" name="review" class="full-width">
                                            </div>
                                            <div class="col-1 col-md-1">
                                                <input type="submit" value="" name="sendimage" class="image">
                                            </div>
                                            <div class="col-1 col-md-1">
                                                <input type="submit" value="" name="review" class="review">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------- Footer ------->
    <div id="footer" class="mt-50"></div>
    <!------- Footer ------->
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
</body>
</html>