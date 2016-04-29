<?php
include('config.php');

session_start();
if (isset($_SESSION['username'])) { //is a user is in a session
    //echo "Username: " .$_SESSION['username']."<br>";
    //echo "ticket_num " .$_SESSION['ticket_num']."<br>";
    //echo "totalPrice " .$_SESSION['totalPrice']."<br>";
    $ticket_num = $_SESSION['ticket_num'];
    $username = $_SESSION['username'];
    $totalPrice = $_SESSION['totalPrice'];
    global $ticket_num, $username; //makes global variables
} else { //user isn't in a session...go back to login page
    header("location:login2.php");
}

$totalPrice;

if (isset($_POST["totalPrice"]) && isset($_POST["tip"])) {
    $totalPrice = $_POST["totalPrice"] + $_POST["tip"];
    $_SESSION["tip"] = $_POST["tip"];
}

if (isset($_POST["add"]) && isset($_POST["itemID"]) && isset($_POST["quantity"])) {
    //echo $_POST["itemID"] . "<br>";
    //echo $_POST["quantity"] . "<br>";
    $insertItem = "INSERT into user_rating(item_ID, rating) VALUES (" . $_POST['itemID'] . "," . $_POST['quantity'] . ");";
    if (mysqli_query($con, $insertItem)) {
        //do nothing
    } else {
        echo "Error: " . $insertItem . "<br>" . mysqli_error($con);
    }
}

/*echo "order_cost: " . $_SESSION["order_cost"] . "<br>";
echo "comment: " . $_POST["comment"] . "<br>";
echo "ticket_num: " . $_SESSION["ticket_num"] . "<br>";
echo "tip: " . $_SESSION["tip"] . "<br>";
echo "totalPrice: " . $_SESSION["totalPrice"] . "<br>";
echo "tax: " . $_SESSION["tax"] . "<br>";
*/


if (isset($_POST["complete_order"]) && isset($_POST["comment"]) && isset($_SESSION["order_cost"]) && isset($_SESSION["ticket_num"]) && isset($_SESSION["tip"]) && isset($_SESSION["totalPrice"]) && isset($_SESSION["tax"])) {
    $order_cost = $_SESSION["order_cost"];
    $special_instructions = $_POST["comment"];
    $ticket_num = $_SESSION["ticket_num"];
    $tip = $_SESSION["tip"];
    $totalPrice = $_SESSION["totalPrice"] + $_SESSION["tip"];
    $tax = $_SESSION["tax"];

    $insertOrderInfo = "INSERT INTO `order_info`(`order_cost`, `special_instructions`, `ticket_num`, `tip`, 
                                `total_cost`, `tax`) VALUES (" . $order_cost . ",'" . $special_instructions . "'," .
            $ticket_num . "," . $tip . "," . $totalPrice . "," . $tax . ");";
    if (mysqli_query($con, $insertOrderInfo)) {
        //do nothing
    } else {
        //echo "Error: " . $insertOrderInfo . "<br>" . mysqli_error($con);
    }
}



$sql = "SELECT order_items.item_ID, user_rating.rating, menu_items.item_name
		FROM `order_items` 
		INNER JOIN `user_rating` ON `order_items`.`item_ID` = `user_rating`.`item_ID`
		INNER JOIN `menu_items` ON `order_items`.`item_ID` = `menu_items`.`item_ID` 
		WHERE `order_items`.`ticket_num` = 5"/* .$ticket_num */;

$sql2 = "SELECT order_items.item_ID, menu_items.item_name
      FROM `order_items`
      INNER JOIN `menu_items` ON `order_items`.`item_ID` = `menu_items`.`item_ID` 
      WHERE `order_items`.`ticket_num` = 5"/* .$ticket_num */;

$ratingTable1 = mysqli_query($con, $sql); // Get each item's rating in user_rating history as long as its on current ticket_num
$itemNums = mysqli_query($con, $sql2);

// Initialize arrays to store cumulative ratings and number of ratings
$rating = [];
$ratingCount = [];
$num_rows = mysqli_num_rows($itemNums);

for ($i = 0; $i < $num_rows; $i++) {
    //echo $i;
    $rating[i] = 0;
    $ratingCount[i] = 0;
}

$a = 0;
while ($r = mysqli_fetch_assoc($ratingTable1)) {
    $a++;
    $b = 0;
    //echo $a;
    //echo "ID= " .$r['item_ID'].", r=".$r['rating'].", name=".$r['item_name'];
    //echo "<br>";

    mysqli_data_seek($itemNums, 0);
    while ($c = mysqli_fetch_assoc($itemNums)) {
        $b++;
        //echo "-".$b;
        //echo "---ID= " .$c['item_ID'].", name=".$c['item_name'];
        //echo "<br>";

        if ($r['item_ID'] == $c['item_ID']) {  // If item numbers match
            //echo "------IDS MATCH <br>";
            $rating[$b] = $rating[$b] + $r['rating'];
            $ratingCount[$b] ++;
            //echo "rating: " . $rating[$b] ."<br>";
            //echo "ratingCount: " . $ratingCount[$b] ."<br>";
        }
    }
    //echo "<br>";
}


for ($i = 1; $i < ($num_rows + 1); $i++) {
    //echo "ratingtot=".$rating[$i].", ratingC=".$ratingCount[$i];
    $n = $rating[$i] / $ratingCount[$i];
    $rating[$i] = $n;
    //echo " FINAL RATING: ".$rating[$i]."<br>";
}

$ratingTable = mysqli_query($con, $sql2);

global $ratingTable, $totalPrice, $rating;
?>


<!DOCTYPE html>
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

        .colLeft { 
            padding: 30px;
            width:50%;	
        }

        .colRight {
            padding: 30px;
            width:50%;
        }
    </style>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="paymentPage.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Order Successful!</title>
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
                        <p>Welcome, <?php echo $username; ?></p>
                        <a href="logout.php"><button type="button">Sign Out</button></a>
                    </td>
                </tr>
            </table> <br>
        </div>
    </head>

    <div id="wrapper">
        <div id="main">
            <h1>Total Cost: $<?php echo round($totalPrice, 2) ?></h1> <br>

            <table>
                <tr>
                    <td id="colLeft">
                        <div>Enter Card Information:</div>
                        <br>
                        <div class="dropdown">
                            <br>
                            <button class="dropbtn"><div id = "drop_button" >Select Card Type </div></button>

                            <div class="dropdown-content">
                                <a id = "Visa"> <button class = "dropbtn">Visa</button></a>
                                <a id = "Master"> <button class = "dropbtn">Master</button></a>
                                <a id = "American_Express"> <button  class = "dropbtn">American Express</button></a>
                            </div>
                        </div>

                        <form action='officialPaymentPage.php' method='post' target='_top'>
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

                            </td>
                            <td id="colRight">
                                Please add any special instructions for your order below:<br><br>
                                <textarea name="comment" rows="5" cols="40"></textarea><br><br>
                        </form>
                    </td>
                </tr>
            </table>

            <?php
            if ((isset($_POST["Card_Holder_Name"]) && isset($_POST["Card_Number"]) && isset($_POST["Expiration_Date"]) && isset($_POST["Security_Code"]))) {
                $cardHolderName = $_POST["Card_Holder_Name"];
                $cardNumber = $_POST["Card_Number"];
                $expirationDate = $_POST["Expiration_Date"];
                $securityCode = $_POST["Security_Code"];
                if (strlen($expirationDate) > 5 || strlen($expirationDate) < 5) {
                    echo "invalid expiration date length ";
                } else if (strlen($securityCode) > 3 || strlen($securityCode) < 3) {
                    echo "invalid security code ";
                } else if (strlen($cardNumber) > 16 || strlen($cardNumber) < 16) {
                    echo "invalid card length ";
                } else {

                    echo "<script>window.open('orderSuccessfultest.php','_self')</script>";
                }
            }
            ?>


        </div>
    </div>
</body>
</html>













