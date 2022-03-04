<?php

session_start();
include('inc/connect.php');
include('inc/functions.php');

if(!isLoggedIn()){
	redirectTo("login.php");
}

$table = "rentals";
$id = $_GET['id'];
$data = array(
	"status" => "cancelled"
);

$save = updateRecord($table, $data, $id, $conn);

if($save){
	redirectTo("my_rental_list.php");
}	