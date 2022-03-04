<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}

$item = getItemById($_REQUEST['pid'], $conn);
$owner = getUserById($item['user_id'], $conn);
$currentUser = getUserById($_SESSION['user_id'], $conn);

if(isset($_POST['submit'])){
	$start_date = htmlentities(trim($_POST['start_date']));
	$duration = htmlentities(trim($_POST['duration']));
	$end_date = date('Y-m-d', strtotime("+{$duration} months", strtotime($start_date)));
	$total_amount = $item['price']*$duration;
	$item_id = htmlentities(trim($_POST['pid']));
	$owner_id = htmlentities(trim($_POST['oid']));
	$customer_id = htmlentities(trim($_POST['cid']));



	$_SESSION['rental']['start_date'] = $start_date;
	$_SESSION['rental']['end_date'] = $end_date;
	$_SESSION['rental']['duration'] = $duration;
	$_SESSION['rental']['total_amount'] = $total_amount;
	$_SESSION['rental']['item_id'] = $item_id;
	$_SESSION['rental']['owner_id'] = $owner_id;
	$_SESSION['rental']['customer_id'] = $customer_id;

	redirectTo('rental_summary.php');


}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Demo</title>
</head>
<body>
	<?php if(isLoggedIn()){showLoggedInUser();}?>
	<?php include("inc/nav.php"); ?>


	<?php if($item): ?>

	<h1>Rental Form</h1>		
	<form action="rental_form.php?pid=<?php echo $item['id']; ?>" method="post">
		Item Name: <input type="text" name="product_name" disabled="disabled" value="<?php echo $item['name']; ?>" /><br>
		Owner: <input type="text" name="product_name" disabled="disabled" value="<?php echo $owner['name']; ?>" /><br>
		Customer: <input type="text" name="product_name" disabled="disabled" value="<?php echo $currentUser['name']; ?>" /><br>
		Phone: <input type="text" name="product_name" disabled="disabled" value="<?php echo $currentUser['phone']; ?>" /><br>
		Address: <br><textarea disabled="disabled"><?php echo $currentUser['address']; ?></textarea><br><br>
		Start date: <input type="date" name="start_date" /><br>
		<input type="radio" name="duration" value="1"/> 1 month<br>
		<input type="radio" name="duration" value="3"/> 3 month<br>
		<input type="radio" name="duration" value="6"/> 6 month<br>
		<input type="radio" name="duration" value="12"/> 12 month<br>

		<input type="hidden" name="pid" value="<?php echo $item['id']; ?>"/>
		<input type="hidden" name="oid" value="<?php echo $owner['id']; ?>"/>
		<input type="hidden" name="cid" value="<?php echo $currentUser['id']; ?>"/>
		

		<input type="submit" value="submit" name="submit"/>
	</form>
	<?php else: ?>
		<p>No records.</p>
	<?php endif; ?>
	<?php $conn->close(); ?>
</body>
</html>