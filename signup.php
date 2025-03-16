<?php

session_start();
require_once "db_connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <img
                src="images/logo.png"
                alt="WageFlow logo"
                width="15%" />
            <h3>Wage</h3>
            <h3 class="flow">Flow</h3>
        </div>
        <div class="sign-welcome">
            <h2>SIGN UP</h2>
        </div>
        <form action="login.php" method="post">
            <input type="email" name="username" id="username" placeholder="USERNAME" autocomplete="off" required /> <!-- Replace this with email format + Dapat wala mag labas yung suggestion thing when input -->
            <input type="password" name="password" id="password" placeholder="PASSWORD" required />
            <input type="password" name="password" id="password" placeholder="PASSWORD" required />
            <div class="btn-login">
                <button type="submit" name="login"><a href="">Sign Up</a></button>
            </div>
            <div class="forgot-password">
                <a href="">Forgot Password?</a>
            </div>
            <div class="sign-up">
                <p>Have an account? Sign In</p>
                <a href="sign-up.php">Sign Up</a>
            </div>
        </form>
    </div>
</body>

</html>