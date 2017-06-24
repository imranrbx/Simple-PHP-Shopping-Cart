<?php
session_start();
$conn = new mysqli('localhost','root','pak1stan','dbcart');
if($conn->connect_errno){
	printf("Connection Failed: %s\n", $conn->connect_error);
	exit;
}
?>