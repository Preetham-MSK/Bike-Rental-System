<?php
include 'connection.php';
session_start();

$errors = array(); 

if (isset($_POST['signup'])) {
  // receive all input values from the form
  $fname = mysqli_real_escape_string($conn, $_POST['fname']);
  $lname = mysqli_real_escape_string($conn, $_POST['lname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  $dlno = mysqli_real_escape_string($conn, $_POST['dlno']);
  $password = mysqli_real_escape_string($conn, $_POST['cpassword']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { array_push($errors, "First Name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone is required"); }
  if (empty($dlno)) { array_push($errors, "D L no is required"); }
  if (empty($password)) { array_push($errors, "Password is required"); }
  // if ($password_1 != $password_2) {
  // array_push($errors, "The two passwords do not match");
  // }
 
 // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE email='$email' or dlno='$dlno'";
  $result = mysqli_query($conn, $user_check_query) or die(mysqli_error($conn));
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if($user['email']===$email){
    // if user  email exists
      array_push($errors, "User Email already exists");
      }
     if($user['dlno']===$dlno){
      //if user dlno exists
      array_push($errors, "D L no already exists");
     } 
   }


  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO user (fname, lname, email, phone, dlno, password) 
  			  VALUES('$fname','$lname', '$email','$phone', '$dlno', '$password')";
  	mysqli_query($conn, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location:homepage.php');
  }
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>َSignUp-Bike Renatl</title>
    <link rel="stylesheet" href="../css/signup.css">
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


<form class="box"  method="post">
  <h1>Sign UP</h1>
  <input type="text" name="fname" placeholder="First Name" required title="Enter First name">
  <input type="text" name="lname" placeholder="Last Name" title="Enter Last name">
  <input type="email" name="email" placeholder="Email" required title="Enter Email">
  <input type="number" name="phone" placeholder="Phone" required title="Enter Phone number">
  <input type="number" name="dlno" placeholder="DL Number" required title="Enter Driving Licence Number">
  <input type="password" name="password" id="passwd" placeholder="Password" required title="Enter Password">
  <input type="password" name="cpassword" id="cpasswd" placeholder="Re-Enter Password" required title="Re-Enter Password">
 <script type="text/javascript" src="../JS/password.js"></script>
  <input type="submit" name="signup" value="SIGN UP">

  <?php  if (count($errors) > 0) : ?>
  <div class="error">
    <?php foreach ($errors as $error) : ?>
      <p><?php echo $error ?></p>
    <?php endforeach ?>
  </div>
<?php  endif ?>

</form>
</div>


<!-- FOOTER STARTS HERE -->
<?php
include 'footer.php';
?>
<!-- Footer ends here -->

 </body>
</html>
