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
    if(!isset($_SESSION['username'])) {?>

        <div class="login-register">
            <figure class="tabBlock">
                <ul class="tabBlock-tabs">
                    <li class="tabBlock-tab">Login</li>
                    <li class="tabBlock-tab is-active">Register</li>
                </ul>
                
                <div class="tabBlock-content">
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
                                // Redirect to user dashboard page
                                header("Location: index.php");
                            } else {
                                echo '<div class="form">
                                      <h3>Incorrect Username/password.</h3><br/>
                                      <p style="text-align:center">Click here to <a href="account.php">Login</a> again.</p>
                                      </div>';
                            }
                        } else {
                    ?>

                        <div class="contianer">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h1 class="login-title">SIGN IN WITH YOUR USERNAME</h1>
                                    <form class="tab-form" method="post" name="login">
                                        <p>USERNAME</p>
                                        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
                                        <p>PASSWORD</p>
                                        <input type="password" class="login-input" name="password" placeholder="Password" style="margin-bottom: 10px;" />
                                        <a class="forget" href="">forget password?</a>
                                        <input type="submit" value="Login" name="submit" class="login-button"/>
                                    </form>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h1 class="login-title">SIGN IN WITH SOCIAL MEDIA ACCOUNTS</h1>
                                    <button class="btn"><img src="icon/google.svg" style="width: 7%; margin-right: 10px" />SIGN IN WITH GOOGLE</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>

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
                                echo "<div class='form'>
                                      <h3>You have successfully registered.</h3><br/>
                                      <p style='text-align:center'>Click here to <a href='login.php'>Login</a></p>
                                      </div>";
                            } else {
                                echo "<div class='form'>
                                      <h3>Required fields are missing.</h3><br/>
                                      <p style='text-align:center'>Click here to <a href='account.php'>registration</a> again.</p>
                                      </div>";
                            }
                        } else {
                        ?>

                        <div class="contianer">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <h1 class="login-title">REGISTER WITH EMAIL</h1>
                                    <form class="tab-form" method="post" action="">
                                        <p>USERNAME</p>
                                        <input type="text" class="login-input" name="username" placeholder="Username" required />
                                        <p>EMAIL ADDRESS</p>
                                        <input type="text" class="login-input" name="email" placeholder="Email Adress">
                                        <p>PASSWORD</p>
                                        <input type="password" class="login-input" name="password" placeholder="Password" style="margin-bottom: 10px;">
                                        <a class="forget" href="">forget password?</a>
                                        <input type="submit" name="submit" value="Register" class="login-button">
                                    </form>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h1 class="login-title">SIGN UP WITH SOCIAL MEDIA ACCOUNTS</h1>
                                    <button class="btn"><img src="icon/google.svg" style="width: 7%; margin-right: 10px" />SIGN UP WITH GOOGLE</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    </div>

                </div>
            </figure>
        </div>
    <?php
    } else {
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
        }?>

        <div class="account-container">
            <h1 style="text-align: center">ACCOUNT</h1>
            <div class="tabordion">
                <section id="section1">
                    <input type="radio" name="sections" id="option1" checked>
                    <label for="option1">My Account</label>
                    <article>
                        <h2 style="font-weight: bold"><?php echo $username; ?></h2>
                        <h2>Contact Information</h2>
                        <p>+60<?php echo $contact; ?></p>
                        <h2>Default Address</h2>
                        <p><?php echo $address; ?></p>
                        <h2>News Letter</h2>
                        <p><a href="">Subscribe</a> to our news letter now!</p>
                    </article>
                </section>
                
                <section id="section2">
                    <input type="radio" name="sections" id="option2">
                    <label for="option2">My Order</label>
                    <article>
                        <h2>Order</h2>
                    </article>
                </section>
              
                <section id="section3">
                    <input type="radio" name="sections" id="option3">
                    <label for="option3">My Wishlist</label>
                    <article>
                        <h2>Wishlist</h2>
                    </article>
                </section>
              
                <section id="section4">
                    <input type="radio" name="sections" id="option4">
                    <label for="option4">Address Book</label>
                    <article>
                        <h2>Address</h2>
                    </article>
                </section>
              
                <section id="section5">
                    <input type="radio" name="sections" id="option5">
                    <label for="option5">Payment Method</label>
                    <article>
                        <h2>Payment Method</h2>
                    </article>
                </section>
              
                <section id="section6">
                    <input type="radio" name="sections" id="option6">
                    <label for="option6">Account Information</label>
                <article>
                    <h2>Account Information</h2>
                </article>
                </section>
              
            </div>
        </div>
    <?php
    }?>

<script>
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

    <!------- Footer ------->
    <div id="footer"></div>
    <!------- Footer ------->
</body>
</html>