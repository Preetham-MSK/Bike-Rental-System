<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['uemail'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

$email=$_SESSION['uemail'];
$query1="SELECT * FROM payment WHERE email='$email' and date is NULL";
$result1= mysqli_query($conn,$query1);
$row1=mysqli_fetch_array($result1);

if(isset($_POST['pay'])){
 date_default_timezone_set('Asia/Calcutta');
  $date=date("Y-m-d H:i:s");
  $mode= mysqli_real_escape_string($conn, $_POST['mode']);
  $query2="UPDATE payment SET date='$date', mode='$mode' where email='$email' and date is NULL";
  mysqli_query($conn,$query2);
  unset($_SESSION[$email]);
  header('location:final.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment</title>
  <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"> -->
  <link rel="stylesheet" type="text/css" href="../css/payment.css">
  <link rel="stylesheet" type="text/css" href="../css/navbar.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
<meta name="robots" content="noindex,follow" />
</head>
<body>


    <!-- NAVIGATION -->

    <nav>
      <a href="mainpage.php"><img src="../images/logo.png" class="logo" alt="logo"></a>
      <ul>
        <li><a style="color: #3498db" href=""><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></a></li>
        <li><a href="mytransaction.php">MY TRANSACTION</a></li>
        <li><a href="">CONTACT US</a></li>
        <li><a style="color: #626282b8" href="logout.php">LOGOUT</a></li>
      </ul>
    </nav>
  
  <!-- END OF NAVIGATION -->

  <div class="page-wrapper">
  
    <div class="checkout-panel">
    
      <div class="panel-body">
        <h2 class="title">Payment Total : ₹<?php echo $row1['cost'];?></h2>

     
         <script type="text/javascript" src="payment.js"></script>
          <div class="payment-method">
            <label for="card" class="method card">
            
              <div class="card-logos">
                <img src="../images/visa_logo.png"/>
                <img src="../images/mastercard_logo.png"/>
              </div>

              <div class="radio-input">
               <input id="card" name="payment" type="radio" value="Card">
                Pay ₹<?php echo $row1['cost'];?> with credit card
              </div>
            </label>

            <label for="paypal" class="method paypal">
              <img src="../images/paypal_logo.png"/>
              <div class="radio-input">
                <input  id="paypal" name="payment" type="radio" value="Paypal">
                Pay ₹<?php echo $row1['cost'];?> with PayPal
              </div>
            </label>
          </div>

          <div class="input-fields">
              <div class="column-1">
                 <label for="cardholder">Cardholder's Name</label>
                 <input type="text" id="cardholder" />

                <div class="small-inputs">
                  <div>
                     <label for="date">Valid thru</label>
                     <input type="text" id="date" placeholder="MM / YY" />
                  </div>

                  <div class="cvv">
                   <label  for="verification">CVV / CVC *</label>
                   <input type="password" id="verification"/>
                  </div>
                </div>

              </div>

            <div class="column-2">
              <label for="cardnumber">Card Number</label>
              <input type="password" id="cardnumber"/>

              <span class="info">* CVV or CVC is the card security code, unique three digits number on the back of your card separate from its number.</span>
            </div>
          </div>
      </div>

      <div class="panel-footer">
        <button class="btn back-btn">Back</button>
        <form method="post">
        <input type="hidden" id="paymode" name="mode" value="card">
        <button type="submit" class="btn next-btn" name="pay" onclick="getInputValue();" >Pay</button>
        </form>

      </div>
    </div>
          <script type="text/javascript" src="../JS/payment.js"></script>
          <script type="text/javascript" src="../JS/paymode.js"></script>

  </div>

<!-- FOOTER STARTS HERE -->
<?php
include 'footer.php';
?>

<!-- FOOTER ENDS HERE -->

</body>
</html>