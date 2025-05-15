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
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/employee-style.css">
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <div class="sidebar">
        <div class="logo">
            <span>WageFlow</span>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li id="dashboardNav"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></li>
                <li id="employeeNav" class="active"><i class="fas fa-users"></i><span>Employees</span></li>
                <li id="payheadNav"><i class="fas fa-file-invoice-dollar"></i><span>Pay Heads</span></li>
                <li id="payrollNav"><i class="fas fa-wallet"></i><span>Payroll</span></li>
                <li id="about_usNav"><i class="fas fa-info-circle"></i><span>About Us</span></li>
            </ul>
        </div>
        <button class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Employees</h1>
        </div>

        <div class="employee-actions">
            <div class="search-bar">
                <input type="text" placeholder="Search employees..." id="searchInput" oninput="searchEmployee()">
            </div>
            <button id="addEmployeeBtn" class="btn-add"><i class="fas fa-plus"></i> Add Employee</button>
        </div>

        <div class="table-container">
            <table id="employeesTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Employment Type</th>
                        <th>Designation</th>
                        <th>Hire Date</th>
                        <th>Pay Frequency</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tableContent">
                    <!-- <tr>
                        <td>1</td>
                        <td>John</td>
                        <td>A</td>
                        <td>Smith</td>
                        <td>Full Time</td>
                        <td>Software Engineer</td>
                        <td>2023-01-15</td>
                        <td>Monthly</td>
                        <td>
                            <button class="btn-view" data-id="1"><i class="fas fa-eye"></i></button>
                            <button class="btn-edit" data-id="1"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" data-id="1"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sarah</td>
                        <td>B</td>
                        <td>Johnson</td>
                        <td>Part Time</td>
                        <td>HR Manager</td>
                        <td>2023-02-20</td>
                        <td>Bi-weekly</td>
                        <td>
                            <button class="btn-view" data-id="2"><i class="fas fa-eye"></i></button>
                            <button class="btn-edit" data-id="2"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" data-id="2"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Michael</td>
                        <td>C</td>
                        <td>Brown</td>
                        <td>Full Time</td>
                        <td>Project Manager</td>
                        <td>2023-03-10</td>
                        <td>Monthly</td>
                        <td>
                            <button class="btn-view" data-id="3"><i class="fas fa-eye"></i></button>
                            <button class="btn-edit" data-id="3"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete" data-id="3"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div id="addEmployeeModal" class="modal">
        <div class="modal-content">
            <span class="close" id="addClose">&times;</span>
            <h2>Add Employee</h2>
            <form id="addEmployeeForm">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required autocomplete="off">

                <label for="middleName">Middle Name:</label>
                <input type="text" id="middleName" name="middleName" autocomplete="off">

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required autocomplete="off">

                <label for="employmentType">Employment Type:</label>
                <select id="employmentType" name="employmentType" required autocomplete="off">
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Freelance">Freelance</option>
                </select>

                <label for="designation">Designation:</label>
                <input type="text" id="designation" name="designation" required autocomplete="off">

                <label for="hireDate">Hire Date:</label>
                <input type="date" id="hireDate" name="hireDate" required>

                <label for="payFrequency">Pay Frequency:</label>
                <select id="payFrequency" name="payFrequency" required>
                    <option value="Monthly">Monthly</option>
                    <option value="Bi-weekly">Bi-weekly</option>
                    <option value="Weekly">Weekly</option>
                </select>

                <button type="submit" class="btn-submit">Add Employee</button>
            </form>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div id="editEmployeeModal" class="modal">
        <div class="modal-content">
            <span class="close" id="editClose">&times;</span>
            <h2>Edit Employee</h2>
            <form id="editEmployeeForm">

                <label for="editFirstName">First Name:</label>
                <input type="text" id="editFirstName" name="firstName" required autocomplete="off">

                <label for="editMiddleName">Middle Name:</label>
                <input type="text" id="editMiddleName" name="middleName" autocomplete="off">

                <label for="editLastName">Last Name:</label>
                <input type="text" id="editLastName" name="lastName" required autocomplete="off">

                <label for="editEmploymentType">Employment Type:</label>
                <select id="editEmploymentType" name="employmentType" required autocomplete="off">
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Freelance">Freelance</option>
                </select>

                <label for="editDesignation">Designation:</label>
                <input type="text" id="editDesignation" name="designation" required autocomplete="off">

                <label for="editHireDate">Hire Date:</label>
                <input type="date" id="editHireDate" name="hireDate" required autocomplete="off">

                <label for="editPayFrequency">Pay Frequency:</label>
                <select id="editPayFrequency" name="payFrequency" required>
                    <option value="Monthly">Monthly</option>
                    <option value="Bi-weekly">Bi-weekly</option>
                    <option value="Weekly">Weekly</option>
                </select>

                <button type="submit" class="btn-submit">Update Employee</button>
            </form>
        </div>
    </div>

    <!-- View Employee Modal -->
    <div class="employeeDetailModal" id="employeeDetailModal">
        <div class="employee-modal">
            <div class="employee-modal-header">
                <h2>Employee Information</h2>
                <button class="employee-close-button" id="employeeCloseButton">×</button>
            </div>
            <div class="employee-modal-content">
                <div class="employee-left-panel">
                    <h1 class="employee-name" id="employeeNameDetails">Earl Kian Anastacio Bancayrin</h1>
                    <div class="employee-position">
                        <span id="employeeDesignationDetails">Senior Software Engineer</span>
                    </div>

                    <div class="employee-tab-navigation">
                        <div class="employee-tab employee-active" style="font-size:1rem;">Personal Info</div>
                    </div>
                    <h3 class="employee-section-title">Employment Details</h3>
                    <div class="employee-info-grid">
                        <div class="employee-info-item">
                            <label>Employee ID</label>
                            <span id="employeeIdDetails">EMP-2025-042</span>
                        </div>
                        <div class="employee-info-item">
                            <label>Employment Type</label>
                            <span id="employmentTypeDetails">Full Time</span>
                        </div>
                        <div class="employee-info-item">
                            <label>Designation</label>
                            <span id="designationDetails">Senior Software Engineer</span>
                        </div>
                        <div class="employee-info-item">
                            <label>Date Hired</label>
                            <span id="dateHiredDetails">2025-04-11</span>
                        </div>
                        <div class="employee-info-item">
                            <label>Pay Frequency</label>
                            <span id="payFrequencyDetails">Monthly</span>
                        </div>
                    </div>

                </div>

                <div class="employee-right-panel">
                    <div class="employee-salary-header">
                        <h3 class="employee-section-title">Salary Payslips</h3>
                    </div>

                    <div class="employee-payslip-cards" id="employeePayslipCards">
                        <div class="employee-payslip-card">
                            <div class="employee-month">
                                <span>April 2025</span>
                                <span class="employee-paid-badge">Paid</span>
                            </div>
                            <div class="employee-net-amount">$6,775.00</div>
                            <div class="employee-net-label">Net Salary</div>
                            <a href="#" class="employee-download-button">Download →</a>
                        </div>

                        <div class="employee-payslip-card">
                            <div class="employee-month">
                                <span>March 2025</span>
                                <span class="employee-paid-badge">Paid</span>
                            </div>
                            <div class="employee-net-amount">$6,775.00</div>
                            <div class="employee-net-label">Net Salary</div>
                            <a href="#" class="employee-download-button">Download →</a>
                        </div>

                        <div class="employee-payslip-card">
                            <div class="employee-month">
                                <span>February 2025</span>
                                <span class="employee-paid-badge">Paid</span>
                            </div>
                            <div class="employee-net-amount">$6,775.00</div>
                            <div class="employee-net-label">Net Salary</div>
                            <a href="#" class="employee-download-button">Download →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- View Salary Modal -->
    <div class="view-modal-overlay" id="viewModal">
        <div class="view-modal">
            <div class="view-modal-header">
                <h2>Salary Slip</h2>
                
                <button class="view-close-button" id="aviewCloseButton">×</button>
            </div>
            <div class="view-modal-body">
                <div class="view-company-details">
                    <div class="view-company-logo">
                        <span class="view-company-name">WageFlow</span>
                        <i class="fa-solid fa-download" style="font-size: 0.8em; margin-left: 5px; cursor:pointer;" id="downloadPDFId"></i>
                    </div>
                    <div class="view-payroll-info">
                        <p id="payDateSalary"></p>
                        <p id="payrollIdSalary"></p>
                        <p id="statusSalary"></p>
                    </div>
                </div>

                <div class="view-employee-details">
                    <p id="nameSalary"></p>
                </div>

                <div class="view-salary-details">
                    <div class="view-earnings" id="earningRow">
                        <h3>EARNINGS</h3>
                        <div class="view-amount-row">
                            <span>Basic Salary</span>
                            <span>51000.00</span>
                        </div>
                    </div>

                    <div class="view-deductions" id="deductionRow">
                        <h3>DEDUCTIONS</h3>
                        <div class="view-amount-row">
                            <span>SSS Contribution</span>
                            <span>1000.00</span>
                        </div>
                        <div class="view-amount-row">
                            <span>Income Tax</span>
                            <span>100.00</span>
                        </div>
                    </div>
                </div>

                <div class="view-total-section">
                    <div class="view-total-row">
                        <span>Total Earnings</span>
                        <span id="totalEarningsDetails">₱37000.00</span>
                    </div>
                    <div class="view-total-row">
                        <span>Total Deductions</span>
                        <span id="totalDeductionDetails">₱4536.00</span>
                    </div>
                    <div class="view-total-row view-net-total">
                        <span>Total Net</span>
                        <span id="totalNetDetails">₱32464.00</span>
                    </div>
                </div>

                <div class="view-notes">
                    <p id="notesDetails"><strong>Notes:</strong> Just a quick reminder—please try to be on time moving forward. It helps everything run smoother for everyone. If there's something causing the delays, feel free to let me know so we can work it out. Appreciate it!</p>
                </div>

                <div class="view-footer">
                    © 2025 WageFlow. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Employee Modal -->
    <div id="deleteEmployeeModal" class="modal">
        <div class="modal-content">
            <span class="close" id="deleteClose">&times;</span>
            <h2>Delete Employee</h2>
            <p>Are you sure you want to delete this employee?</p>
            <form id="deleteEmployeeForm">
                <button type="submit" class="btn-submit" id="deleteButton">Delete Employee</button>
            </form>
        </div>
    </div>

    <script src="js/employee.js"></script>
</body>
</html>
