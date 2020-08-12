<?php
session_start();


if(isset($_SESSION['isvendor']) && $_SESSION['isvendor'] == 1 && $_SESSION['loggedin'] == 1) {
   	session_destroy();
	header('location:index.php');
} else {
	session_destroy();
	header('location:login.php');
}


?>