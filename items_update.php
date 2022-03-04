<?php
session_start();
include('inc/connect.php');
include('inc/functions.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}


$item = getitemById($_REQUEST['id'], $conn);
if(!$item){
	echo "redirect to item list";
	//redirectTo("items_list.php");
}



if(isset($_POST['update-item'])){

	//senitize incoming data	
	$name = $conn->real_escape_string(trim($_POST['name']));
	$price = $conn->real_escape_string(trim($_POST['price']));
	$description = $conn->real_escape_string(trim($_POST['description']));
	$category = $conn->real_escape_string(trim($_POST['category']));
	$status = $conn->real_escape_string(trim($_POST['status']));
	
	$item_id = $conn->real_escape_string(trim($_POST['id']));
	$user_id = $_SESSION['user_id'];
	

	//upload image file
	$uploaded = false;
	if($_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 4){
		$file_name = $_POST['old_image'];
		echo "image not channge";	
		$uploaded = true;	
	}else{
		echo "image change";
		$old_file = $_POST['old_image'];	

		$tmp_name = $_FILES["image"]["tmp_name"];
		$file_name = basename(time()."_".$_FILES["image"]["name"]);

		$target_dir = "uploads";
		unlink("$target_dir/$old_file"); 
		$uploaded = move_uploaded_file($tmp_name, "$target_dir/$file_name");		
	}

	var_dump($uploaded);

	//save to database
	if($uploaded){
		$sql = "UPDATE items set name='{$name}', price='{$price}', description='{$description}', image='{$file_name}', category='{$category}', status='{$status}' WHERE id={$item_id} AND user_id={$user_id}";

		echo $sql;

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
	
	<form action="items_update.php" method="post" enctype="multipart/form-data">

	<label for="name">item Name</label><br>
	<input type="text" class="form-control" name="name" value="<?php echo $item['name'] ;?>"><br>			   
						  					  

	<label for="name">Price</label><br>
	<input type="number" class="form-control" name="price" value="<?php echo $item['price'] ;?>">	<br>		   


	<label for="description">Description</label><br>
	<textarea class="form-control"  rows="3" name="description"><?php echo $item['description'] ;?></textarea>	<br>	   
						 

	<label for="image">Image</label><br>
	<input type="file" class="form-control" name="image">	<br>	   


	<label for="category">Category</label><br>
	<select name="category">
	<option value="category 1" <?php echo ($item['category'] == "category 1")?"selected":""; ?>>Category 1</option>
	<option value="category 2" <?php echo ($item['category'] == "category 2")?"selected":""; ?>>Category 2</option>	
	<option value="category 3" <?php echo ($item['category'] == "category 3")?"selected":""; ?>>Category 3</option>	    			
	</select><br>

	<label for="status">Status</label><br> 
	<input type="radio" name="status" value="available" <?php echo ($item['status'] == "available")?"checked":""; ?>/> Available
	<input type="radio" name="status" value="not available" <?php echo ($item['status'] == "not available")?"checked":""; ?>/> Not Available<br>

	<input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>
	<input type="hidden" name="old_image" value="<?php echo $item['image']; ?>"/>

	<br><input type="submit" name="update-item" value="submit" />

	</form> 
</body>
</html>

