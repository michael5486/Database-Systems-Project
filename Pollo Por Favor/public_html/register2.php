<?php
 
include 'config.php';
session_start();
 
if(isset($_SESSION['username'])!="")
{
  header("location: temp.php");
}
 
 
if(isset($_POST['submit']))
{
    $sql = "INSERT INTO user (username, password) VALUES ('".$_POST["username"]."','".$_POST["password"]."')";
    if (mysqli_query($con, $sql)) 
  {
    $_SESSION['username'] = $_POST["username"];
    header("location: login2.php");
    } 
  else
  {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
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
        <div class="login-page">
			<div class="form">	
                <form class="login-form" action="register2.php" method="post" >
					<input type = "text" name = "username" required="required" placeholder="username" class = "box"/><br/>
					<input type = "password" name = "password" required="required" placeholder="password" class = "box" /><br/>
					<input type="submit" name= "submit" value="Submit"/><br />
					<p class="message">Already registered? <a href="http://52.70.106.129/login2.php">Sign in.</a></p>
				</form>   
			</div>	
        </div>
        
    </body>
    <script>
        $('.message a').click(function () {
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
    </script>
</html>