<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}

$products = getProductsByUserId($_SESSION['user_id'], $conn);

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
	
	<p>My Products</p>

	<?php if($products): ?>

	<table border="1" cellspacing="1" cellpadding="5">
		<tr>
			<th>Name</th>
			<th>Image</th>
			<th>Price</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php foreach($products as $product): ?>
		<tr>
			<td><?php echo $product['name']; ?></td>
			<td><img src="<?php echo "uploads/{$product['image']}"; ?>" width="100"/></td>
			<td><?php echo $product['price']; ?></td>
			<td><?php echo $product['status']; ?></td>
			<td>
				<a href="products_update.php?id=<?php echo $product['id']; ?>">Edit</a> |
				<a href="products_delete.php?id=<?php echo $product['id']; ?>">Delete</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

	<?php else: ?>
		<p>You do not have any product. Add products <a href="products_create.php">here</a>.</p>
	<?php endif; ?>
</body>
</html>