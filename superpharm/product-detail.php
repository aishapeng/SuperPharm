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

    <div class="mt-50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($product_img).'"alt="Product Image" class="product"/>'; ?>
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

                        <div class="row">
                            <div class="col-4 col-md-6" class="align-end">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1" max="" name="quantity" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                            <div class="col-4 col-md-3 align-end">
                                <a class="btn" href="" target="_self" title="Add To Cart"><img src="icon/add-to-cart.svg" alt="Add to Cart" class="cart"/></a>
                            </div>
                            <div class="col-4 col-md-3 align-end">
                                <a class="btn wishlist" href="" target="_self" title="Add To Wishlist"><i class="fa fa-heart"></i></a>
                            </div>
                        </div>
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
                                    <p>review here</p>
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

    <script>
        function wcqib_refresh_quantity_increments() {
        jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
            var c = jQuery(b);
            c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
            })
        }
        String.prototype.getDecimals || (String.prototype.getDecimals = function() {
            var a = this,
                b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
        }), jQuery(document).ready(function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("updated_wc_div", function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("click", ".plus, .minus", function() {
            var a = jQuery(this).closest(".quantity").find(".qty"),
                b = parseFloat(a.val()),
                c = parseFloat(a.attr("max")),
                d = parseFloat(a.attr("min")),
                e = a.attr("step");
            b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
        });
    </script>
</body>
</html>