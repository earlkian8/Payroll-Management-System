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
            <i class="fas fa-money-bill-wave"></i> <span>Payroll</span>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li><a href="employee.php"><i class="fas fa-users"></i><span>Employees</span></a></li>
                <li><a href="payhead.php" class="active"><i class="fas fa-file-invoice-dollar"></i><span>Pay Heads</span></a></li>
                <li><a href="payroll.php"><i class="fas fa-wallet"></i><span>Payroll</span></a></li>
                <li><a href="about_us.php"><i class="fas fa-info-circle"></i><span>About Us</span></a></li>
            </ul>
        </div>
        <button class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Pay Heads</h1>
            <div class="user-profile">
                <img src="https://via.placeholder.com/40" alt="User Profile">
                <span>John Doe</span>
            </div>
        </div>

        <div class="pay-head-actions">
            <div class="search-bar">
                <input type="text" placeholder="Search pay heads...">
                <button><i class="fas fa-search"></i></button>
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
                <tbody>
                    <tr>
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
                    </tr>
                </tbody>
            </table>
        </div>
    </div>    <!-- Add Pay Head Modal -->
    <div id="addPayHeadModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add Pay Head</h2>
            <form id="addPayHeadForm">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>

                <label for="type">Type:</label>
                <select id="type" name="type" required>
                    <option value="Earnings">Earnings</option>
                    <option value="Deductions">Deductions</option>
                </select>

                <button type="submit" class="btn-submit">Add Pay Head</button>
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
