<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management System - Register</title>
    <link rel="stylesheet" href="style/register-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <h1>Payroll Management System</h1>
                <p>Create your account to get started</p>
            </div>
            
            <form class="register-form" id="registerForm">
                
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" placeholder="Email" required autocomplete="off">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" placeholder="Password" required autocomplete="off">
                            <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirmPassword" placeholder="Confirm Password" required autocomplete="off">
                            <i class="fas fa-eye-slash password-toggle" id="toggleConfirmPassword"></i>
                        </div>
                    </div>
                </div>
                
                
                <button type="submit" class="register-btn">Create Account</button>
            </form>
            
            <div class="login-prompt">
                <p>Already have an account? <a href="index.php">Sign in</a></p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
        
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPassword = document.getElementById('confirmPassword');
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <script src="js/register.js"></script>
</body>
</html>