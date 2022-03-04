<?php
session_start();
include('inc/connect.php');
include('inc/functions.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}

$id = $_GET['id'];
$rental = getRentalById($id, $conn);

if(isset($_POST['add-payment'])){

	//senitize incoming data
	$date = $conn->real_escape_string(trim($_POST['date']));
	$amount = $conn->real_escape_string(trim($_POST['amount']));
	$rental_id = $conn->real_escape_string(trim($_POST['rental_id']));


	//save to database
	$table = "payments";
	$data = array(
		"date" => $date,
		"amount" => $amount,
		"rental_id" => $rental_id

	);
	
	$save = createRecord($table, $data, $conn);

	if($save){
		redirectTo("customers_rental_list.php");
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
	
	<form action="payment_create.php?id=<?php echo $rental['id']; ?>" method="post">

	<h1>Add Payment</h1>

	<label for="rental_number">Rental Number</label><br>
   	<input type="text" name="rental_number" value="<?php echo $rental['id']; ?>" disabled="disabled"><br>

	<label for="customer_name">Customer Name</label><br>
   	<input type="text" name="customer_name" value="<?php echo getUserNameById($rental['customer_id'], $conn); ?>" disabled="disabled"><br>

	<label for="date">Date</label><br>
	<input type="date" class="form-control" name="date"><br>			   
						  					  

	<label for="amount">Amount</label><br>
	<input type="number" class="form-control" name="amount">	<br>  


	<input type="hidden" name="rental_id" value="<?php echo $rental['id']; ?>"/>

	<br><input type="submit" name="add-payment" value="submit" />

	</form>
	<?php $conn->close();?> 
</body>
</html>

