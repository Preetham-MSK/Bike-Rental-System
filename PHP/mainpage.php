<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['uemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

//checking for pending payment
$em=$_SESSION['uemail'];
if(isset($_SESSION[$em])) {
  header('location: payment.php');
}

//Fetching terminals
$query1="SELECT term_id,term_name FROM terminal";
$result1=mysqli_query($conn,$query1);

//Fetching ongoing transaction
$query2="SELECT * from transaction where email='$em' and end_time is NULL";
$result2=mysqli_query($conn,$query2);
$count2= mysqli_num_rows($result2);


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َMainpage</title>
    <link rel="stylesheet" href="../css/mainpage.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
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

  <?php
  if($count2==1){

  $row2 =mysqli_fetch_array($result2);

  //Fetching Bike information
 $bikeid1=$row2['bike_id'];
$query3="SELECT * from bike where bike_id='$bikeid1' and avail=0";
$result3=mysqli_query($conn,$query3);

  $row3 =mysqli_fetch_array($result3); 
  $bikename1=$row3['bike_name'];
  $price1=$row3['price'];
  $starttime1=$row2['start_time'];
  
    echo "<div  class ='ongoing'>";
      echo "<p>Ongoing Transaction</p>";
      echo "<table class='table'>";
    
    echo "<tr><td class='item'>BIKE ID</td><td>$bikeid1</td></tr>";
    echo "<tr><td class='item'>BIKE NAME</td><td>$bikename1</td></tr>";
    echo "<tr><td class='item'>PRICE</td><td>₹$price1/hour</td></tr>";
    echo "<tr><td class='item'>START TIME</td><td>$starttime1</td></tr>";

    echo "</table>";
  
    echo "</div>";
  }
    ?>

<form class="box" action="result.php" method="post">
  <h1>SEARCH</h1>
  
  <h2>Select The Type</h2>
  <select class="type" name="type" required>
    <option value="">Type</option>
    <option value="bike">BIKE</option>
    <option value="scooter">SCOOTER</option>
  </select>
  
  <h2>Select The Terminal</h2>
    <select class="terminal" name="terminal" required>
    <option value="">Choose</option>
          
           <!-- php code for dropdown  -->
       <?php
       while($row1 =$result1->fetch_assoc() )
        {
          $menu=$row1['term_name'];
          $men=$row1['term_id'];
          
          echo "<option value='$men'>$menu</option>";
        }
      
      

       ?>
       <!-- end of dropdown insertion  -->

  </select>
  <?php if($count2==0) {
  echo "<input type='submit' name='search' class='submit' value='SEARCH'>";
  }
  else {
  echo "<span class='error'>Limit Reached</span>";
}
?>
</form>

</div>

<!-- FOOTER STARTS HERE -->

<?php
include 'footer.php';
?>
<!-- Footer ends here -->



</body>
</html>