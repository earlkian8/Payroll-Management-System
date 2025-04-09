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
    <link rel="stylesheet" href="css/pay-head-style.css">
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
                    <p class="p-style">EMPLOYEE</p>
                </div>
            </a>
            <a href="pay_head.php" class="a-style">
                <div class="a-container-style">
                    <img src="images/payHead-icon-61ccef.png" alt="Pay Head" class="logo-style">
                    <p class="p-style" id="pay-head-underline">PAY HEAD</p>
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

    <div class="content-style">

        <!-- Create Modal -->
        <form action="pay_head.php" method="post" class="modal-container" id="modal-container">
            <div class="modal-back-container">
                
            </div>
            <div class="modal-input-container">
                <div class="input-container">
                    <label for="name" class="label-style">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" autocomplete="off">
                </div>
                <div class="input-container">
                    <label for="description" class="label-style">Description</label>
                    <textarea name="description" id="description" rows="9"></textarea>
                </div>
                <div class="input-container">
                    <label for="type" class="label-style">Type</label>
                    <select name="type" id="type" class="select-style">
                        <option value="" class="option-style">Select One</option>
                        <option value="Earnings" class="option-style">Earnings</option>
                        <option value="Deductions" class="option-style">Deductions</option>
                    </select>
                </div>
            </div>
            <div class="modal-button-container">
                <button class="create-button-style" id="create" name="create">Create</button>
                <button class="discard-button-style" id="discard">Discard</button>
            </div>
        </form>

        <!-- Edit Modal -->
        <form action="pay_head.php" method="post" class="edit-modal-container" id="edit-modal-container">
            <div class="modal-back-container">
                <img src="images/arrow-icon-383838.png" alt="arrow" class="back-style" id="back">
            </div>
            <div class="modal-input-container">
                <input type="hidden" name="editPayHeadId" id="editPayHeadId">
                <div class="input-container">
                    <label for="editName" class="label-style">Name</label>
                    <input type="text" name="editName" id="editName" placeholder="Name" autocomplete="off">
                </div>
                <div class="input-container">
                    <label for="editDescription" class="label-style">Description</label>
                    <textarea name="editDescription" id="editDescription" rows="9"></textarea>
                </div>
                <div class="input-container">
                    <label for="editType" class="label-style">Type</label>
                    <select name="editType" id="editType" class="select-style">
                        <option value="" class="option-style">Select One</option>
                        <option value="Earnings" class="option-style">Earnings</option>
                        <option value="Deductions" class="option-style">Deductions</option>
                    </select>
                </div>
            </div>
            <div class="modal-button-container">
                <button class="save-button-style" id="save" name="save">Save</button>
                <button class="delete-button-style" id="delete">Delete</button>
            </div>
        </form>

        <!-- Confirm Save -->
        <form method="post" action="pay_head.php" class="confirm-save-container" id="confirm-save-container">
        
            <div class="save-subcontainer">
                <div class="save-subcontainer-sub1">
                    <h1 class="save-h1-style">Save Changes</h1>
                    <p class="save-p-style">You have made changes. Do you want to discard or save them?</p>
                </div>
                <div class="save-subcontainer-sub2">
                    <input type="hidden" name="savePayHeadId" id="savePayHeadId">
                    <input type="hidden" name="saveName" id="saveName">
                    <input type="hidden" name="saveDescription" id="saveDescription">
                    <input type="hidden" name="saveType" id="saveType">
                    <button class="cancel-button-style" id="cancel-button-save">Cancel</button>
                    <button class="confirm-save-button-style" id="save-button-submit" name="save-button-submit" type="submit">Save</button>
                </div>
            </div>
        </form>

        <!-- Confirm Delete -->
        <form method="post" action="pay_head.php" class="confirm-delete-container" id="confirm-delete-container">
        
        <div class="delete-subcontainer">
            <div class="delete-subcontainer-sub1">
                <h1 class="delete-h1-style">Confirm Deletion</h1>
                <p class="delete-p-style">This will delete the employee permanently. You cannot undo this action.</p>
            </div>
            <div class="delete-subcontainer-sub2">
                <input type="hidden" name="deletePayHeadId" id="deletePayHeadId">
                <button class="cancel-button-style" id="cancel-button-delete">Cancel</button>
                <button class="delete-button-style" id="delete-button-submit" name="delete-button-submit">Delete</button>
            </div>
        </div>
    </form>

        
        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Pay Head</button>
            </div>
            <table class="table-style" id="content1">
                <thead>
                    <tr class="tr-style">
                        <th class="th-style" id="tableName">Name</th>
                        <th class="th-style" id="tableDesignation">Description</th>
                        <th class="th-style" id="tableEmploymentType">Type</th>
                    </tr>
                </thead>
                <tbody id="content">
                    
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/pay_head.js"></script>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])){
        if(empty($_POST["name"]) || empty($_POST["description"]) || empty($_POST["type"])){
            echo "<script>console.log('get out');</script>";
        }
        $query = "INSERT INTO pay_head (name, description, type) VALUES (:name, :description, :type)";
        $stmt = $conn->prepare($query);
        $stmt->execute([":name" => $_POST["name"], ":description" => $_POST["description"], ":type" => $_POST["type"]]);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save-button-submit"])){
        $query = "UPDATE pay_head SET name = :name, description = :description, type = :type WHERE pay_head_id = :pay_head_id";
        $stmt = $conn->prepare($query);
        $stmt->execute([":pay_head_id" => $_POST["savePayHeadId"], ":name" => $_POST["saveName"], ":description" => $_POST["saveDescription"], ":type" => $_POST["saveType"]]);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-button-submit"])){
        $query = "DELETE FROM pay_head WHERE pay_head_id = :pay_head_id";
        $stmt = $conn->prepare($query);
        $stmt->execute([":pay_head_id" => $_POST["deletePayHeadId"]]);
    }
?>