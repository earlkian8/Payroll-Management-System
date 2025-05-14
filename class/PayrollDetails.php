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
        }
    }
?>