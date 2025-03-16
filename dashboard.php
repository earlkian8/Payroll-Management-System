<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>WageFlow</title>
        <link rel="stylesheet" href="CSS/dashboard.css" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        />
    </head>
    <body>
        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-header">
                    <img
                        src="IMG/moneylogo-removebg-preview.png"
                        alt="WageFlow logo"
                        class="logo-img"
                    />
                    <h2>Wage<span>Flow</span></h2>
                </div>
                <div class="sidebar-menu">
                    <div class="menu-item active">
                        <i class="fas fa-th-large"></i>
                        <span>DASHBOARD</span>
                    </div>
                    <div class="menu-item">
                        <i class="fas fa-users"></i>
                        <span>EMPLOYEES</span>
                    </div>
                    <div class="menu-item">
                        <i class="fas fa-calendar-check"></i>
                        <span>LEAVE APPROVAL</span>
                    </div>
                    <div class="menu-item">
                        <i class="fas fa-money-bill-wave"></i>
                        <span>PAYROLL</span>
                    </div>
                    <div class="menu-item">
                        <i class="fas fa-clock"></i>
                        <span>ATTENDANCE</span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Summary Cards -->
                <div class="summary-cards">
                    <div class="card employee-card">
                        <div class="card-icon blue">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-info">
                            <h3>12</h3>
                            <p>Total Employees</p>
                        </div>
                    </div>
                    <div class="card present-card">
                        <div class="card-icon green">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="card-info">
                            <h3>11</h3>
                            <p>Today's Present</p>
                        </div>
                    </div>
                    <div class="card absent-card">
                        <div class="card-icon red">
                            <i class="fas fa-times"></i>
                        </div>
                        <div class="card-info">
                            <h3>1</h3>
                            <p>Today's Absent</p>
                        </div>
                    </div>
                </div>

                <!-- Chart and Finance Section -->
                <div class="chart-finance-row">
                    <div class="finance-section">
                        <div class="section-header">
                            <h3>Finance</h3>
                        </div>
                        <div class="finance-content">
                            <div class="finance-graph">
                                <!-- Graph goes here -->
                                <div class="graph-container">
                                    <div class="y-axis">
                                        <div class="y-label">₱100k</div>
                                        <div class="y-label">₱80k</div>
                                        <div class="y-label">₱60k</div>
                                        <div class="y-label">₱40k</div>
                                        <div class="y-label">₱20k</div>
                                    </div>
                                    <div class="graph-grid">
                                        <!-- Grid lines would be added via CSS -->
                                    </div>
                                    <div class="x-axis">
                                        <div class="x-label">Jan</div>
                                        <div class="x-label">Feb</div>
                                        <div class="x-label">Mar</div>
                                        <div class="x-label">May</div>
                                        <div class="x-label">Jun</div>
                                        <div class="x-label">Jul</div>
                                        <div class="x-label">Aug</div>
                                        <div class="x-label">Sep</div>
                                        <div class="x-label">Oct</div>
                                        <div class="x-label">Nov</div>
                                        <div class="x-label">Dec</div>
                                    </div>
                                </div>
                            </div>
                            <div class="finance-stats">
                                <div class="stat-item">
                                    <div class="icon-container">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="stat-info">
                                        <p>Monthly Payroll</p>
                                        <h3>₱ 249,304</h3>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="icon-container">
                                        <i class="fas fa-gift"></i>
                                    </div>
                                    <div class="stat-info">
                                        <p>Bonus</p>
                                        <h3>₱ 35,493</h3>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="icon-container">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-info">
                                        <p>Overtime</p>
                                        <h3>₱ 27,394</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chart-section">
                        <div class="donut-chart">
                            <!-- Donut chart would be replaced with actual chart library -->
                            <div class="chart-placeholder">
                                <div class="donut">
                                    <div class="inner-circle"></div>
                                </div>
                                <div class="chart-legend">
                                    <div class="legend-item">
                                        <div class="color-box full-time"></div>
                                        <span>Full-time</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="color-box part-time"></div>
                                        <span>Part-time</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Tables -->
                <div class="status-tables">
                    <div class="table-card">
                        <div class="table-header">
                            <h3>Recent Salary Issued</h3>
                        </div>
                        <table>
                            <tr>
                                <td>Ana Lyn</td>
                                <td>02-22-2025</td>
                                <td><span class="status paid">Paid</span></td>
                            </tr>
                            <tr>
                                <td>Francis Cu...</td>
                                <td>02-22-2025</td>
                                <td><span class="status paid">Paid</span></td>
                            </tr>
                            <tr>
                                <td>MrBeast</td>
                                <td>02-22-2025</td>
                                <td><span class="status paid">Paid</span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h3>Today's Present</h3>
                        </div>
                        <table>
                            <tr>
                                <td>Ana Lyn</td>
                                <td>02-22-2025</td>
                                <td>
                                    <span class="status on-time">On Time</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Francis Cu...</td>
                                <td>02-22-2025</td>
                                <td>
                                    <span class="status on-time">On Time</span>
                                </td>
                            </tr>
                            <tr>
                                <td>MrBeast</td>
                                <td>02-22-2025</td>
                                <td><span class="status late">Late</span></td>
                            </tr>
                        </table>
                    </div>

                    <div class="table-card">
                        <div class="table-header">
                            <h3>Today's Absent</h3>
                        </div>
                        <table>
                            <tr>
                                <td>Ana Lyn</td>
                                <td>02-22-2025</td>
                                <td>
                                    <span class="status absent">Absent</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
