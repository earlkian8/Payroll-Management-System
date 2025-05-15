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
    <title>Pay Heads Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/payhead-style.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <span>WageFlow</span>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li id="dashboardNav"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></li>
                <li id="employeeNav"><i class="fas fa-users"></i><span>Employees</span></li>
                <li id="payheadNav" class="active"><i class="fas fa-file-invoice-dollar"></i><span>Pay Heads</span></li>
                <li id="payrollNav"><i class="fas fa-wallet"></i><span>Payroll</span></li>
                <li id="about_usNav"><i class="fas fa-info-circle"></i><span>About Us</span></li>
            </ul>
        </div>
        <button class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Pay Heads</h1>
        </div>

        <div class="pay-head-actions">
            <div class="search-bar">
                <input type="text" placeholder="Search pay heads..." id="searchInput" oninput="searchPayHeads()">
            </div>
            <button id="addPayHeadBtn" class="btn-add"><i class="fas fa-plus"></i> Add Pay Head</button>
        </div>

        <div class="table-container">
            <table id="payHeadsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="content">
                    <!-- <tr>
                        <td>1</td>
                        <td>Basic Salary</td>
                        <td>Base monthly salary for employees</td>
                        <td>Earnings</td>
                        <td>
                            <button class="btn-edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Housing Allowance</td>
                        <td>Monthly housing benefit</td>
                        <td>Earnings</td>
                        <td>
                            <button class="btn-edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Tax Deduction</td>
                        <td>Mandatory income tax deduction</td>
                        <td>Deductions</td>
                        <td>
                            <button class="btn-edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Health Insurance</td>
                        <td>Employee health insurance contribution</td>
                        <td>Deductions</td>
                        <td>
                            <button class="btn-edit"><i class="fas fa-edit"></i></button>
                            <button class="btn-delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>    
    
    <!-- Add Pay Head Modal -->
    <div id="addPayHeadModal" class="modal">
        <div class="modal-content">
            <span class="close" id="addClose">&times;</span>
            <h2>Add Pay Head</h2>
            <form id="addPayHeadForm">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required autocomplete="off">

                <label for="description">Description:</label>
                <textarea id="description" name="description" autocomplete="off"></textarea>

                <label for="type">Type:</label>
                <select id="type" name="type" required>
                    <option value="Earnings">Earnings</option>
                    <option value="Deductions">Deductions</option>
                </select>

                <button type="submit" class="btn-submit">Add Pay Head</button>
            </form>
        </div>
    </div>

    <!-- Edit Pay Head Modal -->
    <div id="editPayHeadModal" class="modal">
        <div class="modal-content">
            <span class="close" id="editClose">&times;</span>
            <h2>Edit Pay Head</h2>
            <form id="editPayHeadForm">
                <label for="editName">Name:</label>
                <input type="text" id="editName" name="editName" required autocomplete="off">

                <label for="editDescription">Description:</label>
                <textarea id="editDescription" name="editDescription" autocomplete="off"></textarea>

                <label for="editType">Type:</label>
                <select id="editType" name="editType" required>
                    <option value="Earnings">Earnings</option>
                    <option value="Deductions">Deductions</option>
                </select>

                <button type="submit" class="btn-submit">Edit Pay Head</button>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content delete-modal">
            <h2>Confirm Delete</h2>
            <p>Are you sure you want to delete "<span id="deleteItemName"></span>"?</p>
            <div class="modal-buttons">
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
                <button id="confirmDelete" class="btn-confirm">Delete</button>
            </div>
        </div>
    </div>

    <script src="js/payhead.js"></script>
</body>
</html>
