<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WageFlow | Sign Up</title>
    <link rel="stylesheet" href="css/signup-style.css">
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <img src="images/logo.png" alt="WageFlow logo" width="15%" />
            <h3>Wage</h3>
            <h3 class="flow">Flow</h3>
        </div>
        <div class="sign-welcome">
            <h2>SIGN UP</h2>
        </div>
        <form id="signupForm">
            <input type="email" name="email" id="email" placeholder="EMAIL" autocomplete="off" required />
            <input type="password" name="password" id="password" placeholder="PASSWORD" required />
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="CONFIRM PASSWORD" required />
            <div class="btn-login">
                <button type="submit" name="signup">Sign Up</button>
            </div>
            <div class="sign-up">
                <p>Have an account?</p>
                <a href="index.php">Sign In</a>
            </div>
        </form>
    </div>
    <script src="js/accounts.js"></script>
</body>

</html>
