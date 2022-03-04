<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}

$items = getItemsByUserId($_SESSION['user_id'], $conn);

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
	
	<h1>My Items</h1>

	<?php if($items): ?>

	<table border="1" cellspacing="1" cellpadding="5">
		<tr>
			<th>Name</th>
			<th>Image</th>
			<th>Price</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php foreach($items as $item): ?>
		<tr>
			<td><?php echo $item['name']; ?></td>
			<td><img src="<?php echo "uploads/{$item['image']}"; ?>" width="100"/></td>
			<td><?php echo $item['price']; ?></td>
			<td><?php echo $item['status']; ?></td>
			<td>
				<a href="items_update.php?id=<?php echo $item['id']; ?>">Edit</a> |
				<a href="items_delete.php?id=<?php echo $item['id']; ?>">Delete</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

	<?php else: ?>
		<p>You do not have any item. Add items <a href="items_create.php">here</a>.</p>
	<?php endif; ?>
</body>
</html>