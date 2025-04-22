
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WageFlow</title>
    <link rel="stylesheet" href="css/navigation-style.css">
    <link rel="stylesheet" href="css/payroll-styles.css">
</head>
<body>
    <!-- Modal Overlay -->
    <form class="modal-overlay" id="modal-overlay">
        <div class="modal-container">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 id="modalFullName">Add Employee Pay Heads</h2>
                <button class="close-button" id="close-button">&times;</button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Two-column layout -->
                <div class="modal-content">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- Add New Pay Head Section -->
                        <div class="add-pay-head-section">
                            <h3>Add New Pay Head</h3>
                            <div class="add-pay-head-controls" id="addPayHeadForm">
                                <select id="pay-head-select">
                                    <option value="">-- Select Pay Head --</option>
                                </select>
                                <input type="number" id="pay-head-amount" placeholder="Amount" min="0" step="0.01">
                                <button class="btn btn-success" id="addPayHead">Add</button>
                            </div>
                        </div>
                        
                        <!-- Pay Heads Container -->
                        <div class="pay-heads-container" id="pay-heads-container">
                            <div class="pay-heads-header">
                                <h3>Employee Pay Heads</h3>
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="right-column">
                        <!-- Summary Section -->
                        <div class="summary-section">
                            <h3>Payment Summary</h3>
                            
                            <div class="summary-row">
                                <span class="summary-label">Total Earnings:</span>
                                <span class="summary-value earnings" id="earnings-summary-value">0</span>
                            </div>
                            
                            <div class="summary-row">
                                <span class="summary-label">Total Deductions:</span>
                                <span class="summary-value deductions" id="deductions-summary-value">0</span>
                            </div>
                            
                            <div class="summary-row">
                                <span class="summary-label">Net Salary:</span>
                                <span class="summary-value total" id="net-summary-value">0</span>
                            </div>
                        </div>
                        
                        <!-- Payment Details Section -->
                        <div class="payment-details">
                            <h3>Payment Details</h3>
                            
                            <div class="form-group">
                                <label for="payment-notes">Notes</label>
                                <textarea id="payment-notes" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancel">Cancel</button>
                <button class="btn btn-primary" id="issue" type="submit">Issue</button>
            </div>
        </div>
</form>
   <!-- Side Bar -->
   <aside class="aside-style">
        <div class="container1">
            <img src="images/logo.png" alt="Logo" class="main-logo-style">
            <h1 class="h1-style">Wage<span class="span-style">Flow</span></h1>
        </div>
        <div class="container2">
            <a href="dashboard.php" class="a-style">
                <div class="a-container-style">
                    <img src="images/home-61ccef.png" alt="Home" class="logo-style">
                    <p class="p-style">DASHBOARD</p> 
                </div>
            </a>
            <a href="employee.php" class="a-style">
                <div class="a-container-style">
                    <img src="images/user-61CCEF.png" alt="Employee" class="logo-style">
                    <p class="p-style">EMPLOYEE</p>
                </div>
            </a>
            <a href="pay_head.php" class="a-style">
                <div class="a-container-style">
                    <img src="images/payHead-icon-61ccef.png" alt="Pay Head" class="logo-style">
                    <p class="p-style">PAY HEAD</p>
                </div>
            </a>
            <a href="payroll.php" class="a-style">
                <div class="a-container-style">
                    <img src="images/payroll-61ccef.png" alt="Payroll" class="logo-style">
                    <p class="p-style" id="payroll-underline">PAYROLL</p>
                </div>
            </a>
            
        </div>
    </aside>

    <div class="content-style">

        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
            </div>

            <div class="tabs">
                <div class="tab active" onclick="openTab(0)">Pending</div>
                <div class="tab" onclick="openTab(1)">Issued</div>
            </div>

            <table class="table-style tab-content active" id="pending-content">
                <thead>
                    <tr class="tr-style">
                        <th class="th-style" id="tableName">Name</th>
                        <th class="th-style" id="tableDate">Pay Frequency</th>
                    </tr>
                </thead>
                <tbody id="pendingContent">
                    
                </tbody>
            </table>
            <table class="table-style tab-content" id="issued-content">
                <thead>
                    <tr class="tr-style">
                        <th class="th-style" id="tableName">Name</th>
                        <th class="th-style" id="tableDate">Pay Frequency</th>
                        <th class="th-style" id="totalSalary">Total Salary</th>
                    </tr>
                </thead>
                <tbody id="issuedContent">
                    
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function openTab(index) {
            let tabs = document.querySelectorAll(".tab");
            let contents = document.querySelectorAll(".tab-content");

            tabs.forEach(tab => tab.classList.remove("active"));
            contents.forEach(content => content.classList.remove("active"));

            tabs[index].classList.add("active");
            contents[index].classList.add("active");
        }
    </script>
    <script src="js/payroll.js"></script>
</body>
</html>