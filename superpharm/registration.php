<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

<body>
    <!------- Header ------->
    <div id="header"></div>
    <!------- Header ------->

    <div class="login-register">
        <figure class="tabBlock">
            <ul class="tabBlock-tabs">
                <li class="tabBlock-tab">Login</li>
                <li class="tabBlock-tab is-active">Register</li>
            </ul>
            
            <div class="tabBlock-content">
                <div class="tabBlock-pane">
                    <?php
                    require('include/config.php');
                    session_start();
                    // When form submitted, check and create user session.
                    if (isset($_POST['username'])) {
                        $username = stripslashes($_REQUEST['username']);    // removes backslashes
                        $username = mysqli_real_escape_string($sql, $username);
                        $password = stripslashes($_REQUEST['password']);
                        $password = mysqli_real_escape_string($sql, $password);
                        // Check user is exist in the database
                        $query    = "SELECT * FROM `users` WHERE username='$username'
                                     AND password='" . $password . "'";
                        $result = mysqli_query($sql, $query) or die(mysql_error());
                        $rows = mysqli_num_rows($result);
                        if ($rows == 1) {
                            $_SESSION['username'] = $username;
                            // Redirect to user dashboard page
                            header("Location: index.php");
                        } else {
                            echo "<div class='form'>
                                  <h3>Incorrect Username/password.</h3><br/>
                                  <p class='link'>Click here to <a href='registration.php'>Login</a> again.</p>
                                  </div>";
                        }
                    } else {
                ?>

                    <h1 class="login-title">Login</h1>
                    <form class="tab-form" method="post" name="login">
                        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
                        <input type="password" class="login-input" name="password" placeholder="Password"/>
                        <input type="submit" value="Login" name="submit" class="login-button"/>
                  </form>
                <?php
                    }
                ?>
                </div>

                <div class="tabBlock-pane">
                    <?php
                    require('include/config.php');
                    if (isset($_REQUEST['username'])) {

                        $username = stripslashes($_REQUEST['username']);
                        $username = mysqli_real_escape_string($sql, $username);
                        $email    = stripslashes($_REQUEST['email']);
                        $email    = mysqli_real_escape_string($sql, $email);
                        $password = stripslashes($_REQUEST['password']);
                        $password = mysqli_real_escape_string($sql, $password);
                        $query    = "INSERT into `user` (username, password, email)
                                     VALUES ($username', '" .$password. "', '$email')";
                        $result   = mysqli_query($sql, $query);
                        if ($result) {
                            echo "<div class='form'>
                                  <h3>You are registered successfully.</h3><br/>
                                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                                  </div>";
                        } else {
                            echo "<div class='form'>
                                  <h3>Required fields are missing.</h3><br/>
                                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                                  </div>";
                        }
                    } else {
                    ?>

                    <h1 class="login-title">Registration</h1>
                    <form class="tab-form" method="post" action="">
                        <input type="text" class="login-input" name="username" placeholder="Username" required />
                        <input type="text" class="login-input" name="email" placeholder="Email Adress">
                        <input type="password" class="login-input" name="password" placeholder="Password">
                        <input type="submit" name="submit" value="Register" class="login-button">
                    </form>
                <?php
                    }
                ?>
                </div>

            </div>
        </figure>
    </div>

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