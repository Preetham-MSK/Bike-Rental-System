<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['aemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: alogin.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
<title>Admin Page</title>
<link rel="stylesheet" type="text/css" href="../css/adminpage.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<link rel="stylesheet" type="text/css" href="../css/footer.css">
</head>
<body>
  

    <!-- NAVIGATION -->

    <nav>
      <a href="adminpage.php"><img src="../images/logo.png" class="logo" alt="logo"></a>
      <ul>
        <li><a style="color: #3498db" href="">ADMIN</a></li>
        <li><a href="">FEEDBACK</a></li>
        <li><a href="">CONTACT US</a></li>
        <li><a style="color: #626282b8" href="alogout.php">LOGOUT</a></li>
      </ul>
    </nav>
  
  <!-- END OF NAVIGATION -->
<div class="page-wrapper">

    <!-- RIGHT BOX -->

    <div class="box0">
    <h3>View Bikes</h3>
    <a  class="box1" href="viewbike.php" name="viewbike">BIKES</a>
    <h3>View Terminals</h3>
    <a class="box1" href="viewterm.php" name="viewterm">TERMINALS</a>
    <h3>View Transactions</h3>
    <a class="box1" href="viewtrans.php" name="viewtran">TRANSACTIONS</a>
      
  </div>

  <!-- RIGHT BOX ENDED -->

  <!-- LEFT BOX -->
  <div class="box">
    <h3>Add Bike</h3>
    <a  class="box1" href="bikeentry.php" name="addbike">NEW BIKE</a>
    <h3>Add Terminal</h3>
    <a class="box1" href="termentry.php" name="addter">NEW TERMINAL</a>
    <h3>Transactions</h3>
    <a class="box1" href="ongoingtns.php" name="transaction">TRANSACTIONS</a>
      
  </div>

  <!-- LEFT BOX ENDED -->

  </div>


<!-- FOOTER STARTS HERE -->
<?php
include 'footer.php';
?>

<!-- FOOTER ENDS HERE -->

</div>

</body>
</html>