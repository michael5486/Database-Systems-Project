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
		global $ticket_num, $username ; //makes global variables

	} else { //user isn't in a session...go back to login page
		header("location:login2.php");
	}
	
	$totalPrice;

	if (isset($_POST["totalPrice"]) && isset($_POST["tip"])) {
		$totalPrice = $_POST["totalPrice"] + $_POST["tip"];
	}  
	
	if( isset($_POST["add"]) && isset($_POST["itemID"]) && isset($_POST["quantity"] ) ) {
		//echo $_POST["itemID"]."<br>";
		//echo $_POST["quantity"]."<br>";
		$insertItem = "INSERT into user_rating(item_ID, rating) VALUES (".$_POST['itemID'].",".$_POST['quantity'].");";
		if (mysqli_query($con, $insertItem)) {
            //do nothing
        } else {
            echo "Error: " . $insertItem . "<br>" . mysqli_error($con);
        }
	}
		


	$sql = "SELECT order_items.item_ID, user_rating.rating, menu_items.item_name
		FROM `order_items` 
		INNER JOIN `user_rating` ON `order_items`.`item_ID` = `user_rating`.`item_ID`
		INNER JOIN `menu_items` ON `order_items`.`item_ID` = `menu_items`.`item_ID` 
		WHERE `order_items`.`ticket_num` = ".$ticket_num.";";
	
	$sql2 = "SELECT DISTINCT order_items.item_ID, menu_items.item_name
      FROM `order_items`
      INNER JOIN `menu_items` ON `order_items`.`item_ID` = `menu_items`.`item_ID` 
      WHERE `order_items`.`ticket_num` = ".$ticket_num.";";
	
	$ratingTable1 = mysqli_query($con, $sql); // Get each item's rating in user_rating history as long as its on current ticket_num
    $itemNums = mysqli_query($con, $sql2);
	
	// Initialize arrays to store cumulative ratings and number of ratings
	$rating = [];
	$ratingCount = [];
	$num_rows = mysqli_num_rows($itemNums);
	
	for($i=0; $i<$num_rows; $i++ ) {
		//echo $i;
		$rating[i] = 0;
		$ratingCount[i] = 0;
	}
	
	$a = 0;
	while( $r = mysqli_fetch_assoc($ratingTable1)  ) {
		$a++;
		$b = 0;
		//echo $a;
		//echo "ID= " .$r['item_ID'].", r=".$r['rating'].", name=".$r['item_name'];
		//echo "<br>";
		
		mysqli_data_seek($itemNums,0);
		while( $c = mysqli_fetch_assoc($itemNums) ) {
			$b++;
			//echo "-".$b;
			//echo "---ID= " .$c['item_ID'].", name=".$c['item_name'];
			//echo "<br>";
			
			if( $r['item_ID'] == $c['item_ID'] ) {		// If item numbers match
				//echo "------IDS MATCH <br>";
				$rating[$b] = $rating[$b]+$r['rating'];
				$ratingCount[$b]++; 
				//echo "rating: " . $rating[$b] ."<br>";
				//echo "ratingCount: " . $ratingCount[$b] ."<br>";
			}
			
			
		}
		//echo "<br>";
	}
	
	
	for( $i=1; $i<($num_rows+1); $i++ ) {
		//echo "ratingtot=".$rating[$i].", ratingC=".$ratingCount[$i];
		$n = $rating[$i]/$ratingCount[$i];
		$rating[$i] = $n;
		//echo " FINAL RATING: ".$rating[$i]."<br>";
	}
	
	$ratingTable = mysqli_query($con, $sql2);
	
	global $ratingTable, $totalPrice, $rating;
   
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
                         <p>Welcome, <?php echo $username; ?></p>
                    </td>
                </tr>
            </table>
            <br>
        </div>
    </head>
<body>
    <div id="wrapper">
        <div id="main">
			<h1>Order was successful. Total Cost: $<?php echo round($totalPrice, 2) ?></h1>
                        <h1>Your food will arrive in approximately 30 minutes</h1>
                        <?php
                        $sql3 = "SELECT driver_name FROM driver ORDER BY RAND() LIMIT 1;";
                        $result = mysqli_query($con, $sql3);
                        $row1 = mysqli_fetch_row($result);
                        // output data of each row
                           echo "<h1>Your driver is ".$row1[0]."</h1>";
                        
                        ?>
			<h2>
			Please rate your ordered items below: <br>
			</h2>
			<h4>
			
			<?php
				$i = 1;
				for ($row = mysqli_fetch_row($ratingTable); $row != false; $row = mysqli_fetch_row($ratingTable)) {
					echo "
                    <form action='orderSuccessfultest.php' method='post' target='_top'>
					 <input type='hidden' name='itemID' value=" . $row[0] . ">
				   <table>
					<tr>
                         <td class='col_itemName'>Item Name</td> 
						 <td class='col_rating'>Current Rating</td>   
                         <td class='col_quantity'>Your Rating</td>
                    </tr>
					
                    <tr>
                         <td class='col_itemName'>" . $row[1] . "</td> 
						 <td class='col_rating'>" . round($rating[$i], 1) . "</td>   
                         <td class='col_quantity'>
                            <input type='number' name='quantity' step='0.5' min='1' max='5' >
							<input type='submit' name='add'  value='Rate Item'>
                        </td>                   
                    </tr>            
                </table>
                </form>";
				$i++;
				}
			
			?>
			
			</h4>
			
		</div>
	</div>
</body>
</html>













