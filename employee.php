<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WageFlow</title>
    <link rel="stylesheet" href="/CSS/employee.css">
    
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="logo.png" alt="WageFlow Logo">
                <h1>WageFlow</h1>
            </div>
            <nav>
                <ul>
                    <li class="nav-item">
                        <i class="fas fa-home"></i>
                        <span>DASHBOARD</span>
                    </li>
                    <li class="nav-item active">
                        <i class="fas fa-users"></i>
                        <span>EMPLOYEES</span>
                    </li>
                    <li class="nav-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>LEAVE APPROVAL</span>
                    </li>
                    <li class="nav-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>PAYROLL</span>
                    </li>
                    <li class="nav-item">
                        <i class="fas fa-clock"></i>
                        <span>ATTENDANCE</span>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="main-content">
            <div class="search-bar">
                <div class="search-container">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search">
                    <button class="filter-btn">
                        <i class="fas fa-sliders-h"></i>
                    </button>
                </div>
                <button class="add-btn"><a href="add.html"> Add </a></button>
            </div>
            <div class="employee-list">
                <!-- Empty container for employee list -->
            </div>
        </div>
    </div>
</body>
</html>