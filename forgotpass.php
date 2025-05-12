<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - WageFlow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/login-style.css">
    <link rel="stylesheet" href="style/forgotpass.css">

</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <i class="fas fa-money-bill-wave"></i>
                <span>WageFlow</span>
            </div>
            <h2>Forgot Password</h2>
            <p class="subtitle">Enter your email address to receive a verification code</p>
              <form action="#" method="POST" class="login-form">
                <div class="input-group">
                    <label>
                        <i class="fas fa-envelope"></i>
                        <span>Email Address</span>
                    </label>
                    <input type="email" name="email" placeholder="Enter your email address" required>
                </div>

                <button type="submit" class="login-btn">Send Verification Code</button>
                
                <div class="form-footer">
                    <p>Remember your password? <a href="index.php">Log in</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>