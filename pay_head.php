
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

    <div class="overlay" id="overlay"></div>
    <!-- Create Modal - Updated Design -->
    <form action="pay_head.php" method="post" class="modal-container" id="modal-container">
            <div class="modal-header">
                <h2>Create Pay Head</h2>
            </div>
            
            <div class="form-grid">
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter pay head name" autocomplete="off">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="5" placeholder="Enter description"></textarea>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type">
                            <option value="">Select One</option>
                            <option value="Earnings">Earnings</option>
                            <option value="Deductions">Deductions</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn-create" id="create" name="create">Create</button>
                <button type="button" class="btn-discard" id="discard">Discard</button>
            </div>
        </form>

        <!-- Edit Modal - Updated Design -->
        <form action="pay_head.php" method="post" class="edit-modal-container" id="edit-modal-container">
            <div class="modal-header">
                <h2>Edit Pay Head</h2>
            </div>
            
            <div class="form-grid">
                <input type="hidden" name="editPayHeadId" id="editPayHeadId">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" name="editName" id="editName" placeholder="Enter pay head name" autocomplete="off">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea name="editDescription" id="editDescription" rows="5" placeholder="Enter description"></textarea>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="editType">Type</label>
                        <select name="editType" id="editType">
                            <option value="">Select One</option>
                            <option value="Earnings">Earnings</option>
                            <option value="Deductions">Deductions</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-delete" id="delete">Delete</button>
                <button type="submit" class="btn-save" id="save" name="save">Save</button>
            </div>
        </form>

        <!-- Confirm Save - Updated Design -->
        <form class="confirm-save-container" id="confirm-save-container">
            <div class="confirm-title">Save Changes</div>
            <div class="confirm-message">You have made changes. Do you want to discard or save them?</div>
            
            <input type="hidden" name="savePayHeadId" id="savePayHeadId">
            <input type="hidden" name="saveName" id="saveName">
            <input type="hidden" name="saveDescription" id="saveDescription">
            <input type="hidden" name="saveType" id="saveType">
            
            <div class="confirm-buttons">
                <button type="button" class="btn-discard" id="cancel-button-save">Cancel</button>
                <button type="submit" class="btn-save" id="save-button-submit" name="save-button-submit">Save</button>
            </div>
        </form>

        <!-- Confirm Delete - Updated Design -->
        <form method="post" action="pay_head.php" class="confirm-delete-container" id="confirm-delete-container">
            <div class="confirm-title">Confirm Deletion</div>
            <div class="confirm-message">This will delete the pay head permanently. You cannot undo this action.</div>
            
            <input type="hidden" name="deletePayHeadId" id="deletePayHeadId">
            
            <div class="confirm-buttons">
                <button type="button" class="btn-discard" id="cancel-button-delete">Cancel</button>
                <button type="submit" class="btn-delete" id="delete-button-submit" name="delete-button-submit">Delete</button>
            </div>
        </form>
    <div class="content-style">

        
        <!-- Content -->
        <div class="box-style">
            <div class="content-container1">
                <input type="text" name="search" id="search" class="searchBar">
                <button class="add-button-style" id="open">Add Pay Head</button>
            </div>
            <div class="table-content">
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
    </div>
    <script src="js/pay_head.js"></script>
</body>
</html>
