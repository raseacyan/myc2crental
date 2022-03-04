<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');


$rentals = getMyRentals($_SESSION['user_id'],$conn);

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
	
	<h1>My Rentals</h1>

	<?php if($rentals): ?>

	<table border="1" cellspacing="1" cellpadding="5">
		<tr>
			<th>id</th>
			<th>Item Name</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Duration</th>
			<th>Total Amount</th>
			<th>Status</th>
			<th>Owner Name</th>
			<th>Action</th>
		</tr>
		<?php foreach($rentals as $rental): ?>
		<tr>
			<td><?php echo $rental['id']; ?></td>
			<td><?php echo $rental['item_name']; ?></td>
			<td><?php echo $rental['start_date']; ?></td>
			<td><?php echo $rental['end_date']; ?></td>
			<td><?php echo $rental['duration']; ?></td>
			<td><?php echo $rental['total_amount']; ?></td>
			<td><?php echo $rental['status']; ?></td>
			<td><?php echo $rental['owner_name']; ?></td>
			<td>			
			<?php if($rental['status'] == 'tbc'): ?>	
				<a href="my_rental_cancel.php?id=<?php echo $rental['id']; ?>">Cancel</a>
			<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>

	<?php else: ?>
		<p>No records</p>
	<?php endif; ?>
	</table>
</body>
</html>