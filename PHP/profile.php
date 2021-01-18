<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['uemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

// CHECK FOR THE RECORD FROM TABLE
  $mail=$_SESSION['uemail'];
$query1 = "SELECT * FROM user WHERE email='$mail' ";
$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$row1 =mysqli_fetch_array($result1);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َBooking</title>
    <link rel="stylesheet" href="../css/booking.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
  </head>
  <body>

    <!-- NAVIGATION -->

    <nav>
      <a href="mainpage.php"><img src="../images/logo.png" class="logo" alt="logo"></a>
      <ul>
        <li><a style="color: #3498db" href="profile.php"><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></a></li>
        <li><a href="mytransaction.php">MY TRANSACTION</a></li>
        <li><a href="">CONTACT US</a></li>
        <li><a style="color: #626282b8" href="logout.php">LOGOUT</a></li>
      </ul>
    </nav>
  
  <!-- END OF NAVIGATION -->
<div class="page-wrapper">

  <div class="tab">
    <p class="title">PROFILE</p>
    <table class="table">
  
      <tr><td class="item">First Name</td><td><?php echo $row1['fname'];?></td></tr>
      <tr><td class="item">Last Name</td><td><?php echo $row1['lname'];?></td></tr>
      <tr><td class="item">Email</td><td><?php echo $row1['email'];?></td></tr>
      <tr><td class="item">Phone</td><td><?php echo $row1['phone'];?></td></tr>
      <tr><td class="item">D L no</td><td><?php echo $row1['dlno'];?></td></tr>
   
    </table>
  </div>
</div>
  <!-- FOOTER STARTS HERE -->\
<?php
include 'footer.php';
?>
<!-- Footer ends here -->

</body>
</html>
