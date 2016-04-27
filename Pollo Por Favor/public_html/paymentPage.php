<?php
include('config.php');

//session_start();
//
//   $ses_sql = mysqli_query($con,"select username from user where username = '".$_SESSION["username"]."' ");
//   
//   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
//   
//   $login_session = $row['username'];
//   
//   if(!isset($_SESSION['username'])){
//      header("location:login2.php");
//   }

$totalPrice;
global $totalPrice;

if (isset($_POST["totalPrice"]) && isset($_POST["tip"])) {

    $totalPrice = $_POST["totalPrice"] + $_POST["tip"];
}
?>


<html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="paymentPage.js"></script>
    <style>
.dropbtn {
    background-color: brown;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: brown;
}
</style>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="paymentPage.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Payment</title>
        <link rel="stylesheet" type="text/css" href="css/orderPage.css">
    </head>
    <body>
        <div id="header">
            <table class="header_table">
                <tr>
                    <td class="col_header_logo"> 
                        <a href="index.html">
                            <img src="pix/PPF_logo.png" alt="Pollo Por Favor logo" width="80" height="80">
                        </a>
                    </td>
                    <td class="col_header_address">
                        <p>2140 L Street, NW
                            <br>
                            Washington, DC 20037<p>        
                    </td>
                    <td class="col_header_username">
<!--                        <p>Welcome, <?php echo $login_session; ?></p>-->
                        <br>
                        <a href="logout.php"><button type="button">Sign Out</button></a>

                    </td>
                </tr>
            </table>
            <br>
        </div>
    </head>
    <body>
        <br>
        <div>Enter Card Information:</div>
        <br>
        <div class="dropdown">
  <h1>Total Cost: $<?php echo round($totalPrice, 2) ?></h1>
  <br>
  <button class="dropbtn"><div id = "drop_button" >Select Card Type </div></button>
 
  <div class="dropdown-content">
      <a id = "Visa"> <button class = "dropbtn">Visa</button></a>
      <a id = "Master"> <button class = "dropbtn">Master</button></a>
      <a id = "American_Express"> <button  class = "dropbtn">American Express</button></a>
  </div>
</div>
        <form action='paymentPage.php' method='post' target='_top'>
            <br>
            <input type = "text" name = "Card_Holder_Name" required="required" placeholder="Card Holder" class = "box">
            <br>
            <br>
            <input type = "text" name = "Card_Number" required="required" placeholder="Card Number" class = "box">
            <br>
            <br>
            <input type ="text" name ="Expiration_Date" required="required" placeholder="Expiration Date" class ="box">
            <br>
            <br>
            <input type = "text" name = "Security_Code" required="required" placeholder="Security Code" class = "box">
            <br>
            <br>
            <input type='submit' name='complete_order' value='Complete Order'>
        </form>
        
        <?php
 if ((isset($_POST["Card_Holder_Name"]) && isset($_POST["Card_Number"]) && isset($_POST["Expiration_Date"]) && isset($_POST["Security_Code"]))) {
    $cardHolderName = $_POST["Card_Holder_Name"];
    $cardNumber = $_POST["Card_Number"];
    $expirationDate = $_POST["Expiration_Date"];
    $securityCode = $_POST["Security_Code"];
    if(strlen($expirationDate) > 5 || strlen($expirationDate) < 5) {
        echo "invalid expiration date length ";
    }
   else if(strlen($securityCode) > 3 || strlen($securityCode) < 3) {
        echo "invalid security code ";
    }
    else if(strlen($cardNumber) > 16 || strlen($cardNumber) < 16) {
      echo "invalid card length ";   
    }
 else {
   echo "<script>window.open('orderSuccessful.php','_self')</script>";  
 }
 }
?>
        <br>
            
    </body>
</html>