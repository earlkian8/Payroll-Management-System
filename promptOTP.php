<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code - WageFlow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/login-style.css">
    <link rel="stylesheet" href="style/promptOTP.css">
    
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <i class="fas fa-money-bill-wave"></i>
                <span>WageFlow</span>
            </div>
            <h2>Verification Code</h2>
            <p class="subtitle">Enter the 6-digit code we sent to earlkian8@gmail.com</p>
            
            <form action="#" method="POST" class="login-form">
                <div class="verification-inputs">
                    <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                    <input type="text" maxlength="1" pattern="[0-9]" inputmode="numeric" required>
                </div>

                <button type="submit" class="login-btn">Verify</button>
                
                <p class="resend-text">Didn't receive a code? Resend in <span id="timer">54</span>s</p>
                
                <p class="support-text">
                    Need help? <a href="#">Contact Support</a>
                </p>
            </form>
        </div>
    </div>    <script>
        // Auto-focus and move to next input
        const inputs = document.querySelectorAll('.verification-inputs input');
        
        inputs.forEach((input, index) => {
            // Handle input events
            input.addEventListener('input', function(e) {
                // Allow only numbers
                this.value = this.value.replace(/[^0-9]/g, '');

                if (this.value.length === 1) {
                    // Move to next input if available
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                }
            });

            // Handle keydown events
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && !this.value && index > 0) {
                    // Move to previous input on backspace
                    inputs[index - 1].focus();
                } else if (e.key === 'ArrowLeft' && index > 0) {
                    // Move to previous input on left arrow
                    inputs[index - 1].focus();
                } else if (e.key === 'ArrowRight' && index < inputs.length - 1) {
                    // Move to next input on right arrow
                    inputs[index + 1].focus();
                }
            });

            // Handle paste events
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').split('');
                
                // Fill current and subsequent inputs with pasted digits
                inputs.forEach((input, i) => {
                    if (i >= index && pastedData[i - index]) {
                        input.value = pastedData[i - index];
                        if (i < inputs.length - 1) {
                            inputs[i + 1].focus();
                        }
                    }
                });
            });
        });

        // Timer countdown
        let timeLeft = 54;
        const timerElement = document.getElementById('timer');
        
        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                document.querySelector('.resend-text').innerHTML = 
                    'Didn\'t receive a code? <a href="#" style="color: #1E88E5; text-decoration: none;">Resend</a>';
            }
        }, 1000);
    </script>
</body>
</html>