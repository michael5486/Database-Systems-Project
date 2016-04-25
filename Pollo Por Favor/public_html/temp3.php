<?php
   include('config.php');

   session_start();
   
   $ses_dessert = mysqli_query($con,"select * from menu_items where food_type = 'Dessert' ");
   $ses_dinner = mysqli_query($con,"select * from menu_items where food_type = 'Dinner' ");
   
?>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login</title>
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link href="css/login.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/fonts.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body>
        <div id="menu">
            <ul>
                <li><a href="index.html" accesskey="1" title="">Home</a></li>
                <li><a href="menu.pdf" accesskey="2" title="">Menu</a></li>
                <li><a href="aboutUs.html" accesskey="3" title="">About Us</a></li>
                <li><a href="contact.html" accesskey="4" title="">Contact Us</a></li>
                <li  class="current_page_item"><a href="login2.php" accesskey="5" title="">Login</a></li>
            </ul>
        </div>
		<h2> 
		
			Dinner: <font color="red"> 
			<?php //echo $login_session; 
				for( $row= mysqli_fetch_row($ses_dinner); $row != false; $row = mysqli_fetch_row($ses_dinner) ) {
					//echo "$row\n";
					printf( "%s", $row[1]);
					echo "<br>";
					
				}
			
			?></font>
			<br>
			<br>
			Dessert: <font color="red"> 
			<?php //echo $login_session; 
				for( $row= mysqli_fetch_row($ses_dessert); $row != false; $row = mysqli_fetch_row($ses_dessert) ) {
					//echo "$row\n";
					printf( "%s", $row[1]);
					echo "<br>";
					
				}
			
			?> </font>
			<br>
			
		</h2>
		<br>
		<h2> 
		</h2>
	</body>
	</html>