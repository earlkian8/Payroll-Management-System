<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management System - Login</title>
    <link rel="stylesheet" href="style/login-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>    <!-- Error Modal -->
    <div class="modal" id="errorModal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="modal-text">Invalid email or password</div>
        </div>
    </div>

    <div class="container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <h1>Payroll Management System</h1>
                <p>Sign in to access your dashboard</p>
            </div>
            
            <form class="login-form" id="loginForm">
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" placeholder="Email" required autocomplete="off">
                    </div>
                </div>
                
                <div class="input-group">
                    <div class="label-row">
                        <label for="password">Password</label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" placeholder="Password" required autocomplete="off">
                        <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                </div>
                
                <button type="submit" class="login-btn">Sign In</button>
            </form>
            
            <div class="register-prompt">
                <p>Don't have an account? <a href="register.php">Create account</a></p>
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

    </script>
    <style>
        .modal { 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: .25s opacity ease-in-out, .25s visibility ease-in-out;
        }
        
        .modal.show{
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #1E1E1E;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 90%;
        }

        .modal-icon {
            font-size: 48px;
            color: #ff4444;
            margin-bottom: 20px;
        }

        .modal-text {
            color: #ffffff;
            font-size: 18px;
            margin-bottom: 25px;
        }

        .modal-close {
            background-color: #1E88E5;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .modal-close:hover {
            background-color: #1976D2;
        }
    </style>

    <script src="js/login.js"></script>
</body>
</html>