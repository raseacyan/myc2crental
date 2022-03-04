<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');


unset($_SESSION['rental']);

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Demo</title>
</head>
<body>
	<?php if(isLoggedIn()){showLoggedInUser();}?>
	<?php include("inc/nav.php"); ?>
	<h1>Thank You</h1>
	<p>Your form has been submitted successfully. You will be contacted from us soon.</p>
</body>
</html>