<?php
include('config.php');

session_start();

$ses_breakfast = mysqli_query($con, "select * from menu_items where food_type = 'Breakfast' ");
$ses_lunch = mysqli_query($con, "select * from menu_items where food_type = 'Lunch' ");
$ses_dinner = mysqli_query($con, "select * from menu_items where food_type = 'Dinner' ");
$ses_sides = mysqli_query($con, "select * from menu_items where food_type = 'Side' ");
$ses_beverages = mysqli_query($con, "select * from menu_items where food_type = 'Beverage' ");
$ses_dessert = mysqli_query($con, "select * from menu_items where food_type = 'Dessert' ");
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
                        <p>Username</p>
                    </td>
                </tr>
            </table>
            <br>
        </div>

        <div id="wrapper">
            <div id="main">
                <!---<table>
                    <tr>
                        <td class="col_orderPageNum">1. </td>
                        <td class="col_itemName">Item Name</td>    
                        <td class="col_description">Description</td>    
                        <td class="col_quantity">Quantity</td>    
                        <td class="col_rating">Rating</td>                       
                    </tr>
                    <tr>
                        <td class="col_orderPageNum"> </td>
                        <td class="col_itemName">
                            <button type="button">Add to Cart</button> 
                        </td>
                        <td class="col_description">Price</td>    
                        <td class="col_quantity">
                            <input type="number" name="quantity" min="1" max="10">
                        </td>    
                        <td class="col_rating">*****</td>    

                    </tr>                
                </table>
                <hr class="orderPageItemDivider">--->

                <?php
                //Starting Breakfast List----------

                echo "<div id='breakfastList'>";
                $i = 1;
                for ($row = mysqli_fetch_row($ses_breakfast); $row != false; $row = mysqli_fetch_row($ses_breakfast)) {

                    echo "
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $i . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <button type='button'>Add to Cart</button>
                        </td>
                        <td class='col_description'>" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                <hr class='orderPageItemDivider'> ";
                    $i++;
                }

                echo "</div>";

                //Starting LunchList----------

                echo "<div id='lunchList'>";
                for ($row = mysqli_fetch_row($ses_lunch); $row != false; $row = mysqli_fetch_row($ses_lunch)) {
                    echo "
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $i . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <button type='button'>Add to Cart</button>
                        </td>
                        <td class='col_description'>" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                <hr class='orderPageItemDivider'> ";
                    $i++;
                }

                echo "</div>";
                
               //Starting DinnerList------------
                
                echo "<div id='dinnerList'>";
                for ($row = mysqli_fetch_row($ses_dinner); $row != false; $row = mysqli_fetch_row($ses_dinner)) {
                    echo "
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $i . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <button type='button'>Add to Cart</button>
                        </td>
                        <td class='col_description'>" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                <hr class='orderPageItemDivider'> ";
                    $i++;
                }

                echo "</div>";                

               //Starting SidesList----------
                
                echo "<div id='sidesList'>";
                for ($row = mysqli_fetch_row($ses_sides); $row != false; $row = mysqli_fetch_row($ses_sides)) {
                    echo "
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $i . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <button type='button'>Add to Cart</button>
                        </td>
                        <td class='col_description'>" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                <hr class='orderPageItemDivider'> ";
                    $i++;
                }

                echo "</div>";

               //Starting BeveragesList-------------
                
                echo "<div id='beveragesList'>";
                for ($row = mysqli_fetch_row($ses_beverages); $row != false; $row = mysqli_fetch_row($ses_beverages)) {
                    echo "
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $i . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <button type='button'>Add to Cart</button>
                        </td>
                        <td class='col_description'>" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                <hr class='orderPageItemDivider'> ";
                    $i++;
                }

                echo "</div>";                
                
                //Starting DessertList

                echo "<div id='dessertList'>";
                for ($row = mysqli_fetch_row($ses_dessert); $row != false; $row = mysqli_fetch_row($ses_dessert)) {
                    echo "
                    <table>
                    <tr>
                         <td class='col_orderPageNum'>" . $i . "</td>
                         <td class='col_itemName'>" . $row[1] . "</td> 
                         <td class='col_description'>" . $row[4] . "</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <button type='button'>Add to Cart</button>
                        </td>
                        <td class='col_description'>" . $row[2] . "</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                <hr class='orderPageItemDivider'> ";
                    $i++;
                }

                echo "</div>";
                ?>

            </div>


            <div id="sidebar">
                <div id="cart">
                    <p>Your Cart</p>
                    <p>Subtotal: $0.00</p>
                    <p>Tax: $0.00
                    <p>Tip: <input type="number" step="0.01" min="0">
                    </p>   
                    <hr class="subtotalDivider">
                    <p>Total: $100.00
                        <br>
                        <br>
                        <button type="button">Checkout</button> 


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