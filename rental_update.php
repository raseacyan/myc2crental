<?php
session_start();
include('inc/connect.php');
include('inc/functions.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}


if(isset($_REQUEST['id'])){
	$rental = getRentalById($_REQUEST['id'], $conn);

	if(!$rental){
		redirectTo("customers_rental_list.php");
	}
}




if(isset($_POST['update-rental'])){

	//senitize incoming data	
	$status = $conn->real_escape_string(trim($_POST['status']));
	$id = $conn->real_escape_string(trim($_POST['id']));
	
	//save to database
	$table = "rentals";
	$data = array(
		"status" => $status

	);
	
	$save = updateRecord($table, $data, $id, $conn);

	if($save){
		redirectTo("customers_rental_list.php");
	}	
	
}

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

	<form action="rental_update.php?id=<?php  ?>" method="post">

	<h1>Update Rental</h1>

	<label for="status">Status</label><br>
	<select name="status">
		<option value="tbc" <?php echo ($rental['status']=='tbc')?'selected':''; ?>>tbc</option>
		<option value="confirmed" <?php echo ($rental['status']=='confirmed')?'selected':''; ?>>confirmed</option>
		<option value="cancelled" <?php echo ($rental['status']=='cancelled')?'selected':''; ?>>cancelled</option>
		<option value="completed" <?php echo ($rental['status']=='completed')?'selected':''; ?>>completed</option>		
	</select>


	<input type="hidden" name="id" value="<?php echo $rental['id']; ?>"/>

	<br><input type="submit" name="update-rental" value="submit" />

	</form> 
</body>
</html>
