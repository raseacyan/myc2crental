<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');


$items = getItems($conn);

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
	
	<?php if($items): ?>
	<?php foreach($items as $item): ?>
	<div class="item" style="border:1px solid #000; width:200px; text-align: center; margin: 10px; display:inline-block;">
		<img src="<?php echo "uploads/{$item['image']}"; ?>" width="100"/>
		<p><strong><?php echo $item['name']; ?></strong><br>
		<?php echo $item['price']; ?><br>
		<a href="items_single.php?id=<?php echo $item['id']; ?>">view</a>
		</p>

	</div>
	<?php endforeach;?>

	<?php else: ?>
		<p>No records</p>
	<?php endif; ?>
</body>
</html>