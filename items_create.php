<?php
session_start();
include('inc/connect.php');
include('inc/functions.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}

if(isset($_POST['add-item'])){

	//senitize incoming data
	$name = $conn->real_escape_string(trim($_POST['name']));
	$price = $conn->real_escape_string(trim($_POST['price']));
	$description = $conn->real_escape_string(trim($_POST['description']));
	$category = $conn->real_escape_string(trim($_POST['category']));
	$status = $conn->real_escape_string(trim($_POST['status']));
	$user_id = $_SESSION['user_id'];

	//upload image file
	$target_dir = "uploads";
	$tmp_name = $_FILES["image"]["tmp_name"];
	$file_name = basename(time()."_".$_FILES["image"]["name"]);	
	$uploaded = move_uploaded_file($tmp_name, "$target_dir/$file_name");

	//save to database
	if($uploaded){
		$sql = "INSERT INTO items (`name`, `price`, `description`, `image`, `category`, `status`, `user_id`) VALUES ('{$name}', '{$price}', '{$description}', '{$file_name}', '{$category}', '{$status}', '{$user_id}')";

		if ($conn->query($sql) === TRUE) {
		  header('Location:items_list.php');
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
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
	
	<form action="items_create.php" method="post" enctype="multipart/form-data">

	<label for="name">Item Name</label><br>
	<input type="text" class="form-control" name="name"><br>			   
						  					  

	<label for="name">Price</label><br>
	<input type="number" class="form-control" name="price">	<br>		   


	<label for="description">Description</label><br>
	<textarea class="form-control"  rows="3" name="description"></textarea>	<br>	   
						 

	<label for="image">Image</label><br>
	<input type="file" class="form-control" name="image">	<br>	   


	<label for="category">Category</label><br>
	<select name="category">
	<option value="category 1">Category 1</option>
	<option value="category 2">Category 2</option>	
	<option value="category 3">Category 3</option>	    			
	</select><br>

	<label for="status">Status</label><br> 
	<input type="radio" name="status" value="available"/> Available
	<input type="radio" name="status" value="not available"/> Not Available<br>

	<br><input type="submit" name="add-item" value="submit" />

	</form> 
</body>
</html>

