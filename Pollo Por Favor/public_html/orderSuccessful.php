<?php
include('config.php');



$totalPrice;
global $totalPrice;

if (isset($_POST["totalPrice"]) && isset($_POST["tip"])) {

    $totalPrice = $_POST["totalPrice"] + $_POST["tip"];
}
?>

<!DOCTYPE html>
<html>
    <head>
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
                        <p>Username</p>
                    </td>
                </tr>
            </table>
            <br>
        </div>
    </head>
<body>
    <br>
    <h1>Order was successful. Total Cost: $<?php echo round($totalPrice, 2) ?></h1>
</body>
</html>
