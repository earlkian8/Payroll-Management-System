<?php

    class PayrollDetails{
        private $conn;
        private $table = "payroll_details";

        public function __construct($db){
            $this->conn = $db;
        }

        public function addPayrollDetails($payrollId, $userId, $totalEarnings, $totalDeductions, $netPay, $notes){
            $query = "INSERT INTO " . $this->table . " (payroll_id, user_id, total_earnings, total_deductions, net_pay, notes) VALUES (:payrollId, :userId, :totalEarnings, :totalDeductions, :netPay, :notes)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":payrollId" => $payrollId, ":userId" => $userId, ":totalEarnings" => $totalEarnings, ":totalDeductions" => $totalDeductions, ":netPay" => $netPay, ":notes" => $notes]);
            return $this->conn->lastInsertId();
        }

        public function getTotalPayrollDetails($userId){
            $query = "SELECT count(payroll_details_id) as pCount FROM " . $this->table . " JOIN payroll ON payroll_details.payroll_id = payroll.payroll_id  WHERE payroll_details.user_id = :id AND MONTH(payroll.pay_date) = MONTH(CURRENT_DATE()) AND YEAR(payroll.pay_date) = YEAR(CURRENT_DATE())";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getSalary($userId, $employeeId){
            $query = "SELECT * FROM " . $this->table . " JOIN payroll ON payroll_details.payroll_id = payroll.payroll_id JOIN employees ON payroll.employee_id = employees.employee_id WHERE payroll_details.user_id = :userId AND payroll.employee_id = :employeeId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId, ":employeeId" => $employeeId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getRecentPayroll($userId){
            $query = "SELECT * FROM " . $this->table . " JOIN payroll ON payroll_details.payroll_id = payroll.payroll_id JOIN employees ON payroll.employee_id = employees.employee_id WHERE payroll_details.user_id = :userId ORDER BY payroll_details.payroll_details_id DESC LIMIT 10";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>