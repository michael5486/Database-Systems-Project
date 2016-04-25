<?php
   include('config.php');

   session_start();
   
   $ses_sql = mysqli_query($con,"select username from user where username = '".$_SESSION["username"]."' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['username'])){
      header("location:login2.php");
   }
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
		<h1>Welcome <font color="red"><?php echo $login_session; ?></h1></font>
		<h2><a href = "logout.php">Sign Out</a></h2>
	</body>
	</html>