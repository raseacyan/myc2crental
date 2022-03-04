<?php

session_start();

include('inc/connect.php');
include('inc/functions.php');

if(isLoggedIn()){
	redirectTo("index.php");
}

if(isset($_POST['login'])){
	//senitize incoming data

	$email = $conn->real_escape_string(trim($_POST['email']));	
	$password = $conn->real_escape_string(trim($_POST['password']));
	$password = md5($password);

	$data = checkUserExist($email, $password, $conn); 
	print_r($data); 
	if($data){
		$_SESSION['user_id'] = $data['id'];
	    $_SESSION['user_name'] = $data['name'];
	    header('Location:index.php');  
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

	<form action="login.php" method="post">
	

		<label for="email">Email</label><br>
		<input type="text" name="email"  required /><br>

		<label for="password">Password</label><br>
		<input type="password" name="password"  required /><br>

		


		<br><br>
		<input type="submit" name="login" value="submit"/>
	</form>

</body>
</html>