<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/dashboard-style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-money-bill-wave"></i> <span>Payroll</span>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li><a href="employee.php"><i class="fas fa-users"></i><span>Employees</span></a></li>
                <li><a href="payhead.php"><i class="fas fa-file-invoice-dollar"></i><span>Pay Heads</span></a></li>
                <li><a href="payroll.php"><i class="fas fa-wallet"></i><span>Payroll</span></a></li>
                <li><a href="about_us.php"><i class="fas fa-info-circle"></i><span>About Us</span></a></li>
            </ul>
        </div>
        <button class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="user-profile">
                <img src="https://via.placeholder.com/40" alt="User Profile">
                <span>John Doe</span>
            </div>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Total Employees</span>
                    <i class="fas fa-users card-icon"></i>
                </div>
                <div class="card-value">48</div>
                <div class="card-description">Active employees in the system</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Payroll Processed</span>
                    <i class="fas fa-wallet card-icon"></i>
                </div>
                <div class="card-value">12</div>
                <div class="card-description">This month's processed payrolls</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Total Pay Heads</span>
                    <i class="fas fa-file-invoice-dollar card-icon"></i>
                </div>
                <div class="card-value">18</div>
                <div class="card-description">Configured pay heads</div>
            </div>
        </div>

        <div class="table-container">
            <h2 style="margin-bottom: 20px;">Recent Payrolls</h2>
            <table>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Pay Period</th>
                        <th>Gross Pay</th>
                        <th>Deductions</th>
                        <th>Net Pay</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Smith</td>
                        <td>May 1-15, 2025</td>
                        <td>$3,200.00</td>
                        <td>$640.00</td>
                        <td>$2,560.00</td>
                        <td><span style="color: #4CAF50;">Issued</span></td>
                    </tr>
                    <tr>
                        <td>Sarah Johnson</td>
                        <td>May 1-15, 2025</td>
                        <td>$2,800.00</td>
                        <td>$560.00</td>
                        <td>$2,240.00</td>
                        <td><span style="color: #4CAF50;">Issued</span></td>
                    </tr>
                    <tr>
                        <td>Michael Brown</td>
                        <td>May 1-15, 2025</td>
                        <td>$3,500.00</td>
                        <td>$700.00</td>
                        <td>$2,800.00</td>
                        <td><span style="color: #FFC107;">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Emily Davis</td>
                        <td>May 1-15, 2025</td>
                        <td>$2,900.00</td>
                        <td>$580.00</td>
                        <td>$2,320.00</td>
                        <td><span style="color: #4CAF50;">Issued</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
