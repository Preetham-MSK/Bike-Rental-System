<?php
session_start();
if (isset($_SESSION['aemail'])) 
{
	unset($_SESSION['aemail']);
header("Location: homepage.php"); // Redirecting To Home Page
}
?>