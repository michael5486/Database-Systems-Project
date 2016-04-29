<?php
include("config.php");
session_start();

if (isset($_SESSION['username']) != "") {
    header("location: testOrderPage.php");
}

if (mysqli_connect_errno()) {
    echo "MySQLi Connection was not established: " . mysqli_connect_error();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sel_user = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $run_user = mysqli_query($con, $sel_user);

    $check_user = mysqli_num_rows($run_user);

    if ($check_user > 0) {
        $insertNewOrder = "INSERT INTO `order_history`(`username`) VALUES ('" . $username . "');"; //inserts new record into orderHistory
        if (mysqli_query($con, $insertNewOrder)) {
            //do nothing
        }
        else { 
            echo "Error: " . $insertNewOrder . "<br>" . mysqli_error($con);
        }
        
        $ticket_num_query = mysqli_query($con, "SELECT MAX(ticket_num) FROM order_history;"); //retrives the ticket_num of the inserted order
        $ticket_num_row = mysqli_fetch_array($ticket_num_query);
        $ticket_num = $ticket_num_row[0]; //returns max ticket_num in database
        //echo "ticket_num: " . $ticket_num . "<br>";
        
        $_SESSION['username'] = $username;
        $_SESSION['ticket_num'] = $ticket_num;
        echo "<script>window.open('testOrderPage.php','_self')</script>";
    } else {
        echo "<script>alert('Email or password is not correct, try again!')</script>";
    }
}
?>

<!DOCTYPE html><?php session_start(); ?>



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
                <form class = "login-form" action="login2.php" method="post">
                    <input type = "text" name = "username" required="required" placeholder="username" class = "box"/><br/>
                    <input type = "password" name = "password" required="required" placeholder="password" class = "box" /><br/>
                    <input type="submit" name="login" value="Login"/><br />
                    <p class="message">Not registered? <a href="http://52.70.106.129/register2.php">Create an account</a></p>
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













