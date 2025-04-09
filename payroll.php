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
                        <th class="th-style" id="tableDate">Date</th>
                    </tr>
                </thead>
                <tbody id="content">
                    
                </tbody>
            </table>
            <table class="table-style tab-content" id="issued-content">
                <thead>
                    <tr class="tr-style">
                        <th class="th-style" id="tableName">Name</th>
                        <th class="th-style" id="tableDate">Date</th>
                    </tr>
                </thead>
                <tbody id="content">
                    
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
</body>
</html>