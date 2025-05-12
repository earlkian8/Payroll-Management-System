<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/payroll-style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-money-bill-wave"></i> <span>Payroll</span>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li><a href="employee.php"><i class="fas fa-users"></i><span>Employees</span></a></li>
                <li><a href="payhead.php"><i class="fas fa-file-invoice-dollar"></i><span>Pay Heads</span></a></li>
                <li><a href="payroll.php" class="active"><i class="fas fa-wallet"></i><span>Payroll</span></a></li>
                <li><a href="about_us.php"><i class="fas fa-info-circle"></i><span>About Us</span></a></li>
            </ul>
        </div>
        <button class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Payroll</h1>
            <div class="user-profile">
                <img src="https://via.placeholder.com/40" alt="User Profile">
                <span>John Doe</span>
            </div>
        </div>

        <div class="payroll-actions">
            <div class="search-bar">
                <input type="text" placeholder="Search payroll...">
                <button><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="tabs">
            <button class="tab-btn active" data-tab="draft">Draft</button>
            <button class="tab-btn" data-tab="pending">Pending</button>
            <button class="tab-btn" data-tab="issued">Issued</button>
        </div>

        <div class="tab-content active" id="draft">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Period Start</th>
                            <th>Period End</th>
                            <th>Pay Frequency</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Amanda Nicole Martinez</td>
                            <td>2023-04-01</td>
                            <td>2023-04-30</td>
                            <td>Monthly</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-content" id="pending">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Period Start</th>
                            <th>Period End</th>
                            <th>Pay Frequency</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Amanda Nicole Martinez</td>
                            <td>2023-04-01</td>
                            <td>2023-04-30</td>
                            <td>Monthly</td>
                            <td>
                                <button class="btn-issue" data-employee-id="1" id="edit"><i class="fas fa-check"></i></button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-content" id="issued">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Pay Frequency</th>
                            <th>Total Net</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Amanda Nicole Martinez</td>
                            <td>Monthly</td>
                            <td>$49900.00</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="overlay" id="modalIssue">
        <div class="add-pay-heads-modal">
            <div class="modal-header">
                <h2>Add Employee Pay Heads</h2>
                <button class="close-btn" id="closeModal">&times;</button>
            </div>
            <div class="modal-content">
                <div class="left-section">
                    <div class="select-employee">
                        <select id="employeeSelect">
                            <option>-- Select Employee --</option>
                            <option value="emp1">John Doe</option>
                            <option value="emp2">Jane Smith</option>
                            <option value="emp3">Mike Johnson</option>
                        </select>
                    </div>
                    <div class="add-pay-head">
                        <div class="pay-head-inputs">
                            <select id="payHeadSelect">
                                <option value="">-- Select Pay Head --</option>
                                <option value="basic">Basic Salary</option>
                                <option value="hra">House Rent Allowance</option>
                                <option value="bonus">Performance Bonus</option>
                                <option value="pf">Provident Fund Deduction</option>
                                <option value="tax">Professional Tax</option>
                            </select>
                            <input type="text" id="payHeadAmount" placeholder="Amount">
                        </div>
                        <div class="pay-head-container" id="payHeadContainer">
                            <div class="pay-head-card">
                                <span>Basic Salary: $3,000.00</span>
                                <button class="remove-btn"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="pay-head-card">
                                <span>House Rent Allowance: $800.00</span>
                                <button class="remove-btn"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="pay-head-card">
                                <span>Performance Bonus: $500.00</span>
                                <button class="remove-btn"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="pay-head-card">
                                <span>Provident Fund Deduction: -$200.00</span>
                                <button class="remove-btn"><i class="fas fa-trash"></i></button>
                            </div>
                            <div class="pay-head-card">
                                <span>Professional Tax: -$150.00</span>
                                <button class="remove-btn"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <button class="add-btn" id="addPayHeadBtn">Add</button>
                    </div>
                </div>
                <div class="right-section">
                    <div class="payment-summary">
                        <h3>Payment Summary</h3>
                        <div class="summary-row">
                            <span>Total Earnings:</span>
                            <span id="totalEarnings">$4,000.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Total Deductions:</span>
                            <span id="totalDeductions">$350.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Net Salary:</span>
                            <span id="netSalary">$3,650.00</span>
                        </div>
                    </div>
                    <div class="payment-details">
                        <h3>Payment Details</h3>
                        <div class="payment-period">
                            <input type="text" id="paymentDate" placeholder="mm/dd/yyyy" style="width: 100%; background-color: #262626; color: #ffffff; border: 1px solid #1E88E5; padding: 10px; border-radius: 5px;">
                            <textarea id="paymentNotes" placeholder="Additional Notes" style="width: 100%; background-color: #262626; color: #ffffff; border: 1px solid #1E88E5; padding: 10px; border-radius: 5px; margin-top: 10px; min-height: 100px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" id="cancelBtn">Cancel</button>
                <button class="save-btn" id="savePayHeadsBtn">Save Pay Heads</button>
            </div>
        </div>
    </div>

    <script src="js/payroll.js"></script>
</body>
</html>
