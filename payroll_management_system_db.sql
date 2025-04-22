-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 04:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payroll_management_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthday` date NOT NULL,
  `employment_type` enum('Full Time','Part Time','Freelance') NOT NULL,
  `designation` varchar(50) NOT NULL,
  `date_hired` date NOT NULL,
  `pay_frequency` enum('Monthly','Bi-Weekly','Weekly') NOT NULL,
  `last_pay_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `middle_name`, `last_name`, `gender`, `birthday`, `employment_type`, `designation`, `date_hired`, `pay_frequency`, `last_pay_date`) VALUES
(1, 'John', 'Michael', 'Smith', 'Male', '1985-06-15', 'Full Time', 'Software Engineer', '2020-03-10', 'Monthly', '2025-04-18'),
(2, 'Sarah', 'Elizabeth', 'Johnson', 'Female', '1990-09-22', 'Full Time', 'Project Manager', '2019-07-15', 'Monthly', '2025-04-18'),
(3, 'Robert', NULL, 'Williams', 'Male', '1988-11-05', 'Full Time', 'System Administrator', '2021-01-20', 'Bi-Weekly', '2025-04-18'),
(4, 'Emily', 'Anne', 'Brown', 'Female', '1992-04-30', 'Part Time', 'Graphic Designer', '2022-02-14', 'Weekly', '2025-04-18'),
(5, 'Michael', 'James', 'Jones', 'Male', '1983-12-18', 'Full Time', 'Senior Developer', '2018-05-22', 'Monthly', '2025-04-18'),
(6, 'Jessica', 'Marie', 'Garcia', 'Female', '1991-07-11', 'Full Time', 'HR Manager', '2020-11-03', 'Monthly', '2025-04-22'),
(7, 'David', 'William', 'Miller', 'Male', '1987-03-25', 'Full Time', 'Database Administrator', '2019-09-08', 'Bi-Weekly', '2025-04-22'),
(8, 'Jennifer', 'Lynn', 'Davis', 'Female', '1989-08-09', 'Part Time', 'Marketing Specialist', '2021-06-17', 'Weekly', '2025-04-22'),
(9, 'Christopher', 'Ryan', 'Rodriguez', 'Male', '1986-01-12', 'Full Time', 'IT Support', '2020-04-05', 'Monthly', '2025-04-18'),
(10, 'Amanda', 'Nicole', 'Martinez', 'Female', '1993-05-28', 'Freelance', 'Content Writer', '2022-03-01', 'Weekly', '2025-04-22'),
(11, 'Daniel', 'Thomas', 'Hernandez', 'Male', '1984-10-15', 'Full Time', 'Network Engineer', '2019-02-10', 'Monthly', '2025-04-18'),
(12, 'Michelle', 'Grace', 'Lopez', 'Female', '1990-12-03', 'Full Time', 'Accountant', '2021-07-22', 'Monthly', '2025-04-18'),
(13, 'Matthew', 'Paul', 'Gonzalez', 'Male', '1987-06-19', 'Part Time', 'Web Developer', '2022-01-15', 'Bi-Weekly', '2025-04-18'),
(14, 'Elizabeth', 'Rose', 'Wilson', 'Female', '1989-02-27', 'Full Time', 'Sales Manager', '2020-08-11', 'Monthly', '2025-04-18'),
(15, 'Andrew', 'Joseph', 'Anderson', 'Male', '1985-09-14', 'Full Time', 'DevOps Engineer', '2019-11-30', 'Monthly', '2025-04-18'),
(16, 'Stephanie', 'Kay', 'Thomas', 'Female', '1992-07-08', 'Freelance', 'UI/UX Designer', '2021-09-25', 'Weekly', '2025-04-18'),
(17, 'James', 'Edward', 'Taylor', 'Male', '1983-04-21', 'Full Time', 'CTO', '2018-01-05', 'Monthly', '2025-04-18'),
(18, 'Nicole', 'Renee', 'Moore', 'Female', '1988-11-30', 'Part Time', 'Social Media Manager', '2020-10-17', 'Weekly', '2025-04-18'),
(20, 'Lauren', '', 'White', 'Female', '1991-03-07', 'Full Time', 'Product Manager', '2021-02-28', 'Monthly', '2025-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `employee_pay_heads`
--

CREATE TABLE `employee_pay_heads` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pay_head_id` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_pay_heads`
--

INSERT INTO `employee_pay_heads` (`id`, `employee_id`, `pay_head_id`, `amount`) VALUES
(1, 7, 1, 2000.00),
(2, 7, 12, 22000.00),
(3, 8, 2, 1000.00),
(4, 8, 1, 20000.00),
(5, 8, 12, 3000.00);

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `pay_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Issued') DEFAULT 'Pending',
  `total_earnings` decimal(12,2) DEFAULT 0.00,
  `total_deductions` decimal(12,2) DEFAULT 0.00,
  `net_pay` decimal(12,2) DEFAULT 0.00,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `employee_id`, `pay_date`, `status`, `total_earnings`, `total_deductions`, `net_pay`, `notes`) VALUES
(1, 7, '2025-04-22 22:41:18', 'Issued', 2000.00, 22000.00, -20000.00, 'Sugapa Gobyerno'),
(2, 8, '2025-04-22 22:42:08', 'Issued', 21000.00, 3000.00, 18000.00, 'GoodJob');

-- --------------------------------------------------------

--
-- Table structure for table `pay_head`
--

CREATE TABLE `pay_head` (
  `pay_head_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  `type` enum('Earnings','Deductions') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pay_head`
--

INSERT INTO `pay_head` (`pay_head_id`, `name`, `description`, `type`) VALUES
(1, 'Basic Salary', 'Regular monthly salary', 'Earnings'),
(2, 'Overtime Pay', 'Payment for extra hours worked', 'Earnings'),
(3, 'Performance Bonus', 'Annual performance-based bonus', 'Earnings'),
(4, 'Housing Allowance', 'Monthly housing subsidy', 'Earnings'),
(5, 'Transportation Allowance', 'Monthly transportation subsidy', 'Earnings'),
(6, 'Meal Allowance', 'Daily meal subsidy', 'Earnings'),
(7, 'Attendance Bonus', 'Monthly bonus for perfect attendance', 'Earnings'),
(8, 'Year-End Bonus', 'Annual 13th month pay', 'Earnings'),
(9, 'SSS Contribution', 'Social Security System contribution', 'Deductions'),
(10, 'PhilHealth', 'National health insurance contribution', 'Deductions'),
(11, 'Pag-IBIG Fund', 'Home Development Mutual Fund contribution', 'Deductions'),
(12, 'Income Tax', 'Withholding tax on compensation', 'Deductions'),
(13, 'Late Deduction', 'Penalty for late arrivals', 'Deductions'),
(14, 'Absence Deduction', 'Penalty for unauthorized absences', 'Deductions'),
(15, 'Loan Payment', 'Salary deduction for company loans', 'Deductions');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_pay_heads`
--
ALTER TABLE `employee_pay_heads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`,`pay_head_id`),
  ADD KEY `pay_head_id` (`pay_head_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `pay_head`
--
ALTER TABLE `pay_head`
  ADD PRIMARY KEY (`pay_head_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee_pay_heads`
--
ALTER TABLE `employee_pay_heads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pay_head`
--
ALTER TABLE `pay_head`
  MODIFY `pay_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_pay_heads`
--
ALTER TABLE `employee_pay_heads`
  ADD CONSTRAINT `employee_pay_heads_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `employee_pay_heads_ibfk_2` FOREIGN KEY (`pay_head_id`) REFERENCES `pay_head` (`pay_head_id`);

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
