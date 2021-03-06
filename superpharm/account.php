<!DOCTYPE html>
<html lang="en">

<?php
require('include/config.php');
include('auth_session.php');
include('head.html'); ?>

<body>
    <!------- Header ------->
    <div id="header"></div>
    <!------- Header ------->

    <!------- Breadcrumb ------->
    <ul class="breadcrumb">
        <li><a href="project.php" target="_self">Home</a></li>
        <li><a href="" target="_self">My Account</a></li>
    </ul>
    <!------- Breadcrumb ------->

    <!------- Content ------->
    <?php 
    if(!isset($_SESSION['username'])) { //If not logged in ?>
        <!----- Display Login/Register Page ----->
        <div class="container">
            <div class="row"><h1 class="center">Login / Sign Up</h1></div>
        </div>
        <div class="container mt-20">
            <figure class="tabBlock">
                <ul class="tabBlock-tabs">
                    <li class="tabBlock-tab">Login</li>
                    <li class="tabBlock-tab is-active">Register</li>
                </ul>
                
                <div class="tabBlock-content">
                    <!------- Login Form Tab ------->
                    <div class="tabBlock-pane">
                        <?php
                        if (isset($_POST['username'])) {
                            $username = stripslashes($_REQUEST['username']);
                            $username = mysqli_real_escape_string($sql, $username);
                            $password = stripslashes($_REQUEST['password']);
                            $password = mysqli_real_escape_string($sql, $password);
                            $query    = "SELECT * FROM `user` WHERE username='$username'
                                         AND password='$password'";
                            $result = mysqli_query($sql, $query) or die(mysql_error());
                            $rows = mysqli_num_rows($result);
                            if ($rows == 1) {
                                $_SESSION['username'] = $username;
                                // If successfully logged in, redirect to homepage
                                header("Location: project.php");
                            } else {
                                // If wrong password/username
                                echo '<div class="form">
                                      <h3>Incorrect Username/password.</h3><br/>
                                      <p style="text-align:center">Click here to <a href="account.php">Login</a> again.</p>
                                      </div>';
                            }
                        } else {
                    ?>
                        <div class="contianer">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-20">
                                    <h1 class="login-title">SIGN IN WITH YOUR USERNAME</h1>
                                    <form class="tab-form" method="post" name="login">
                                        <p>USERNAME</p>
                                        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
                                        <p>PASSWORD</p>
                                        <input type="password" class="login-input mb-10" name="password" placeholder="Password" />
                                        <a class="forget" href="">forget password?</a>
                                        <input type="submit" value="Login" name="submit" class="login-button"/>
                                    </form>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h1 class="login-title">SIGN IN WITH SOCIAL MEDIA ACCOUNTS</h1>
                                    <button class="btn" onclick="location.href ='https://myaccount.google.com/?utm_source=sign_in_no_continue&pli=1'"><img src="icon/google.svg" alt="Google Login" class="google" />SIGN IN WITH GOOGLE</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>
                    <!------- Login Form Tab ------->

                    <!------- Register Form Tab ------->
                    <div class="tabBlock-pane">
                        <?php
                        if (isset($_REQUEST['username'])) {
                            $username = stripslashes($_REQUEST['username']);
                            $username = mysqli_real_escape_string($sql, $username);
                            $email    = stripslashes($_REQUEST['email']);
                            $email    = mysqli_real_escape_string($sql, $email);
                            $password = stripslashes($_REQUEST['password']);
                            $password = mysqli_real_escape_string($sql, $password);
                            $query    = "INSERT into `user` (username, password, email)
                                         VALUES ('$username', '$password', '$email')";
                            $result   = mysqli_query($sql, $query);
                            if ($result) {
                                echo '<div class="form">
                                      <h3>You have successfully registered.</h3><br/>
                                      <p class="center">Click here to <a href="project.php" target="_self">login</a></p>
                                      </div>';
                            } else {
                                echo '<div class="form">
                                      <h3>Required fields are missing.</h3><br/>
                                      <p class="center">Click here to <a href="account.php" target="_self">registration</a> again.</p>
                                      </div>';
                            }
                        } else {
                        ?>
                        <div class="contianer">
                            <div class="row">
                                <div class="col-12 col-md-6 mb-20">
                                    <h1 class="login-title">REGISTER WITH EMAIL</h1>
                                    <form class="tab-form" method="post" action="">
                                        <p>USERNAME</p>
                                        <input type="text" class="login-input" name="username" placeholder="Username" required />
                                        <p>EMAIL ADDRESS</p>
                                        <input type="text" class="login-input" name="email" placeholder="Email Adress">
                                        <p>PASSWORD</p>
                                        <input type="password" class="login-input mb-10" name="password" placeholder="Password">
                                        <a class="forget" href="#" target="_blank">forget password?</a>
                                        <input type="submit" name="submit" value="Register" class="login-button">
                                    </form>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h1 class="login-title">SIGN UP WITH SOCIAL MEDIA ACCOUNTS</h1>
                                    <button class="btn" onclick="location.href ='https://myaccount.google.com/?utm_source=sign_in_no_continue&pli=1'"><img src="icon/google.svg" alt="Google SignUp" class="google" />SIGN UP WITH GOOGLE</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        } ?>
                    </div>
                    <!------- Register Form Tab ------->
                </div>
            </figure>
        </div>
    <?php
    } else { // If user have logged in
        $id = $_GET["uid"];

        $query = mysqli_query($sql, "SELECT * FROM user WHERE user_id = $id");
        if($query === FALSE) { 
           die(mysqli_error());
        }

        while($row = mysqli_fetch_assoc($query)){
            $username = $row['username'];
            $email = $row['email'];
            $address = $row['address'];
            $payment_method = $row['payment_method'];
            $contact = $row['contact'];

            if($address===NULL){
                $address = "---No address---";
            }
            if($payment_method===NULL){
                $payment_method = "---No payment menthod chose---";
            }
            if($contact===NULL){
                $contact = "---No contact---";
            }
        }?>

        <!------- User Account Details Page ------->
        <div class="account-container">
            <h1 class="center">ACCOUNT</h1>
            <div class="tabordion">
                <section id="my_acc_section">
                    <input type="radio" name="sections" id="option1" checked>
                    <label for="option1">My Account</label>
                    <article>
                        <h2 class="text-bold"><?php echo $username; ?></h2>
                        <h2>Contact Information</h2>
                        <p><?php echo $contact; ?></p>
                        <h2>Default Address</h2>
                        <p><?php echo $address; ?></p>
                        <h2>News Letter</h2>
                        <p><a href="#" target="_self" title="Subscribe Now!">Subscribe</a> to our news letter now!</p>
                    </article>
                </section>
                
                <section id="my_order_section">
                    <input type="radio" name="sections" id="option2">
                    <label for="option2">My Order</label>
                    <article>
                        <h2>Order</h2>
                            <div class="row mt-20">
                                <div class="col-4 col-md-2 mb-20">
                                    <img src="media_used/product1.jpeg" alt="Product Image" class="review">
                                </div>
                                <div class="col-8 col-md-4 mb-20">
                                    <p>Product Name</p>
                                </div>
                                <div class="col-4 col-md-2 mb-20">
                                    <img src="media_used/product6.jpeg" alt="Product Image" class="review">
                                </div>
                                <div class="col-8 col-md-4 mb-20">
                                    <p>Product Name</p>
                                </div>
                                <div class="col-4 col-md-2">
                                    <img src="media_used/product2.jpeg" alt="Product Image" class="review">
                                </div>
                                <div class="col-8 col-md-4">
                                    <p>Product Name</p>
                                </div>
                            </div>
                    </article>
                </section>
              
                <section id="my_wishlist_section">
                    <input type="radio" name="sections" id="option3">
                    <label for="option3">My Wishlist</label>
                    <article>
                        <h2>Wishlist</h2>
                        <div class="row mt-20">
                            <div class="col-4 col-md-2">
                                <img src="media_used/product8.jpeg" alt="Product Image" class="review">
                            </div>
                            <div class="col-8 col-md-4">
                                <p>Product Name</p>
                            </div>
                        </div>
                    </article>
                </section>
              
                <section id="my_add_section">
                    <input type="radio" name="sections" id="option4">
                    <label for="option4">Address Book</label>
                    <article>
                        <h2>Address</h2>
                        <p><?php echo $address; ?></p>
                    </article>
                </section>
              
                <section id="payment_method_section">
                    <input type="radio" name="sections" id="option5">
                    <label for="option5">Payment Method</label>
                    <article>
                        <h2>Payment Method</h2>
                        <p><?php echo $payment_method; ?></p>
                    </article>
                </section>
              
                <section id="acc_info_section">
                    <input type="radio" name="sections" id="option6">
                    <label for="option6">Account Information</label>
                    <article>
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <h2>Account Information</h2>
                            </div>
                            <div class="col-6 col-md-6">
                                <a href="javascript:void(0)" class="closebtn" onclick="openEditForm()" target="_self" title="Edit your information"><i class="fa fa-pencil-square-o">Edit</i></a>

                                <!----- Edit Information Pop Up Form ----->
                                <div class="loginPopup">
                                    <div class="formPopup" id="popupForm">
                                        <form action="" class="formContainer">
                                          <h2 class="text-center">Edit Your Information</h2>
                                          <p>Username</p>
                                          <?php echo '<input type="text" id="username" placeholder="'.$username.'" name="usernmae" disabled>';?>
                                          <p>E-mail</p>
                                          <?php echo '<input type="text" id="email" placeholder="'.$email.'" name="email" disabled>';?>
                                          <p>Password</p>
                                          <input type="password" id="psw" placeholder="Enter New Password" name="psw" required>
                                          <input type="password" id="psw" placeholder="Confirm Your New Password" name="psw" required>
                                          <p>Edit Your Contact</p>
                                          <?php echo '<input type="text" id="contact" placeholder="'.$contact.'  (current contact)" name="contact">';?>
                                          <p>Create New Address</p>
                                          <?php echo '<input type="text" id="address" placeholder="'.$address.'  (current address)" name="address">';?>
                                          <button type="submit" class="btn" onclick="closeEditForm()">Save Changes</button>
                                          <button type="button" class="btn cancel" onclick="closeEditForm()">Close</button>
                                        </form>
                                    </div>
                                </div>
                                <!----- Edit Information Pop Up Form ----->
                            </div>
                        <p>Username: <?php echo $username; ?></p>
                        <p>Email: <?php echo $email; ?></p>
                        <p>Password: ********</p>
                        <p>Default Address: <?php echo $address; ?></p>
                        <p>Contact Number: <?php echo $contact; ?></p>
                        <p>Rewards Earned:</p>
                    </article>
                </section>
            </div>
        </div>
        <!------- User Account Details Page ------->
    <?php
        } ?>
    <!------- Content ------->
    
    <!------- Footer ------->
    <div id="footer" class="mt-50"></div>
    <!------- Footer ------->
    
    <script>
        ///// Tab /////
        var TabBlock = {
            s: {
                animLen: 200
            },
      
            init: function() {
                TabBlock.bindUIActions();
                TabBlock.hideInactive();
            },
          
            bindUIActions: function() {
                $('.tabBlock-tabs').on('click', '.tabBlock-tab', function(){
                TabBlock.switchTab($(this));
                });
            },
          
            hideInactive: function() {
                var $tabBlocks = $('.tabBlock');
            
                $tabBlocks.each(function(i) {
                var 
                    $tabBlock = $($tabBlocks[i]),
                    $panes = $tabBlock.find('.tabBlock-pane'),
                    $activeTab = $tabBlock.find('.tabBlock-tab.is-active');
              
                $panes.hide();
                $($panes[$activeTab.index()]).show();
                });
            },
          
            switchTab: function($tab) {
                var $context = $tab.closest('.tabBlock');
            
                if (!$tab.hasClass('is-active')) {
                    $tab.siblings().removeClass('is-active');
                    $tab.addClass('is-active');
           
                    TabBlock.showPane($tab.index(), $context);
                }
            },
          
            showPane: function(i, $context) {
                var $panes = $context.find('.tabBlock-pane');
           
                $panes.slideUp(TabBlock.s.animLen);
                $($panes[i]).slideDown(TabBlock.s.animLen);
            }
        };

        $(function() {
            TabBlock.init();
        });
    </script>
</body>
</html>