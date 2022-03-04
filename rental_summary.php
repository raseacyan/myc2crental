<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}


$item = getItemById($_SESSION['rental']['item_id'], $conn);
$owner = getUserById($_SESSION['rental']['owner_id'], $conn);
$customer = getUserById($_SESSION['user_id'], $conn);

if(isset($_POST['confirm'])){

	$start_date = $conn->real_escape_string(trim($_SESSION['rental']['start_date']));
	$end_date = $conn->real_escape_string(trim($_SESSION['rental']['start_date']));
	$duration = $conn->real_escape_string(trim($_SESSION['rental']['duration']));
	$total_amount = $conn->real_escape_string(trim($_SESSION['rental']['total_amount']));
	$status = $conn->real_escape_string(trim("tbc"));;
	$owner_id = $conn->real_escape_string(trim($_SESSION['rental']['owner_id']));
	$customer_id = $conn->real_escape_string(trim($_SESSION['rental']['customer_id']));
	$item_id =  $conn->real_escape_string(trim($_SESSION['rental']['item_id']));


	$table = "rentals";
	$data = array(
		"start_date" => $start_date,
		"end_date" => $end_date,
		"duration" => $duration,
		"total_amount" => $total_amount,
		"status" => $status,
		"owner_id" => $owner_id,
		"customer_id" => $customer_id,
		"item_id" => $item_id
	);
	
	$save = createRecord($table, $data, $conn);

	if($save){
		redirectTo("rental_success.php");
	}
		
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

	<h1>Rental Summary</h1>

	<p>
		<strong>Item Name:</strong>  <?php echo $item['name']; ?><br>
		<strong>Item Price: </strong> <?php echo $item['price']." per month."; ?><br>
		<strong>Duration: </strong> <?php echo $_SESSION['rental']['duration']." month(s)"; ?><br>
		<strong>Start Date: </strong> <?php echo $_SESSION['rental']['start_date']; ?><br>
		<strong>End Date: </strong> <?php echo $_SESSION['rental']['end_date']; ?><br>
		<strong>Total Amount: </strong> <?php echo $_SESSION['rental']['total_amount']." mmk"; ?><br>
		<strong>Owner Name: </strong> <?php echo $owner['name']; ?><br>
		<strong>Customer Name: </strong> <?php echo $customer['name']; ?><br>
		<strong>Customer Phone: </strong> <?php echo $customer['phone']; ?><br>
		<strong>Customer Address: </strong> <?php echo $customer['address']; ?><br>

		<form action="rental_summary.php" method="post">
				<input type="submit" name="confirm" value="confirm"/>
		</form>


	</p>

	
	<?php else: ?>
		<p>No records.</p>
	<?php endif; ?>
	<?php $conn->close(); ?>
</body>
</html>