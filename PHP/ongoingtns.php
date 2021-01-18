<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['aemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: alogin.php');
  }

// CHECK FOR THE RECORD FROM TABLE
$query1 = "SELECT * FROM transaction WHERE end_time is NULL";
$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$count = mysqli_num_rows($result1);

//closing the transaction
if (isset($_POST['end'])) {
  // receive all input values from the form
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $bikeid= mysqli_real_escape_string($conn, $_POST['bikeid']);
  date_default_timezone_set('Asia/Calcutta');
  $date=date("Y-m-d H:i:s");

  //update bike avail
  $query3="UPDATE bike SET avail=1 WHERE bike_id='$bikeid'";
  mysqli_query($conn,$query3);

    //calculate time
  $query4="SELECT * FROM transaction WHERE bike_id=$bikeid AND end_time is NULL";
  $result4=mysqli_query($conn, $query4);
  $row4 =mysqli_fetch_array($result4);
  $start=$row4['start_time'];
  $diff = strtotime($date)-strtotime($start);
  

  //Stored Procedure
  $query6=" CALL spcost($diff,$bikeid) ";
  $result6=mysqli_query($conn,$query6);

  
   $_SESSION[$email]='Pay';

  //update end_time
  $query2="UPDATE transaction SET end_time='$date' WHERE bike_id='$bikeid' and end_time is NULL";
  mysqli_query($conn,$query2);
  header('location:ongoingtns.php');
}
?>

<!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َOngoing Transactions</title>
    <link rel="stylesheet" href="../css/result.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
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

  <table class="content_table">
  	
<?php 	

if($count>0) {
	echo "<thead>";
	echo "<tr>";
	echo "<th>Email</th>";
	echo "<th>Bike ID</th>";
	echo "<th>Start Time</th>";
	echo "<th>END</th>";
	echo "<tr>";
	echo "</thead>";
	echo "<tbody>";
  
  	   while($row =mysqli_fetch_array($result1) ) {
   	echo "<tr>";
   	
   	echo "<td >";
    echo $email1=$row['email'];
    echo "</td>";
    echo "<td >";
    echo $bikeid1=$row['bike_id'];
    echo "</td >";
    echo "<td >";
    echo $row['start_time'];
    echo "</td>";
	  echo "<td ><form method='POST'>" ;
	  echo "<input type='hidden' name='bikeid' value='";echo $bikeid1;echo"'>";
    echo "<input type='hidden' name='email' value='";echo $email1;echo"'>";
	  echo "<button type='submit' name='end' class='btn'>END</button></form></td> ";
    echo "</tr>";
    echo "<br/>";
 
}
    echo "</tbody>";
    echo "</table>";

}
else
{
?>
<div style="margin-top: 20%; margin-left: 40%;"><p style="font-size: x-large; font-family:sans-serif; color: #0085C8; font-weight: bolder;">No Ongoing Transactions</p></div>
<?php
}


?>
	
</div>
    
 <!-- FOOTER STARTS HERE -->

<?php
include 'footer.php';
?>
<!-- Footer ends here -->

  </body>
  </html>



