<?php

    session_start();

    if(empty($_SESSION["userId"])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WageFlow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="Stylesheet" href="style/about_us.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <span>WageFlow</span></i>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li id="dashboardNav"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></li>
                <li id="employeeNav"><i class="fas fa-users"></i><span>Employees</span></li>
                <li id="payheadNav"><i class="fas fa-file-invoice-dollar"></i><span>Pay Heads</span></li>
                <li id="payrollNav"><i class="fas fa-wallet"></i><span>Payroll</span></li>
                <li id="about_usNav" class="active"><i class="fas fa-info-circle"></i><span>About Us</span></li>
            </ul>
        </div>
        <button class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></button>
    </div>

    <!-- Content Area -->
    <div class="content">
        <div class="container">
            <!-- Header Section -->
            <div class="header">
                <h1>WageFlow</h1>
                <p class="header-description">
                    Our Payroll Management System is designed to simplify and streamline employee salary processing for businesses of all sizes. 
                    With an intuitive interface, admins can easily add new employees and manage detailed salary components. 
                    The system supports flexible salary adjustments, allowing for both additions and deductions across multiple categories such as 
                    base salary, overtime, and absence-related deductions. Our goal is to provide an efficient, accurate, and user-friendly payroll solution 
                    that reduces manual workload and ensures transparent salary management.
                </p>
            </div>

            <!-- Features Section -->
            <div class="features">
                <div class="feature">
                    <h3>Payslips</h3>
                    <p>Effortlessly manage and distribute employee payslips</p>
                </div>
                <div class="feature">
                    <h3>Pay Adjustments</h3>
                    <p>Automatically adjust payroll for time off or expenses</p>
                </div>
                <div class="feature">
                    <h3>Accurate</h3>
                    <p>Correct and on-time pay cycles, every time</p>
                </div>
            </div>            <!-- Team Section -->
            <div class="team">
                <div class="section-title">
                    <h2>Meet Our Team</h2>
                    <p>The talented individuals behind WageFlow who make it all possible through their dedication and expertise.</p>
                </div>
                <div class="team-grid">                  <div class="team-member">
                        <div class="profile-image">
                            <img src="profilepic/476885990_2081761255594300_8938709715138692042_n (1).jpg" alt="Earl Kean Ronquillo">
                        </div>
                        <div class="team-member-info">
                            <h3 class="h2Class">Earl Kian Bancayrin</h3>
                            <p class="role">Full Stack Developer</p>
                            <p class="description">Our leader plays a vital role in our team's success. He consistently guides us with clarity and purpose, ensuring that everyone stays on track and works together effectively.</p>
                            <a href="#" class="portfolio-link">
                                <i class="fas fa-external-link-alt"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>                    <div class="team-member">
                        <div class="profile-image">
                            <img src="profilepic/481906204_2247310732337904_2716130117285623305_n.jpg" alt="Francis John Miravilla">
                        </div>
                        <div class="team-member-info">
                            <h3 class="h2Class">Francis John Miravilla</h3>
                            <p class="role">Full Stack Developer</p>
                            <p class="description">The team relies heavily on his technical expertise. Each responsibility was handled with focus and precision, ensuring high-quality results in every task.</p>
                            <a href="#" class="portfolio-link">
                                <i class="fas fa-external-link-alt"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>                    <div class="team-member">
                        <div class="profile-image">
                            <img src="profilepic/476898155_1320555819067010_7432012595179810724_n.jpg" alt="Alfarine Jay Usman">
                        </div>
                        <div class="team-member-info">
                            <h3 class="h2Class">Albriane Jay Usman</h3>
                            <p class="role">Full Stack Developer</p>
                            <p class="description">A dedicated team member who brings innovative solutions to complex challenges. His attention to detail and problem-solving skills are invaluable to the team.</p>
                            <a href="#" class="portfolio-link">
                                <i class="fas fa-external-link-alt"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="profile-image">
                            <img src="profilepic/7184cca2-e510-4b27-b06e-593ae27a4eea.jpg" alt="Paolo Epifanio Santos">
                        </div>
                        <div class="team-member-info">
                            <h3 class="h2Class">Paolo Eijansantos</h3>
                            <p class="role">Full Stack Developer</p>
                            <p class="description">An exceptional problem solver with a keen eye for detail. His contributions to the project have been fundamental in achieving our goals.</p>
                            <a href="#" class="portfolio-link">
                                <i class="fas fa-external-link-alt"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="profile-image">
                            <img src="profilepic/483364843_1414330929945340_4082829181561162614_n.jpg" alt="Charles Gumarang">
                        </div>
                        <div class="team-member-info">
                            <h3 class="h2Class">Charles Gumondas</h3>
                            <p class="role">Full Stack Developer</p>
                            <p class="description">Brings creative solutions and technical expertise to the team. His dedication to quality and efficiency has greatly improved our workflow.</p>
                            <a href="#" class="portfolio-link">
                                <i class="fas fa-external-link-alt"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="profile-image">
                            <img src="profilepic/494818709_662250963373750_7714246490914583073_n.jpg" alt="Cyclick Amparan">
                        </div>
                        <div class="team-member-info">
                            <h3 class="h2Class">Cydrick Amparan</h3>
                            <p class="role">Full Stack Developer</p>
                            <p class="description">A valuable team member who consistently delivers high-quality work. His technical skills and collaborative nature enhance our team's capabilities.</p>
                            <a href="#" class="portfolio-link">
                                <i class="fas fa-external-link-alt"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>
                    <div class="team-member">
                        <div class="profile-image">
                            <img src="profilepic/470809866_1101392411605690_1316741824659011507_n.jpg" alt="Amor Sabtil">
                        </div>
                        <div class="team-member-info">
                            <h3 class="h2Class">Ameer Sabtal</h3>
                            <p class="role">Full Stack Developer</p>
                            <p class="description">Demonstrates exceptional problem-solving abilities and technical expertise. His contributions have been essential to the project's success.</p>
                            <a href="#" class="portfolio-link">
                                <i class="fas fa-external-link-alt"></i>
                                View Portfolio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar Link Activation
        document.querySelectorAll('.sidebar-menu ul li a').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelector('.sidebar-menu ul li a.active').classList.remove('active');
                this.classList.add('active');
            });
        });

        // Logout Button (Demo)
        document.querySelector('.logout-btn').addEventListener('click', function() {
            // Implement logout logic (e.g., redirect to logout endpoint)
            alert('Logging out...');
        });
    </script>
    <script src="js/about_us.js"></script>
</body>
</html>