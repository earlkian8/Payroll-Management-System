<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8 ".
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Enter OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            background-color: #2a2a2a;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            padding: 40px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo img {
            height: 40px;
        }
        
        h1 {
            text-align: center;
            color: #e0e0e0;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .description {
            text-align: center;
            color: #b0b0b0;
            margin-bottom: 30px;
            font-size: 15px;
        }
        
        .otp-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .otp-input {
            width: 50px;
            height: 60px;
            font-size: 24px;
            text-align: center;
            border: 1px solid #444;
            border-radius: 4px;
            background-color: #333;
            color: #e0e0e0;
        }
        
        .btn {
            background-color: #4099ff;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 14px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #5bacec;
        }
        
        .resend {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #b0b0b0;
        }
        
        .resend a {
            color: #4099ff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .resend a:hover {
            color: #5bacec;
        }
        
        .timer {
            font-weight: 500;
            color: #b0b0b0;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
        
        .footer a {
            color: #4099ff;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: #5bacec;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h1>Verification Code</h1>
        
        <p class="description">Enter the 6-digit code we sent to your email address</p>
        
        <form action="change_password.html" method="get">
            <div class="otp-container">
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
                <input type="text" class="otp-input" maxlength="1" required>
            </div>
            
            <button type="submit" class="btn">Verify</button>
        </form>
        
        <div class="resend">
            <p>Didn't receive a code? <span class="timer">Resend in 59s</span></p>
            <p><a href="#" id="resend-link" style="display: none;">Resend Code</a></p>
        </div>
        
        <div class="footer">
            <p>Need help? <a href="#">Contact Support</a></p>
        </div>
    </div>
    
    <script>
        // Auto-focus next input field
        const otpInputs = document.querySelectorAll('.otp-input');
        
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
            
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });
        
        // Timer for resend button
        let seconds = 59;
        const timerElement = document.querySelector('.timer');
        const resendLink = document.getElementById('resend-link');
        
        const countdown = setInterval(() => {
            seconds--;
            timerElement.textContent = `Resend in ${seconds}s`;
            
            if (seconds <= 0) {
                clearInterval(countdown);
                timerElement.style.display = 'none';
                resendLink.style.display = 'block';
            }
        }, 1000);
    </script>

    <script src="../js/enter_otp.js"></script>
</body>
</html>