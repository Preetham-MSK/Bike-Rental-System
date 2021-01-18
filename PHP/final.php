<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['uemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
// CHECK FOR THE RECORD FROM TABLE
$email=$_SESSION['uemail'];
$query1 = "SELECT * FROM payment WHERE email='$email' order by date desc";
$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$row1 =mysqli_fetch_array($result1);

//Time Difference
$bid=$row1['bike_id'];
$query2 = "SELECT * FROM transaction t, bike b WHERE t.email='$email' and b.bike_id='$bid' and t.bike_id='$bid' order by t.end_time desc";
$result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
$row2 =mysqli_fetch_array($result2);
$start=$row2['start_time'];
$end=$row2['end_time'];
$diff = strtotime($end)-strtotime($start);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َReceipt Bike Rental</title>
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
    <p class="title">INVOICE</p>
  <table class="table">
	  
    <tr><td class="item">User Name</td><td><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'];?></td></tr> 
		<!-- Not Necessary<tr><td class="item">Bike Id</td><td><?php echo $row1['bike_id'];?></td></tr> -->
		<tr><td class="item">Bike Name</td><td><?php echo $row2['bike_name'];?></td></tr>
		<tr><td class="item">Bike Rent</td><td>₹<?php echo $row2['price'];?>/hour</td></tr>
    <tr><td class="item">Duration</td><td><?php echo $diff;?>hours</td></tr>
    <tr><td class="item">Receipt no</td><td>No.<?php echo $row1['receipt_no'];?></td></tr>
    <tr><td class="item">Cost</td><td>₹<?php echo $row1['cost'];?></td></tr>
    <tr><td class="item">Payment Method</td><td><?php echo $row1['mode'];?></td></tr>
	  <tr><td class="item">Date</td><td><?php echo $row1['date'];?></td></tr>

	</table>
	
  <button type="submit" onclick="window.location.href = 'mainpage.php';" class="proceed">HOME</button>
  </div>

</div>

<!-- FOOTER STARTS HERE -->\
<?php
include 'footer.php';
?>
<!-- Footer ends here -->

</body>
</html>
