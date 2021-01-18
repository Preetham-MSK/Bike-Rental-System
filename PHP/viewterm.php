<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['aemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

// CHECK FOR THE RECORD FROM TABLE
$query1 = "SELECT * FROM terminal";
$result1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
$count1 = mysqli_num_rows($result1);

  ?>

  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َTerminals</title>
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

if($count1>0) {


	echo "<thead>";
	echo "<tr>";
	echo "<th>Terminal ID</th>";
	echo "<th>Terminal Name</th>";
	echo "<th>No Of Bikes</th>";
	echo "<tr>";
	echo "</thead>";
	echo "<tbody>";
  
  	   while($row1 =mysqli_fetch_array($result1) ) {
   	echo "<tr>";
   	echo "<td >";
    echo $row1['term_id'];
    echo "</td>";
    echo "<td >";
    echo $row1['term_name'];
    echo "</td >";
    echo "<td >";
    echo $row1['no_of_bikes'];
    echo "</td>";
    echo "</tr>";
    echo "<br/>";
 
}
    echo "</tbody>";
    echo "</table>";

}
else
{
?>
<div style="margin-top: 20%; margin-left: 40%;"><p style="font-size: x-large; font-family:sans-serif; color: #0085C8; font-weight: bolder;">No Terminals Found</p></div>
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



