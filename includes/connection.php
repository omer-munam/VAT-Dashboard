<?php
$conn = new mysqli("localhost","root","","coffeegu_app");

if($conn->connect_error){
	die("connection failed: ".$conn->connect_error);
}
?>
