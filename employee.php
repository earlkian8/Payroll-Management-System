<?php

    include "db_connection.php";

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
            <a href="leave_approval.php" class="a-style">
                <div class="a-container-style">
                    <img src="images/leave-61ccef.png" alt="Leave" class="logo-style">
                    <p class="p-style">LEAVE APPROVAL</p> 
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

        <!-- Create Modal -->
        <form action="employee.php" method="post" class="modal-container" id="modal-container">
            <div class="modal-text-container">
                <h1 class="h1-style">Create Employee</h1>
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
                        <input type="date" name="birthday" id="birthday" required placeholder="Date of Birth" pattern="^(19[0-9]{2}|20[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|30)$">
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
                        <label for="salary" class="label-style">Salary</label>
                        <input type="number" name="salary" id="salary" placeholder="Salary" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="overtimePay" class="label-style">Overtime Pay</label>
                        <input type="number" name="overtimePay" id="overtimePay" placeholder="Overtime Pay" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="timeIn" class="label-style">Time In</label>
                        <input type="time" name="timeIn" id="timeIn" placeholder="Time In" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="timeOut" class="label-style">Time Out</label>
                        <input type="time" name="timeOut" id="timeOut" placeholder="Time Out" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="dateHired" class="label-style">Date Hired</label>
                        <input type="date" name="dateHired" id="dateHired" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="employeeId" class="label-style">Employee ID</label>
                        <input type="number" name="employeeId" id="employeeId" required>
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
                <button class="create-button-style" id="create" name="create">Create</button>
                <button class="discard-button-style" id="discard">Discard</button>
            </div>
        </form>

        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Employees</button>
            </div>
            
            <ul class="content-container2" id="content">
                <!-- JavaScript -->
                 
            </ul>
        </div>
    </div>

    <script src="js/employee.js"></script>
</body>
</html>

<?php

    class Employee{
        private $employee_id;
        private $first_name;
        private $middle_name;
        private $last_name;
        private $gender;
        private $birthday;
        private $employmentType;
        private $designation;
        private $salary;
        private $overtime_pay;
        private $time_in;
        private $time_out;
        private $date_hired;

    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){

    }
?>