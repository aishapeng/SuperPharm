<!DOCTYPE html>
<?php include('include/config.php'); ?>
<html lang="en">
<?php include('head.php'); ?>

<body>

	<!------- Header ------->
	<div id="header"></div>
	<!------- Header ------->

    <?php
        $id = $_GET["catid"];
        $query = mysqli_query($sql, "SELECT * FROM product_category NATURAL JOIN category WHERE category_id = $id");

        if($query === FALSE) { 
           die(mysqli_error());
        }
        while($row = mysqli_fetch_assoc($query)){
            $category_name = $row['category_name'];

    } ?>
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
                        $query = mysqli_query($sql, "SELECT product_brand FROM product");
                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<label class="checkbox-container">Brand name
                                      <input type="checkbox">
                                      <span class="checkmark"></span>
                                    </label>';
                            }
                    }?>
                <br>
                    <p class="b">Category</p>
                    <?php
                        $query = mysqli_query($sql, "SELECT category_name FROM category");
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
                        $query = mysqli_query($sql, "SELECT condition_name FROM health_condition");
                        if(mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_assoc($query)){
                                echo '<label class="checkbox-container">'.$row['condition_name'].'
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