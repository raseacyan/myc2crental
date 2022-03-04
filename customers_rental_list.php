<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');


$rentals = getCustomerRentals($_SESSION['user_id'],$conn);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Demo</title>
</head>
<body>
	<?php if(isLoggedIn()){showLoggedInUser();}?>
	<?php include("inc/nav.php"); ?>
	
	<h1>Customer Rentals</h1>

	<?php if($rentals): ?>

	<table border="1" cellspacing="1" cellpadding="5">
		<tr>
			<th>id</th>
			<th>Item Name</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Duration</th>			
			<th>Status</th>
			<th>Customer Name</th>
			<th>Total Amount</th>
			<th>Total Received</th>
			<th>Balance</th>
			<th>Action</th>
		</tr>
		<?php foreach($rentals as $rental): ?>
		<?php $total_received = (double)getTotalPayemntReceivedByRentalId($rental['id'], $conn);  ?>
		<tr>
			<td><?php echo $rental['id']; ?></td>
			<td><?php echo $rental['item_name']; ?></td>
			<td><?php echo $rental['start_date']; ?></td>
			<td><?php echo $rental['end_date']; ?></td>
			<td><?php echo $rental['duration']; ?></td>			
			<td><?php echo $rental['status']; ?></td>
			<td><?php echo $rental['customer_name']; ?></td>
			<td><?php echo $rental['total_amount'];  ?></td>
			<td><?php echo $total_received; ?></td>
		    <td><?php echo $rental['total_amount'] - $total_received; ?></td>
			
			<td>			
			<?php if($rental['status'] !== 'cancel'): ?>	
				<a href="rental_update.php?id=<?php echo $rental['id']; ?>">Update Status</a><br>
				<a href="payment_create.php?id=<?php echo $rental['id']; ?>">Add Payment</a>
			<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>

	<?php else: ?>
		<p>No records</p>
	<?php endif; ?>
	</table>
	<?php $conn->close(); ?>
</body>
</html>