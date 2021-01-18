<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['uemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

if (isset($_POST['type']) and isset($_POST['terminal'])) {

//Assigning POST values to variables.
$type = mysqli_real_escape_string($conn, $_POST['type']);
$terminal = mysqli_real_escape_string($conn, $_POST['terminal']);

// CHECK FOR THE RECORD FROM TABLE
$query1 = "SELECT * FROM bike WHERE bike_type='$type' and term_id='$terminal' and avail=1";
$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$count = mysqli_num_rows($result1);
}
?>

<!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َSearch Result</title>
    <link rel="stylesheet" href="../css/result.css">
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

  <table class="content_table">
  	
<?php 	

if($count>0) {
	echo "<thead>";
	echo "<tr>";
	echo "<th>Bike ID</th>";
	echo "<th>Bike Name</th>";
	echo "<th>Model</th>";
	echo "<th>Color</th>";
	echo "<th>Select</th>";
	echo "<tr>";
	echo "</thead>";
	echo "<tbody>";
  
  	   while($row =mysqli_fetch_array($result1) ) {
   	echo "<tr>";
   	
   	echo "<td >";
    echo $bikeid=$row['bike_id'];
    echo "</td>";
    echo "<td >";
    echo $row['bike_name'];
    echo "</td >";
    echo "<td >";
    echo $row['model'];
    echo "</td>";
    echo "<td>";
    echo $row['color'];
    echo "</td>";
	  echo "<td ><form action='booking.php' method='POST'>" ;
	  echo "<input type='hidden' name='bikeid' value='";echo $bikeid;echo"'>";
	  echo "<button type='submit' class='btn'>SELECT</button></form></td> ";
    echo "</tr>";
    echo "<br/>";
 
}
    echo "</tbody>";
    echo "</table>";

}
else
{
?>
<div style="margin-top: 20%; margin-left: 40%;"><p style="font-size: x-large; font-family:sans-serif; color: #0085C8; font-weight: bolder;">No Bike Found in this Terminal</p></div>
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



