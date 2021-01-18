<?php 
session_start();
include 'connection.php';

$error='';//error variable

if (isset($_SESSION['uemail'])) {
    header('location: mainpage.php');
  }


if (isset($_POST['login'])) {	
// Assigning POST values to variables.
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// CHECK FOR THE RECORD FROM TABLE
$query = "SELECT * FROM user WHERE email='$email' and password='$password'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row=mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);

if ($count == 1) {
	$_SESSION['uemail']=$email;//Initializing session
  $_SESSION['fname']=$row['fname'];
  $_SESSION['lname']=$row['lname'];
	header('location: mainpage.php');
	}

else{
$error="Invalid Email or Password";
}
}

 ?>


 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َBike Rental Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
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

  <!-- notification message -->
    <?php 
    if (isset($_SESSION['msg'])) : ?>
      <div class="msg" >
        <h3>
          <?php 
            echo $_SESSION['msg']; 
            unset($_SESSION['msg']);
          ?>
        </h3>
      </div>
    <?php endif ?>

<form class="box"  method="post">
  <h1>Login</h1>
  <input type="email" name="email" placeholder="Email" required title="Enter Email">
  <input type="password" name="password" placeholder="Password" required title="Enter Password">
  <input type="submit" name="login" value="Login">
  <span class="error"><?php echo $error; ?></span>
</form>

</div>

<!-- Footer -->
<?php
include 'footer.php';
?>
<!-- Footer ends here -->


  </body>
</html>