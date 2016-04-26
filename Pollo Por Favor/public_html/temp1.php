<?php
   include('config.php');

   session_start();
   
   $ses_dessert = mysqli_query($con,"select * from menu_items where food_type = 'Dessert' ");
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
    <head>
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
            <div id="main">Main content
                <table>
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
                <hr class="orderPageItemDivider">

                <?php
                $i=1;
                //echo $login_session; 
                for ($row = mysqli_fetch_row($ses_dessert); $row != false; $row = mysqli_fetch_row($ses_dessert)) {
                    //printf("%s", $row[1]);
                echo "<table>
                    <tr>
                         <td class='col_orderPageNum'>".$i."</td>
                         <td class='col_itemName'>".$row[1]."</td> 
                         <td class='col_description'>".$row[4]."</td> 
                         <td class='col_quantity'>Quantity</td>
                         <td class='col_rating'>Rating</td>                     
                    </tr>
                    <tr>
                        <td class='col_orderPageNum'> </td>
                        <td class='col_itemName'>
                            <button type='button'>Add to Cart</button>
                        </td>
                        <td class='col_description'>".$row[2]."</td>    
                        <td class='col_quantity'>
                            <input type='number' name='quantity' min='1' max='10'>
                        </td>    
                        <td class='col_rating'>*****</td>    

                    </tr>                
                </table>
                <hr class='orderPageItemDivider'> ";
                $i++;    
                }
                    

                ?>

                    <!---<table>
                    <tr>
                        <td class="col_orderPageNum">2. </td>
                        <td class="col_itemName">Lemon Herb Chicken</td>    
                        <td class="col_description">Description</td>    
                        <td class="col_quantity">Quantity</td>    
                        <td class="col_rating">Rating</td>                       
                    </tr>
                    <tr>
                        <td class="col_orderPageNum"> </td>
                        <td class="col_itemName">
                            <button type="button">Add to Cart</button> 
                        </td>
                        <td class="col_description">$6.99</td>    
                        <td class="col_quantity">
                            <input type="number" name="quantity" min="1" max="10">

                        </td>    
                        <td class="col_rating">*****</td>    
                    </tr>                
                </table>
                <hr class="orderPageItemDivider">--->




            </div>

            <div id="sidebar">
                <div id="cart">
                    <p>Your Cart</p>
                    <p>Subtotal: $0.00</p>
                    <p>Tax: $0.00
                    <hr class="subtotalDivider">
                    <p>Total: $100.00

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
                <p>Breakfast</p>
                <p>Lunch</p>
                <p>Dinner</p>
                <p>Sides</p>
                <p>Beverages</p>
                <p>Dessert</p>

            </div>
        </div>

    </body>
</html>