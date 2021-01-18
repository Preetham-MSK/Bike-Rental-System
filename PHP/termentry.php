<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['aemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: alogin.php');
  }

//add terminal
if (isset($_POST['addter'])) {
  // receive all input values from the form
  $termid = mysqli_real_escape_string($conn, $_POST['termid']);
   $termname = mysqli_real_escape_string($conn, $_POST['termname']);

   // first check the database to make sure 
  // a terminal does not already exist with the same term_id 
  $user_check_query = "SELECT * FROM terminal WHERE term_id='$termid'";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_num_rows($result);
  
  if ($user==1) { // if terminal exists
      echo "<script type='text/javascript'>alert('Terminal already exists')</script>";
    header('refresh:1;url=termentry.html');  
      }

  // Finally, add termianl  if there are no errors in the form
  if ($user==0) {
  	 $query1 = "INSERT INTO terminal (term_id,term_name) 
  			  VALUES('$termid','$termname')";
  	mysqli_query($conn, $query1);
  echo "<script type='text/javascript'>alert('Terminal added Successfully')</script>";

  	header('refresh:1;url=adminpage.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َTerminal Entry</title>
    <link rel="stylesheet" href="../css/bikeentry.css">
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

<form class="box"  method="post">
  <h1>ADD TERMINAL</h1>
  <h2>Enter Terminal ID</h2>
  <input type="number" name="termid" placeholder="Terminal ID" required>
  <h2>Enter Terminal name</h2>
   <input type="text" name="termname" placeholder="Terminal Name" required>
      <input type="submit" name="addter" value="ADD TERMINAL">
</form>

</div>

<!-- FOOTER STARTS HERE -->

<?php
include 'footer.php';
?>
<!-- Footer ends here -->


  </body>
</html>
