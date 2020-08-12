<?php
$conn = new mysqli("localhost","root","","vat");

if($conn->connect_error){
	die("connection failed: ".$conn->connect_error);
}
?>
