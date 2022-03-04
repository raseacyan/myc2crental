<?php
session_start();
include('inc/connect.php');
include('inc/functions.php');

if(isLoggedIn()){
	redirectTo("index.php");
}



if(isset($_POST['register'])){
	//senitize incoming data
	$name = $conn->real_escape_string(trim($_POST['name']));	
	$email = $conn->real_escape_string(trim($_POST['email']));	
	$phone = $conn->real_escape_string(trim($_POST['phone']));
	$address = $conn->real_escape_string(trim($_POST['address']));
	$password = $conn->real_escape_string(trim($_POST['password']));
	$password = md5($password);
	


	//save to database
	$sql = "INSERT INTO users (`name`, `email`, `password`,`phone`, `address`) 
    VALUES ('{$name}', '{$email}', '{$phone}','{$address}', '{$password}')";

	if ($conn->query($sql) === TRUE) {
	  header('Location:login.php');
	} else {
	  echo "Error: ".$conn->error;
	}
	
}
$conn->close();

?>
<!DOCTYE html>
<html>
<head>
	<title>Demo</title>
</head>
<body>
	<?php include('inc/nav.php'); ?>

	<h3>Registration</h3>

	<form action="register.php" method="post">
		<label for="name">Name</label><br>
		<input type="text" name="name"  required /><br>

		<label for="email">Email</label><br>
		<input type="text" name="email"  required /><br> 

		<label for="phone">Phone</label><br>
		<input type="text" name="phone"  required /><br>  

		<label for="address">Address</label><br>
		<input type="text" name="address"  required /><br>


		<label for="password">Password</label><br>
		<input type="password" name="password"  required /><br>

		<br>
		<input type="submit" name="register" value="submit"/>
	</form>

</body>
</html>