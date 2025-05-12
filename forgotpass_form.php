<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - WageFlow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/login-style.css">
     <link rel="stylesheet" href="style/forgotpass_form.css">
    
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <i class="fas fa-money-bill-wave"></i>
                <span>WageFlow</span>
            </div>
            <h2>Set New Password</h2>
            
            <form action="#" method="POST" class="login-form">
                <div class="input-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <button type="submit" class="login-btn">Confirm</button>
                
                <p class="support-text">
                    Need help? <a href="#">Contact Support</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>