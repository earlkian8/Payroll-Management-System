<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Set New Password</title>
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
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #b0b0b0;
            font-weight: 500;
        }
        
        .input-container {
            position: relative;
        }
        
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #444;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
            background-color: #333;
            color: #e0e0e0;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #999;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
        }
        
        .toggle-password img {
            height: 20px;
            opacity: 0.6;
        }
        
        .password-strength {
            height: 5px;
            background-color: #444;
            margin-top: 8px;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .strength-meter {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background-color 0.3s;
        }
        
        .password-feedback {
            margin-top: 8px;
            font-size: 13px;
            color: #b0b0b0;
        }
        
        .password-rules {
            margin-top: 12px;
            font-size: 13px;
            color: #b0b0b0;
        }
        
        .rule {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        
        .rule::before {
            content: "•";
            margin-right: 8px;
            color: #777;
        }
        
        .rule.valid::before {
            content: "✓";
            color: #4caf50;
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
        
        <h1>Set New Password</h1>
        
        <form id="passwordForm">
            <div class="form-group">
                <label for="new-password">New Password</label>
                <div class="input-container">
                    <input type="password" id="new-password" name="new-password" required>
                    <button type="button" class="toggle-password" data-target="new-password">
                    </button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <div class="input-container">
                    <input type="password" id="confirm-password" name="confirm-password" required>
                    <button type="button" class="toggle-password" data-target="confirm-password">
                    </button>
                </div>
                <div id="match-feedback" class="password-feedback"></div>
            </div>
            
            <button type="submit" class="btn" id="submit-btn">Confirm</button>
        </form>
        
        <div class="footer">
            <p>Need help? <a href="#">Contact Support</a></p>
        </div>
    </div>
    <script src="../js/change_password.js"></script>
</body>
</html>