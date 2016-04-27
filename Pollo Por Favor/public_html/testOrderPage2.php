<?php
include('config.php');

session_start();

   $ses_sql = mysqli_query($con,"select username from user where username = '".$_SESSION["username"]."' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['username'])){
      header("location:login2.php");
   }

$ses_breakfast = mysqli_query($con, "select * from menu_items where food_type = 'Breakfast'; ");
$ses_lunch = mysqli_query($con, "select * from menu_items where food_type = 'Lunch'; ");
$ses_dinner = mysqli_query($con, "select * from menu_items where food_type = 'Dinner'; ");
$ses_sides = mysqli_query($con, "select * from menu_items where food_type = 'Side'; ");
$ses_beverages = mysqli_query($con, "select * from menu_items where food_type = 'Beverage'; ");
$ses_dessert = mysqli_query($con, "select * from menu_items where food_type = 'Dessert'; ");

$ticket_num = 1;
global $ticket_num; //makes global variables
?>

<?php
if ((isset($_POST["itemID"]) && isset($_POST["quantity"]) && isset($_POST["price"]))) {

    $id = $_POST["itemID"];
    echo "<p>Item ID: " . $id . "<br>";

    Quantity:
    $quantity = $_POST["quantity"];
    echo "<p>Quantity: " . $quantity . "<br>";

    $price = $_POST["price"];
    echo "<p>Price:" . ($price * $quantity) . "<br>";
    //$subtotal += ($price * $quantity);

    if (isset($_POST["add"])) {
        for ($i = 0; $i < $quantity; $i++) { //inserts proper quantity of items
            $insertItems = "INSERT into order_items(item_ID, ticket_num) VALUES (" . $id . ", " . 4 . ");";
            if (mysqli_query($con, $insertItems)) {
                //do nothing
            } else {
                echo "Error: " . $insertItems . "<br>" . mysqli_error($con);
            }
        }
    }

    if (isset($_POST["remove"])) {
        echo "DELETE FROM `order_items` WHERE item_id = " . $_POST["itemID"] . " AND ticket_num = 4; <br>";

        $deleteItems = mysqli_query($con, "DELETE FROM `order_items` WHERE item_id = " . $_POST["itemID"] . " AND ticket_num = 4;");
        if (mysqli_query($con, $deleteItems)) {
            //do nothing
        } else {
            echo "Error: " . $deleteItems . "<br>" . mysqli_error($con);
        }
    }

    $subtotal = 0.00;
    $tax_multiplier = 0.0575; //sales tax for DC

    $updateCartCost = mysqli_query($con, "SELECT menu_items.item_price
    FROM `menu_items`
    INNER JOIN order_items
    ON menu_items.item_ID=order_items.item_ID;"); //ticket_num will increment with each new order
    
    for ($row = mysqli_fetch_row($updateCartCost); $row != false; $row = mysqli_fetch_row($updateCartCost)) {
        $subtotal += $row[0]; //adds cost to subtotal
        echo "Subtotal: " . $subtotal;
    }
    echo "<br>";

    $total_tax = $subtotal * $tax_multiplier;

    $totalPrice = $total_tax + $subtotal;

    global $subtotal, $total_tax, $totalPrice;

    echo "totalPrice: " . $totalPrice . "<br>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="orderPage.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Order Now</title>
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
                        <p>Welcome, <?php echo $login_session; ?></p>
                        <br>
                        <a href="logout.php"><button type="button">Sign Out</button></a>
                    </td>
                </tr>
            </table>
            <br>
        </div>

        <div id="wrapper">
            <div id="main">


<?php
//Starting Breakfast List----------

echo "<div id='breakfastList'>Breakfast";
for ($row = mysqli_fetch_row($ses_breakfast); $row != false; $row = mysqli_fetch_row($ses_breakfast)) {

    echo "
                    <form action='testOrderPage2.php' method='post' target='_top'>
                    <input type='hidden' name='itemID' value=" . $row[0] . ">
                    <input type='hidden' name='price' value=" . $row[2] . ">
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $row[0] . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <input type='submit' name='add' value='Add to Cart'>
                            <input type='submit' name='remove' value='Remove All'>
                        </td>
                        <td class='col_description'>$" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10' value='1'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                </form>
                <hr class='orderPageItemDivider'> ";
}

echo "</div>";

//Starting LunchList----------

echo "<div id='lunchList'>Lunch";
for ($row = mysqli_fetch_row($ses_lunch); $row != false; $row = mysqli_fetch_row($ses_lunch)) {
    echo "
                    <form action='testOrderPage.php' method='post' target='_top'>
                    <input type='hidden' name='itemID' value=" . $row[0] . ">
                    <input type='hidden' name='price' value=" . $row[2] . ">
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $row[0] . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <input type='submit' name='add' value='Add to Cart'>
                            <input type='submit' name='remove' value='Remove All'>
                        </td>
                        <td class='col_description'>$" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10' value='1'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                </form>
                <hr class='orderPageItemDivider'> ";
}

echo "</div>";

//Starting DinnerList------------

echo "<div id='dinnerList'>Dinner";
for ($row = mysqli_fetch_row($ses_dinner); $row != false; $row = mysqli_fetch_row($ses_dinner)) {
    echo "
                    <form action='testOrderPage.php' method='post' target='_top'>
                    <input type='hidden' name='itemID' value=" . $row[0] . ">
                    <input type='hidden' name='price' value=" . $row[2] . ">
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $row[0] . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <input type='submit' name='add' value='Add to Cart'>
                            <input type='submit' name='remove' value='Remove All'>
                        </td>
                        <td class='col_description'>$" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10' value='1'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                </form>
                <hr class='orderPageItemDivider'> ";
}

echo "</div>";

//Starting SidesList----------

echo "<div id='sidesList'>Sides";
for ($row = mysqli_fetch_row($ses_sides); $row != false; $row = mysqli_fetch_row($ses_sides)) {
    echo "
                    <form action='testOrderPage.php' method='post' target='_top'>
                    <input type='hidden' name='itemID' value=" . $row[0] . ">
                    <input type='hidden' name='price' value=" . $row[2] . ">
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $row[0] . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <input type='submit' name='add' value='Add to Cart'>
                            <input type='submit' name='remove' value='Remove All'>
                        </td>
                        <td class='col_description'>$" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10' value='1'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                </form>
                <hr class='orderPageItemDivider'> ";
}

echo "</div>";

//Starting BeveragesList-------------

echo "<div id='beveragesList'>Beverages";
for ($row = mysqli_fetch_row($ses_beverages); $row != false; $row = mysqli_fetch_row($ses_beverages)) {
    echo "
                    <form action='testOrderPage.php' method='post' target='_top'>
                    <input type='hidden' name='itemID' value=" . $row[0] . ">
                    <input type='hidden' name='price' value=" . $row[2] . ">
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $row[0] . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <input type='submit' name='add' value='Add to Cart'>
                            <input type='submit' name='remove' value='Remove All'>
                        </td>
                        <td class='col_description'>$" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10' value='1'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                </form>
                <hr class='orderPageItemDivider'> ";
}

echo "</div>";

//Starting DessertList

echo "<div id='dessertList'>Dessert";
for ($row = mysqli_fetch_row($ses_dessert); $row != false; $row = mysqli_fetch_row($ses_dessert)) {
    echo "
                    <form action='testOrderPage.php' method='post' target='_top'>
                    <input type='hidden' name='itemID' value=" . $row[0] . ">
                    <input type='hidden' name='price' value=" . $row[2] . ">
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $row[0] . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <input type='submit' name='add' value='Add to Cart'>
                            <input type='submit' name='remove' value='Remove All'>
                        </td>
                        <td class='col_description'>$" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10' value='1'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                </form>
                <hr class='orderPageItemDivider'> ";
}

echo "</div>";
?>

            </div>


            <div id="sidebar">
                <div id="cart">
                    <p>Your Cart</p>
                    <p>Subtotal: $<?php echo $subtotal; ?></p>
                    <p>Tax: $<?php echo round($total_tax, 2); ?></p>
                    <form action='paymentPage.php' method='post' target='_blank'>
                        <p>Tip: 
                            <input type="number" step="0.01" min="0" name='tip'> 
                        </p>
                        <hr class="subtotalDivider">

                        Total: $<?php echo round($totalPrice, 2); ?></p>
                        <input type='hidden' name='totalPrice' value='<?php echo $totalPrice ?>'>
                        <input type="submit" value="Checkout"> 
                    </form>

                    <hr class="cartRatingsDivider">
                </div>
                <div id="ratings">
                    <p> Top-Rated Items</p>
                    <p>1. Lemon-Herb Chicken</p>
                    <p>2. Pisco</p>
                    <p>3. Churros</p>
                    <p>4. Tres Leches</p>
                    <p>5. Hot Chocolate</p>


                </div>

            </div>

            <div id="nav">
                <br>
                <br>
                <p id="breakfastNav">Breakfast</p>
                <p id="lunchNav">Lunch</p>
                <p id="dinnerNav">Dinner</p>
                <p id="sidesNav">Sides</p>
                <p id="beveragesNav">Beverages</p>
                <p id="dessertNav">Dessert</p>

            </div>
        </div>

    </body>
</html>