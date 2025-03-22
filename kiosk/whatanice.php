<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Kiosk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .logo {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
        }

        .logo h1 {
            font-size: 24px;
        }

        .menu {
            margin-top: 30px;
            flex: 1;
        }

        .menu-item {
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        .menu-item:hover, .menu-item.active {
            background-color: #34495e;
        }

        .menu-item i {
            margin-right: 10px;
            font-size: 20px;
        }

        .menu-item.active {
            border-left: 4px solid #3498db;
        }

        .user-info {
            padding: 15px 20px;
            border-top: 1px solid #34495e;
        }

        /* Main content styles */
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .date-time {
            font-size: 18px;
            color: #7f8c8d;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #2c3e50;
            display: flex;
            align-items: center;
        }

        .card-title i {
            margin-right: 10px;
            color: #3498db;
        }

        /* Time Attendance Section */
        .time-card {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .time-action {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background-color: #f8f9fa;
            width: 45%;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .time-action:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .time-action h3 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .time-action.time-in {
            border-left: 4px solid #2ecc71;
        }

        .time-action.time-out {
            border-left: 4px solid #e74c3c;
        }

        .time-status {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #ecf0f1;
            border-radius: 4px;
        }

        /* Leave Request Section */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #2c3e50;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea.form-control {
            height: 100px;
            resize: none;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        /* Salary History Section */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        /* Content Sections */
        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        /* Responsive design adjustment */
        @media (max-width: 1200px) {
            .time-card {
                flex-direction: column;
                align-items: center;
            }
            
            .time-action {
                width: 80%;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h1>COMPANY KIOSK</h1>
            </div>
            <div class="menu">
                <div class="menu-item active" onclick="showSection('attendance')">
                    <i>🕒</i>
                    <span>Attendance</span>
                </div>
                <div class="menu-item" onclick="showSection('leave')">
                    <i>📅</i>
                    <span>Request Leave</span>
                </div>
                <div class="menu-item" onclick="showSection('salary')">
                    <i>💰</i>
                    <span>Salary History</span>
                </div>
            </div>
            <div class="user-info">
                <p><strong>John Doe</strong></p>
                <p>Employee ID: EMP001</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h2>Employee Self-Service Kiosk</h2>
                <div class="date-time" id="current-date-time"></div>
            </div>

            <!-- Attendance Section -->
            <div id="attendance" class="section active">
                <div class="card">
                    <div class="card-title">
                        <i>🕒</i> Time Attendance
                    </div>
                    <div class="time-status" id="status-message">
                        Your current status: Not checked in
                    </div>
                    <div class="time-card">
                        <div class="time-action time-in" onclick="timeIn()">
                            <h3>Time In</h3>
                            <p>Record your arrival time</p>
                        </div>
                        <div class="time-action time-out" onclick="timeOut()">
                            <h3>Time Out</h3>
                            <p>Record your departure time</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">
                        <i>📊</i> Recent Attendance Records
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Total Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>March 22, 2025</td>
                                    <td>08:30 AM</td>
                                    <td>05:15 PM</td>
                                    <td>8.75</td>
                                </tr>
                                <tr>
                                    <td>March 21, 2025</td>
                                    <td>08:27 AM</td>
                                    <td>05:30 PM</td>
                                    <td>9.05</td>
                                </tr>
                                <tr>
                                    <td>March 20, 2025</td>
                                    <td>08:15 AM</td>
                                    <td>05:00 PM</td>
                                    <td>8.75</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Leave Request Section -->
            <div id="leave" class="section">
                <div class="card">
                    <div class="card-title">
                        <i>📅</i> Request Leave
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="leave-type">Leave Type</label>
                            <select id="leave-type" class="form-control">
                                <option value="" disabled selected>Select Leave Type</option>
                                <option value="annual">Annual Leave</option>
                                <option value="sick">Sick Leave</option>
                                <option value="personal">Personal Leave</option>
                                <option value="unpaid">Unpaid Leave</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start-date">Start Date</label>
                            <input type="date" id="start-date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end-date">End Date</label>
                            <input type="date" id="end-date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea id="reason" class="form-control" placeholder="Please provide a reason for your leave request"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitLeaveRequest()">Submit Request</button>
                    </form>
                </div>
                <div class="card">
                    <div class="card-title">
                        <i>📋</i> Leave Balance
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Available</th>
                                    <th>Used</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Annual Leave</td>
                                    <td>15 days</td>
                                    <td>5 days</td>
                                    <td>20 days</td>
                                </tr>
                                <tr>
                                    <td>Sick Leave</td>
                                    <td>8 days</td>
                                    <td>2 days</td>
                                    <td>10 days</td>
                                </tr>
                                <tr>
                                    <td>Personal Leave</td>
                                    <td>3 days</td>
                                    <td>0 days</td>
                                    <td>3 days</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Salary History Section -->
            <div id="salary" class="section">
                <div class="card">
                    <div class="card-title">
                        <i>💰</i> Salary History
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Pay Period</th>
                                    <th>Basic Salary</th>
                                    <th>Allowances</th>
                                    <th>Deductions</th>
                                    <th>Net Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>March 2025</td>
                                    <td>$4,500.00</td>
                                    <td>$500.00</td>
                                    <td>$1,200.00</td>
                                    <td>$3,800.00</td>
                                </tr>
                                <tr>
                                    <td>February 2025</td>
                                    <td>$4,500.00</td>
                                    <td>$500.00</td>
                                    <td>$1,200.00</td>
                                    <td>$3,800.00</td>
                                </tr>
                                <tr>
                                    <td>January 2025</td>
                                    <td>$4,500.00</td>
                                    <td>$500.00</td>
                                    <td>$1,200.00</td>
                                    <td>$3,800.00</td>
                                </tr>
                                <tr>
                                    <td>December 2024</td>
                                    <td>$4,500.00</td>
                                    <td>$750.00</td>
                                    <td>$1,200.00</td>
                                    <td>$4,050.00</td>
                                </tr>
                                <tr>
                                    <td>November 2024</td>
                                    <td>$4,500.00</td>
                                    <td>$500.00</td>
                                    <td>$1,200.00</td>
                                    <td>$3,800.00</td>
                                </tr>
                                <tr>
                                    <td>October 2024</td>
                                    <td>$4,500.00</td>
                                    <td>$500.00</td>
                                    <td>$1,200.00</td>
                                    <td>$3,800.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to update date and time
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('current-date-time').textContent = now.toLocaleString('en-US', options);
        }

        // Update date and time every second
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Function to show section
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.section').forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            document.getElementById(sectionId).classList.add('active');

            // Update menu active state
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Find the clicked menu item and make it active
            const menuItems = document.querySelectorAll('.menu-item');
            for (let i = 0; i < menuItems.length; i++) {
                if (menuItems[i].textContent.trim().toLowerCase().includes(sectionId)) {
                    menuItems[i].classList.add('active');
                    break;
                }
            }
        }

        // Time in function
        function timeIn() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US');
            document.getElementById('status-message').innerHTML = 
                `Your current status: Checked in at <strong>${timeString}</strong>`;
        }

        // Time out function
        function timeOut() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US');
            document.getElementById('status-message').innerHTML = 
                `Your current status: Checked out at <strong>${timeString}</strong>`;
        }

        // Submit leave request function
        function submitLeaveRequest() {
            alert('Leave request submitted successfully!');
            document.querySelectorAll('form input, form textarea, form select').forEach(input => {
                input.value = '';
            });
        }
    </script>
</body>
</html>