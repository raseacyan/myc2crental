<?php

/****************
@Helpers
*****************/
function display($pram){
	echo "<pre>";
	print_r($pram);
	echo "</pre>";
}

function createRecord($table, $data, $conn){

	$values = "";
	$columns = "";
	foreach($data as $k=>$v){
		$columns .= "`".$k."`,";
		$values .= "'".$v."',";
	}
	$columns = substr($columns, 0,-1);
	$values = substr($values, 0,-1);


	$sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
	$result = $conn->query($sql);

	if ($result) {
	  $last_id = $conn->insert_id;
	  return $last_id;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;die();
	  return false;
	}
}


function updateRecord($table, $data, $id, $conn){

	$set = "";
	foreach($data as $k=>$v){
		$set .= "`".$k."`='".$v."',";
	}
	$set = substr($set, 0,-1);


	$sql = "UPDATE {$table} set {$set} WHERE id={$id}";
	$result = $conn->query($sql);

	if ($result) {
	  return true;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;die();
	  return false;
	}
}

function deleteRecord($table, $id, $conn){
	$sql = "DELETE FROM {$table} WHERE id={$id}";	
	$result = $conn->query($sql);

	if ($result) {
	  return true;
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;die();
	  return false;
	}	
}


function redirectTo($url){
	header("location:{$url}");
}


/****************
@Login
*****************/

function checkUserExist($email, $password, $conn){
	$sql = "SELECT id,name FROM users WHERE email = '{$email}' AND password='{$password}'";
    $result = $conn->query($sql);

    if($result){
    	if ($result->num_rows > 0) {
	      $data = array();
	      $row = $result->fetch_assoc();
	      $data = $row;
	      return $data;	      
	    } else {
	        echo "login failed";
	        return false;
	    }
    }else{
    	echo $conn->error;
    	return false;
    }
}

function showLoggedInUser(){	
	$username = $_SESSION['user_name'];
	echo "<p>Logged in as: {$username}</p>";
}

function isLoggedIn(){
	if(isset($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}
}


/****************
@Items
*****************/

function getItemsByUserId($user_id, $conn){
	$sql = "SELECT * from items WHERE user_id = $user_id";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			While($row = $result->fetch_assoc()){
				 array_push($data, $row);
			}
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}

function getItems($conn){
	$sql = "SELECT * from items";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			While($row = $result->fetch_assoc()){
				 array_push($data, $row);
			}
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}

function getItemById($item_id, $conn){
	$sql = "SELECT * from items WHERE id={$item_id}";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			$row = $result->fetch_assoc();
			$data = $row;		
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}


/****************
@Users
*****************/
function getUserById($user_id, $conn){
	$sql = "SELECT * from users WHERE id={$user_id}";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			$row = $result->fetch_assoc();
			$data = $row;		
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}


function getUserNameById($user_id, $conn){
	$sql = "SELECT name from users WHERE id={$user_id}";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			$row = $result->fetch_assoc();
			$data = $row['name'];		
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}


/****************
@Rentals
*****************/
function getRentals($conn){
	$sql = "SELECT * from rentals";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			While($row = $result->fetch_assoc()){
				 array_push($data, $row);
			}
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}

function getRentalById($id, $conn){
	$sql = "SELECT * from rentals WHERE id={$id}";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			$row = $result->fetch_assoc();
			$data = $row;
		
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}



function getMyRentals($customer_id, $conn){
	$sql = "SELECT r.id, r.start_date, r.end_date, r.duration, r.total_amount, r.status, u.name as owner_name, i.name as item_name from rentals as r, users as u, items as i  WHERE r.owner_id = u.id AND r.item_id = i.id AND r.customer_id = {$customer_id}";	

	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			While($row = $result->fetch_assoc()){
				 array_push($data, $row);
			}
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}

function getCustomerRentals($owner_id, $conn){
	$sql = "SELECT r.id, r.start_date, r.end_date, r.duration, r.total_amount, r.status, u.name as customer_name, i.name as item_name from rentals as r, users as u, items as i  WHERE r.customer_id = u.id AND r.item_id = i.id AND r.owner_id = {$owner_id}";	

	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			While($row = $result->fetch_assoc()){
				 array_push($data, $row);
			}
			return $data;            		
		}else{			
			return false;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}



/****************
@Payments
*****************/

function getTotalPayemntReceivedByRentalId($rental_id, $conn){
	$sql = "SELECT sum(`amount`) as total_received FROM `payments` WHERE rental_id={$rental_id}";	
	$result = $conn->query($sql);
	if($result){
		$data = array();
		if($result->num_rows > 0){			
			$row = $result->fetch_assoc();
				$data = $row['total_received'];
			return $data;            		
		}else{			
			return 0;
		}
	}else{
		echo $conn->error;		
		return false;
	}
}