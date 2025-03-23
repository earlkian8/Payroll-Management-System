<?php

    require_once "db_connection.php";

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
                <button class="create-button-style" id="create" name="create" type="submit">Create</button>
                <button class="discard-button-style" id="discard">Discard</button>
            </div>
        </form>

        <!-- Employee Details -->
        <form action="employee.php" method="post" class="employee-details" id="employee-details">
            <div class="text-container-style">
                <h1 class="h1-text-style">Employee Information</h1>
                <img src="images/arrow-icon-383838.png" alt="Back" class="back-style" id="back">
            </div>
            <div class="information-container-style">
                <div class="information-subcontainer1">
                    <div class="employee-information-div">
                        <div class="employee-subcontainer1-information">
                            <h1 class="name-information-style" id="name-information">Earl Kian A. Bancayrin</h1>
                            <p class="employeeId-information-style" id="employeeId-information">202330131</p>
                        </div>
                        <div class="employee-subcontainer2-information">
                            <div class="left-employee-subcontainer2-information">
                                <p class="information-style" id="gender-information-">Gender:</p>
                                <p class="information-style" id="birthday-information-">Birthday:</p>
                                <p class="information-style" id="employmentType-information-">Employment Type:</p>
                                <p class="information-style" id="designation-information-">Designation:</p>
                                <p class="information-style" id="salary-information-">Salary:</p>
                                <p class="information-style" id="overtimePay-information-">Overtime Pay:</p>
                                <p class="information-style" id="timeIn-information-">Time In:</p>
                                <p class="information-style" id="timeOut-information-">Time Out:</p>
                                <p class="information-style" id="dateHired-information-">Date Hired:</p>
                            </div>
                            <div class="right-employee-subcontainer2-information">
                                <p class="value-style" id="gender-value"></p>
                                <p class="value-style" id="birthday-value"></p>
                                <p class="value-style" id="employmentType-value"></p>
                                <p class="value-style" id="designation-value"></p>
                                <p class="value-style" id="salary-value"></p>
                                <p class="value-style" id="overtimePay-value"></p>
                                <p class="value-style" id="timeIn-value"></p>
                                <p class="value-style" id="timeOut-value"></p>
                                <p class="value-style" id="dateHired-value"></p>
                            </div>
                            <div class="bottom-employee-subcontainer2-information">
                                <button class="edit-button-style" id="e">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="information-subcontainer2">
                    <div class="information-sub-subcontainer2">
                        <div class="performance-information-div">
                            <!-- Tabs -->
                            <div class="tabs">
                                <div class="tab active" onclick="openTab(0)">Salary</div>
                                <div class="tab" onclick="openTab(1)">Attendance</div>
                                <div class="tab" onclick="openTab(2)">Leave Request</div>
                            </div>
                            
                            <!-- Tab Content -->
                            <ul class="salary-content tab-content active" id="salary-content">
                                <!-- Salary Content -->
                            </ul>
                            <ul class="attendance-content tab-content" id="attendance-content">
                                <!-- Attendance Content -->
                            </ul>
                            <ul class="leave-content tab-content" id="leave-content">
                                <!-- Leave Content -->
                            </ul>
                        </div>
                        <div class="button-information-div">
                            <button class="delete-button-style" id="delete-button-id">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Edit Modal -->
        <form action="employee.php" method="post" class="edit-modal-container" id="edit-modal-container">
            <div class="modal-text-container">
                <h1 class="h1-style">Create Employee</h1>
            </div>
            <div class="modal-input-container">
                <div class="modal-subcontainer1">
                    <div class="input-container-subcontainer1">
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
                        <label for="editSalary" class="label-style">Salary</label>
                        <input type="number" name="editSalary" id="editSalary" placeholder="Salary" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editOvertimePay" class="label-style">Overtime Pay</label>
                        <input type="number" name="editOvertimePay" id="editOvertimePay" placeholder="Overtime Pay" required autocomplete="off">
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editTimeIn" class="label-style">Time In</label>
                        <input type="time" name="editTimeIn" id="editTimeIn" placeholder="Time In" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editTimeOut" class="label-style">Time Out</label>
                        <input type="time" name="editTimeOut" id="editTimeOut" placeholder="Time Out" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editDateHired" class="label-style">Date Hired</label>
                        <input type="date" name="editDateHired" id="editDateHired" required>
                    </div>
                    <div class="input-container-subcontainer2">
                        <label for="editEmployeeId" class="label-style">Employee ID</label>
                        <input type="number" name="editEmployeeId" id="editEmployeeId" required>
                    </div>
                </div>
            </div>
            <div class="modal-button-container">
                <button class="create-button-style" id="edit" name="edit" type="submit">Save</button>
                <button class="discard-button-style" id="editDiscard">Discard</button>
            </div>
        </form>

         <!-- Confirm Delete -->
         <form method="post" action="employee.php" class="confirm-delete-container" id="confirm-delete-container">
        
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
        <form method="post" action="employee.php" class="confirm-save-container" id="confirm-save-container">
        
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
                    <input type="hidden" name="saveSalary" id="saveSalary">
                    <input type="hidden" name="saveOvertimePay" id="saveOvertimePay">
                    <input type="hidden" name="saveTimeIn" id="saveTimeIn">
                    <input type="hidden" name="saveTimeOut" id="saveTimeOut">
                    <input type="hidden" name="saveDateHired" id="saveDateHired">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>
        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Employees</button>
            </div>
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

        public function __construct($employee_id, $first_name, $middle_name, $last_name, $gender, $birthday, $employmentType, $designation, $salary, $overtime_pay, $time_in, $time_out, $date_hired){
            $this->employee_id = $employee_id;
            $this->first_name = $first_name;
            $this->middle_name = $middle_name;
            $this->last_name = $last_name;
            $this->gender = $gender;
            $this->birthday = $birthday;
            $this->employmentType = $employmentType;
            $this->designation = $designation;
            $this->salary = $salary;
            $this->overtime_pay = $overtime_pay;
            $this->time_in = $time_in;
            $this->time_out = $time_out;
            $this->date_hired = $date_hired;       
        }

        public function getEmployeeId(){
            return $this->employee_id;
        }

        public function setEmployeeId($s){
            $this->employee_id = $s;
        }

        public function getFirstName(){
            return $this->first_name;
        }

        public function setFirstName($s){
            $this->first_name = $s;
        }
        
        public function getMiddleName(){
            return $this->middle_name;
        }

        public function setMiddleName($s){
            $this->middle_name = $s;
        }

        public function getLastName(){
            return $this->last_name;
        }

        public function setLastName($s){
            $this->last_name = $s;
        }

        public function getGender(){
            return $this->gender;
        }

        public function setGender($s){
            $this->gender = $s;
        }
        
        public function getBirthday(){
            return $this->birthday;
        }

        public function setBirthday($s){
            $this->birthday = $s;
        }

        public function getEmploymentType(){
            return $this->employmentType;
        }

        public function setEmploymentType($s){
            $this->employmentType = $s;
        }

        public function getDesignation(){
            return $this->designation;
        }

        public function setDesignation($s){
            $this->designation = $s;
        }

        public function getSalary(){
            return $this->salary;
        }

        public function setSalary($s){
            $this->salary = $s;
        }

        public function getOvertimePay(){
            return $this->overtime_pay;
        }

        public function setOvertimePay($s){
            $this->overtime_pay = $s;
        }

        public function getTimeIn(){
            return $this->time_in;
        }

        public function setTimeIn($s){
            $this->time_in = $s;
        }

        public function getTimeOut(){
            return $this->time_out;
        }

        public function setTimeOut($s){
            $this->time_out = $s;
        }

        public function getDateHired(){
            return $this->date_hired;
        }

        public function setDateHired($s){
            $this->date_hired = $s;
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){
        if(empty($_POST["employeeId"]) || empty($_POST["firstName"]) || empty($_POST["lastName"]) || empty($_POST["gender"]) || empty($_POST["birthday"]) || empty($_POST["employmentType"]) || empty($_POST["designation"]) || empty($_POST["salary"]) || empty($_POST["overtimePay"]) || empty($_POST["timeIn"]) || empty($_POST["timeOut"]) || empty($_POST["dateHired"])){
            die("get out!");
        }

        $employee = new Employee($_POST["employeeId"], $_POST["firstName"], $_POST["middleName"] ?? '', $_POST["lastName"], $_POST["gender"], $_POST["birthday"], $_POST["employmentType"], $_POST["designation"], $_POST["salary"], $_POST["overtimePay"], $_POST["timeIn"], $_POST["timeOut"], $_POST["dateHired"]);

        $sql = "INSERT INTO employees (employee_id, first_name, middle_name, last_name, gender, birthday, employment_type, designation, salary, overtime_pay, time_in, time_out, date_hired) VALUES (:employee_id, :first_name, :middle_name, :last_name, :gender, :birthday, :employment_type, :designation, :salary, :overtime_pay, :time_in, :time_out, :date_hired)";
        $statement = $conn->prepare($sql);
        $statement->execute([':employee_id' => $employee->getEmployeeId(), ':first_name' => $employee->getFirstName(), ':middle_name' => $employee->getMiddleName(), ':last_name' => $employee->getLastName(), ':gender' => $employee->getGender(), ':birthday' => $employee->getBirthday(), ':employment_type' => $employee->getEmploymentType(), ':designation' => $employee->getDesignation(), ':salary' => $employee->getSalary(), ':overtime_pay' => $employee->getOvertimePay(), ':time_in' => $employee->getTimeIn(), ':time_out' => $employee->getTimeOut(), ':date_hired' => $employee->getDateHired()]);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
        $delete_employee_id = $_POST["delete-employeeId"];

        $sql = "DELETE FROM employees WHERE employee_id = :employee_id";
        $statement = $conn->prepare($sql);
        $statement->execute([':employee_id' => $delete_employee_id]);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        
        $employee = new Employee($_POST["saveEmployeeId"], $_POST["saveFirstName"], $_POST["saveMiddleName"] ?? '', $_POST["saveLastName"], $_POST["saveGender"], $_POST["saveBirthday"], $_POST["saveEmploymentType"], $_POST["saveDesignation"], $_POST["saveSalary"], $_POST["saveOvertimePay"], $_POST["saveTimeIn"], $_POST["saveTimeOut"], $_POST["saveDateHired"]);

        $sql = "UPDATE employees SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, gender = :gender, birthday = :birthday, employment_type = :employment_type, designation = :designation, salary = :salary, overtime_pay = :overtime_pay, time_in = :time_in, time_out = :time_out, date_hired = :date_hired WHERE employee_id = :employee_id";
        $statement = $conn->prepare($sql);
        $statement->execute([':first_name' => $employee->getFirstName(), ':middle_name' => $employee->getMiddleName(), ':last_name' => $employee->getLastName(), ':gender' => $employee->getGender(), ':birthday' => $employee->getBirthday(), ':employment_type' => $employee->getEmploymentType(), ':designation' => $employee->getDesignation(), ':salary' => $employee->getSalary(), ':overtime_pay' => $employee->getOvertimePay(), ':time_in' => $employee->getTimeIn(), ':time_out' => $employee->getTimeOut(), ':date_hired' => $employee->getDateHired(), ':employee_id' => $employee->getEmployeeId()]);
    }
?>