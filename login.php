<?php

    include "db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>WageFlow | Sign In</title>
        <link rel="stylesheet" href="css/login.css" />
    </head>
    <body>
        <div class="login-container">
            <div class="login-header">
                <img
                    src="images/logo.png"
                    alt="WageFlow logo"
                    width="15%"
                />
                <h3>Wage</h3>
                <h3 class="flow">Flow</h3>
            </div>
            <div class="sign-welcome">
                <h2>SIGN IN</h2>
                <p>We are thrilled to see you again!</p>
            </div>
            <form action="login.php" method="post">
                <input type="text" name="username" id="username" placeholder="USERNAME"/> <!-- Replace this with email format -->
                <input type="password" name="password" id="password" placeholder="PASSWORD"/>
                <div class="btn-login">
                    <button type="submit" name="login"><a href="">Login</a></button>
                </div>
                <div class="forgot-password">
                    <a href="">Forgot Password?</a>
                </div>
                <div class="sign-up">
                    <p>Don't have an account?</p>
                    <a href="sign-up.php">Sign Up</a>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        if(empty($_POST["username"]) || empty($_POST["password"])){
            die("Please input all the fields.");
        }

        $statement = $conn->prepare("SELECT password FROM accounts WHERE username = ? AND password = ?");
        $statement->bind_param("ss", $username, $username);
        $statement->execute();
        $result = $statement->get_result();

        if($result->num_rows > 0){
            header("Location: dashboard.php");
            exit();
        }
        $statement->close();
    }
?>