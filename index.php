<?php
session_start();
include "api/database.php";
include "class/Accounts.php";

$database = new Database();
$conn = $database->getConnection();
$accounts = new Accounts($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($accounts->loginAccount($email, $password)) {
        // Set session variables
        $_SESSION["email"] = $email;
        $_SESSION["loggedin"] = true;

        // Redirect to a protected page or dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // Handle login failure
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WageFlow | Sign In</title>
    <link rel="stylesheet" href="css/login-style.css" />
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
            <h2>SIGN IN</h2>
            <p>We are thrilled to see you again!</p>
        </div>
        <form action="index.php" method="post">
            <input type="email" name="email" id="email" placeholder="EMAIL" autocomplete="off" />
            <input type="password" name="password" id="password" placeholder="PASSWORD" />
            <div class="btn-login">
                <button type="submit" name="login">Login</button>
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