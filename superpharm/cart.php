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
	if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
	    echo "Welcome to the member's area, " . $_SESSION['username'] . "!";
	} else {
		echo '<h1>Please <a href="account.php">log in</a> first.</h1>';
	}
?>
</body>
</html>