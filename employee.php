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
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-money-bill-wave"></i> <span>Payroll</span>
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
                <input type="text" placeholder="Search employees...">
                <button><i class="fas fa-search"></i></button>
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
    <div id="viewEmployeeModal" class="modal">
        <div class="modal-content">
            <span class="close" id="viewClose">&times;</span>
            <h2>Employee Details</h2>
            <div class="view-employee-details">
                <div class="employee-info">
                    <h3>Employee Information</h3>
                    <div id="viewEmployeeDetails">
                        <!-- Employee details will be inserted here by JavaScript -->
                    </div>
                </div>
                <div class="salary-slip">
                    <h3>Salary Slip</h3>
                    <div id="viewSalarySlip">
                        <!-- Salary slip details will be inserted here by JavaScript -->
                    </div>
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
