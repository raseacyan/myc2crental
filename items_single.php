<?php
session_start();
include('inc/functions.php');
include('inc/connect.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}

$item = getItemById($_GET['id'], $conn);

if(isset($_POST['submit'])){
		$start_date = $conn->real_escape_string(trim($_POST['name']));
		$month = $_POST['month'];
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

	<h1><?php echo $item["name"]; ?></h1>	
	<h3><?php echo "{$item["price"]} per month"; ?></h3>
	<p><img src="<?php echo "uploads/{$item['image']}"; ?>" width="200"/></p>
	<p><strong>Owner:</strong><br><?php echo getUserNameById($item["id"], $conn); ?></p>
	<p><strong>Description:</strong><br><?php echo nl2br($item["description"]); ?></p>
	<p><a href="rental_form.php?pid=<?php echo $item['id']; ?>">Rent This!</a></p>
	
	<?php else: ?>
		<p>No records.</p>
	<?php endif; ?>
	<?php $conn->close(); ?>
</body>
</html>