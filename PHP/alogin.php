<?php 
session_start();
include 'connection.php';

$error='';//error variable

if (isset($_SESSION['aemail'])) {
    header('location: adminpage.php');
  }

if (isset($_POST['alogin'])) {
	//checking for input
if ((empty($_POST['aemail'])) || empty($_POST['apassword'])) {
	$error = "Email or Password not set";
	}
else
{	
// Assigning POST values to variables.
$email = mysqli_real_escape_string($conn, $_POST['aemail']);
$password = mysqli_real_escape_string($conn, $_POST['apassword']);

// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM `admin` WHERE email='$email' and password='$password'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($result);

if ($count == 1){
	$_SESSION['aemail']=$email;//Initializing session
	header('location: adminpage.php');
	}

else{
$error="Invalid Email or Password";
}
}
}

 ?>

 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َAdmin Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
  </head>
  <body>


    <!-- NAVIGATION -->

    <nav>
      <a href="homepage.php"><img src="../images/logo.png" class="logo" alt="logo"></a>
      <ul>
        <li><a href="">ABOUT US</a></li>
        <li><a href="">WHY BIKE RENT?</a></li>
        <li><a href="">CONTACT US</a></li>
        <li><a href="">T&C</a></li>
      </ul>
    </nav>
  
  <!-- END OF NAVIGATION -->

<div class="page-wrapper">


<form class="box"  method="post">
  <h1>Admin Login</h1>
  <input type="email" name="aemail" placeholder="Email" required title="Enter Email">
  <input type="password" name="apassword" placeholder="Password" required title="Enter Password">
  <input type="submit" name="alogin" value="Login">
  <span class="error"><?php echo $error ?></span>
</form>

</div>


<!-- FOOTER STARTS HERE -->
<?php
include 'footer.php';
?>
<!-- Footer ends here -->
  </body>
</html>
