<?php

    session_start();

    if(empty($_SESSION["userId"])){
        header("Location: index.php");
    }
?>
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
             <span>WageFlow</span>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li id="dashboardNav" class="active"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></li>
                <li id="employeeNav"><i class="fas fa-users"></i><span>Employees</span></li>
                <li id="payheadNav"><i class="fas fa-file-invoice-dollar"></i><span>Pay Heads</span></li>
                <li id="payrollNav"><i class="fas fa-wallet"></i><span>Payroll</span></li>
                <li id="about_usNav"><i class="fas fa-info-circle"></i><span>About Us</span></li>
            </ul>
        </div>
        <a href="api/logout.php" class="logout-btn" id="logoutButton"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
        </div>

        <div class="dashboard-cards">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Total Employees</span>
                    <i class="fas fa-users card-icon"></i>
                </div>
                <div class="card-value" id="totalEmployees"></div>
                <div class="card-description">Employees in the system</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Payroll Processed</span>
                    <i class="fas fa-wallet card-icon"></i>
                </div>
                <div class="card-value" id="payrollProcessed"></div>
                <div class="card-description">This month's processed payrolls</div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Total Pay Heads</span>
                    <i class="fas fa-file-invoice-dollar card-icon"></i>
                </div>
                <div class="card-value" id="totalPayHeads"></div>
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
                        <th>Earnings</th>
                        <th>Deductions</th>
                        <th>Net Pay</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="content">
                    <!-- <tr>
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
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/dashboard.js"></script>
</body>
</html>
