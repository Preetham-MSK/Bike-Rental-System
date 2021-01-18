<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['uemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
//<!-- Assigning POST values to variables. -->
$id = mysqli_real_escape_string($conn, $_POST['bid']);
// CHECK FOR THE RECORD FROM TABLE
$query1 = "SELECT * FROM bike WHERE bike_id='$id' ";
$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$row1 =mysqli_fetch_array($result1);

//<!-- transaction insertion -->
date_default_timezone_set('Asia/Calcutta');
$date=date("Y-m-d H:i:s");
$email=$_SESSION['uemail'];
$query2 = "INSERT INTO transaction(email,bike_id,start_time) VALUES('$email','$id','$date')";
mysqli_query($conn,$query2);

//<!-- bike updation -->
$bikeid=$row1['bike_id'];
$query3 = "UPDATE bike SET avail=0 WHERE bike_id='$id'";
mysqli_query($conn,$query3);

//<!-- Payment Insertion -->
$query4 = "INSERT INTO payment(email,bike_id) VALUES('$email','$id')";
mysqli_query($conn,$query4);
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
    <p class="title">BIKE BOOKED</p>
  <table class="table">
	  
    <tr><td class="item">User Name</td><td><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'];?></td></tr> 
		<tr><td class="item">BIKE ID</td><td><?php echo $row1['bike_id'];?></td></tr>
		<tr><td class="item">BIKE NAME</td><td><?php echo $row1['bike_name'];?></td></tr>
		<tr><td class="item">MODEL</td><td><?php echo $row1['model'];?></td></tr>
		<tr><td class="item">COLOR</td><td><?php echo $row1['color'];?></td></tr>
		<tr><td class="item">TYPE</td><td><?php echo $row1['bike_type'];?></td></tr>
		<tr><td class="item">PRICE</td><td>₹<?php echo $row1['price'];?>/hour</td></tr>
	 

	</table>
	
  <form action="mainpage.php" method="post">
		<input type="hidden" name="bid" value="<?php echo $row['bike_id']?> ">
		<button type="submit" class="proceed">HOME</button>
	</form>

  </div>

</div>

<!-- FOOTER STARTS HERE -->\
<?php
include 'footer.php';
?>
<!-- Footer ends here -->

</body>
</html>
