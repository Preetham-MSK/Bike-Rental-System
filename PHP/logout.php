<?php
session_start();
if (isset($_SESSION['uemail'])) 
{
	unset($_SESSION['uemail']);//destroying session
	unset($_SESSION['fname']);
	unset($_SESSION['lname']);
header("Location: homepage.php"); // Redirecting To Home Page
}
?>