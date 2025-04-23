<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    header("Location: index.php");
    exit;
}

include "api/database.php";

$database = new Database();
$conn = $database->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WageFlow</title>
    <link rel="stylesheet" href="css/navigation-style.css">
    <link rel="stylesheet" href="css/employee-style.css">
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <!-- Receipt -->
    <div class="modal-overlay-receipt" id="modal-overlay-receipt">
    <div class="modal-content-receipt">
      <div class="modal-header-receipt">
        <h2>Salary Slip</h2>
        <button class="close-button-receipt" id="close-button-receipt">&times;</button>
      </div>
      <div class="modal-body-receipt">
        <div class="company-header-receipt">
          <div class="company-logo-receipt">
            <img src="images/logo.png" alt="WageFlow Logo"/>
            <h3>Wage<span>Flow</span></h3>
          </div>
          <div class="payslip-details-receipt">
            <p id="payDateReceipt"></p>
            <p id="payrollIdReceipt"></p>
            <p id="statusReceipt"></p>
          </div>
        </div>
        
        <div class="employee-info-receipt">
          <div>
            <h4>EMPLOYEE DETAILS</h4>
            <p id="nameReceipt"></p>
            <p id="designationReceipt"></p>
            <p id="payFrequencyReceipt"></p>
          </div>
        </div>

        <div class="salary-details-receipt">
          <div class="salary-box-receipt" id="earnings-box-receipt">
          </div>
          
          <div class="salary-box-receipt" id="deductions-box-receipt">
          </div>
        </div>
        
        <div class="summary-receipt">
          <div class="summary-row-receipt" id="totalEarningsRowReceipt">
            
          </div>
          <div class="summary-row-receipt" id="totalDeductionsRowReceipt">
          </div>
          <div class="summary-row-receipt total" id="netPayRowReceipt">
          </div>
        </div>
        
        <div class="notes-receipt">
          <p id="notesReceipt"></p>
        </div>
        
        <div class="footer-receipt">
          <p>© 2025 WageFlow. All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
    <div class="overlay" id="overlay">

    </div>

    <!-- Create Modal -->
    <form action="employee.php" method="post" class="modal-container" id="modal-container">
            <div class="modal-text-container">
                <h1 class="h1-modal-style">Create Employee</h1>
            </div>
            <div class="modal-input-container">
                <div class="modal-subcontainer1">
                    <div class="input-container-subcontainer1">
                        <label for="firstName" class="label-style">First Name</label>
                        <input type="text" name="firstName" id="firstName" placeholder="First Name" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer1">
                        <label for="middleName" class="label-style">Middle Name</label>
                        <input type="text" name="middleName" id="middleName" placeholder="Middle Name" autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer1">
                        <label for="lastName" class="label-style">Last Name</label>
                        <input type="text" name="lastName" id="lastName" placeholder="Last Name" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-subcontainer2">
                    <div class="input-container-subcontainer2">
                        <label for="gender" class="label-style">Gender</label>
                        <select name="gender" id="gender" class="select-style">
                            <option value="" class="option-style">Select Gender</option>
                            <option value="Male" class="option-style">Male</option>
                            <option value="Female" class="option-style">Female</option>
                        </select>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="birthday" class="label-style">Birthday</label>
                        <input type="date" name="birthday" id="birthday" required placeholder="Date of Birth">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="employmentType" class="label-style">Employment Type</label>
                        <select name="employmentType" id="employmentType" class="select-style">
                            <option value="" class="option-style">Select One</option>
                            <option value="Full Time" class="option-style">Full Time</option>
                            <option value="Part Time" class="option-style">Part Time</option>
                            <option value="Freelance" class="option-style">Freelance</option>
                        </select>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="designation" class="label-style">Designation</label>
                        <input type="text" name="designation" id="designation" placeholder="Designation" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="dateHired" class="label-style">Date Hired</label>
                        <input type="date" name="dateHired" id="dateHired" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="payFrequency" class="label-style">Pay Frequency</label>
                        <select name="payFrequency" id="payFrequency" class="select-style">
                            <option value="" class="option-style">Select One</option>
                            <option value="Monthly" class="option-style">Monthly</option>
                            <option value="Bi-Weekly" class="option-style">Bi-Weekly</option>
                            <option value="Weekly" class="option-style">Weekly</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
                <button class="create-button-style" id="create" name="create" type="submit">Create</button>
                <button class="discard-button-style" id="discard">Discard</button>
            </div>
        </form>

        <!-- Employee Details -->
        <form action="employee.php" method="post" class="employee-details" id="employee-details">
            <div class="modal">
                <div class="modal-header">
                    <div class="modal-title">Employee Information</div>
                    <button type="button" class="modal-close" id="close-details">×</button>
                </div>
                
                <div class="modal-body">
                    <!-- Employee Information Section -->
                    <div class="employee-info">
                        <div class="employee-header">
                            <h2 class="employee-name" id="employee-full-name"></h2>
                            <div class="employee-title"><span id="employee-designation"></span> <span class="status-badge new" id="employee-status"></span></div>
                        </div>
                        
                        <div class="info-tabs">
                            <div class="info-tab active">Personal Info</div>
                        </div>
                        
                        <div class="info-content">
                            <div class="info-section">
                                <h3 class="section-title">Personal Information</h3>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Full Name</div>
                                        <div class="info-value" id="detail-full-name"></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Gender</div>
                                        <div class="info-value" id="detail-gender"></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Birthday</div>
                                        <div class="info-value" id="detail-birthday"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="info-section">
                                <h3 class="section-title">Employment Details</h3>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">Employment Type</div>
                                        <div class="info-value" id="detail-employment-type"></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Designation</div>
                                        <div class="info-value" id="detail-designation"></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Date Hired</div>
                                        <div class="info-value" id="detail-date-hired"></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Pay Frequency</div>
                                        <div class="info-value" id="detail-pay-frequency"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="button-container">
                                <button type="button" class="btn btn-primary" id="edit-employee-btn">Edit</button>
                                <button type="button" class="btn btn-danger" id="delete-employee-btn">Delete</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Salary Section -->
                    <div class="salary-container">
                        <div class="salary-title">
                            <span>Salary Payslips</span>
                        </div>
                        
                        <div id="payslips-container">
                            <!-- Payslips will be loaded dynamically -->
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Edit Modal -->
        <form action="employee.php" method="post" class="edit-modal-container" id="edit-modal-container">
            <div class="modal-text-container">
                <h1 class="h1-modal-style">Edit Employee</h1>
                <button type="button" class="modal-close" id="edit-close">×</button>
            </div>
            <div class="modal-input-container">
                <div class="modal-subcontainer1">
                    <div class="input-container-subcontainer1">
                        <input type="hidden" name="editEmployeeId" id="editEmployeeId">
                        <label for="editFirstName" class="label-style">First Name</label>
                        <input type="text" name="editFirstName" id="editFirstName" placeholder="First Name" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer1">
                        <label for="editMiddleName" class="label-style">Middle Name</label>
                        <input type="text" name="editMiddleName" id="editMiddleName" placeholder="Middle Name" autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer1">
                        <label for="editLastName" class="label-style">Last Name</label>
                        <input type="text" name="editLastName" id="editLastName" placeholder="Last Name" required autocomplete="off">
                    </div>
                </div>
                <div class="modal-subcontainer2">
                    <div class="input-container-subcontainer2">
                        <label for="editGender" class="label-style">Gender</label>
                        <select name="editGender" id="editGender" class="select-style">
                            <option value="" class="option-style">Select Gender</option>
                            <option value="Male" class="option-style">Male</option>
                            <option value="Female" class="option-style">Female</option>
                        </select>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editBirthday" class="label-style">Birthday</label>
                        <input type="date" name="editBirthday" id="editBirthday" required placeholder="Date of Birth">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editEmploymentType" class="label-style">Employment Type</label>
                        <select name="editEmploymentType" id="editEmploymentType" class="select-style">
                            <option value="" class="option-style">Select One</option>
                            <option value="Full Time" class="option-style">Full Time</option>
                            <option value="Part Time" class="option-style">Part Time</option>
                            <option value="Freelance" class="option-style">Freelance</option>
                        </select>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editDesignation" class="label-style">Designation</label>
                        <input type="text" name="editDesignation" id="editDesignation" placeholder="Designation" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editDateHired" class="label-style">Date Hired</label>
                        <input type="date" name="editDateHired" id="editDateHired" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editPayFrequency" class="label-style">Pay Frequency</label>
                        <select name="editPayFrequency" id="editPayFrequency" class="select-style">
                            <option value="" class="option-style">Select One</option>
                            <option value="Monthly" class="option-style">Monthly</option>
                            <option value="Bi-Weekly" class="option-style">Bi-Weekly</option>
                            <option value="Weekly" class="option-style">Weekly</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
                <button class="create-button-style" id="edit" name="edit" type="submit">Save</button>
                <button class="discard-button-style" id="editDiscard">Discard</button>
            </div>
        </form>

         <!-- Confirm Delete -->
         <form method="delete" action="employee.php" class="confirm-delete-container" id="confirm-delete-container">
        
            <div class="delete-subcontainer">
                <div class="delete-subcontainer-sub1">
                    <h1 class="delete-h1-style">Confirm Deletion</h1>
                    <p class="delete-p-style">This will delete the employee permanently. You cannot undo this action.</p>
                </div>
                <div class="delete-subcontainer-sub2">
                    <input type="hidden" name="delete-employeeId" id="delete-employeeId">
                    <button class="cancel-button-style" id="cancel-button-delete">Cancel</button>
                    <button class="delete-button-style" id="delete-button-submit" name="delete-button-submit">Delete</button>
                </div>
            </div>
        </form>

        <!-- Confirm Save -->
        <form method="put" action="employee.php" class="confirm-save-container" id="confirm-save-container">
        
            <div class="save-subcontainer">
                <div class="save-subcontainer-sub1">
                    <h1 class="save-h1-style">Save Changes</h1>
                    <p class="save-p-style">You have made changes. Do you want to discard or save them?</p>
                </div>
                <div class="save-subcontainer-sub2">
                    <input type="hidden" name="saveEmployeeId" id="saveEmployeeId">
                    <input type="hidden" name="saveFirstName" id="saveFirstName">
                    <input type="hidden" name="saveMiddleName" id="saveMiddleName">
                    <input type="hidden" name="saveLastName" id="saveLastName">
                    <input type="hidden" name="saveGender" id="saveGender">
                    <input type="hidden" name="saveBirthday" id="saveBirthday">
                    <input type="hidden" name="saveEmploymentType" id="saveEmploymentType">
                    <input type="hidden" name="saveDesignation" id="saveDesignation">
                    <input type="hidden" name="saveDateHired" id="saveDateHired">
                    <input type="hidden" name="savePayFrequency" id="savePayFrequency">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
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
                    <p class="p-style" id="employee-underline">EMPLOYEE</p>
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
                    <p class="p-style">PAYROLL</p>
                </div>
            </a>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-style">

        
        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar" placeholder="Search" autocomplete="off" oninput="searchEmployee()">
                <button class="add-button-style" id="open">Add Employees</button>
            </div>
            <div class="table-content">
                <table class="table-style" id="content1">
                    <thead>
                        <tr class="tr-style">
                            <th class="th-style" id="tableName">Name</th>
                            <th class="th-style" id="tableDesignation">Designation</th>
                            <th class="th-style" id="tableEmploymentType">Employment Type</th>
                        </tr>
                    </thead>
                    <tbody id="content">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/employee.js"></script>
    
</body>
</html>
