<?php
    class Payroll{
        private $conn;
        private $table = "payroll";

        public function __construct($db){
            $this->conn = $db;
        }

        public function addPayroll($employeeId, $status, $totalEarnings, $totalDeductions, $netPay, $notes){
            $query = "INSERT INTO " . $this->table . " (employee_id, status, total_earnings, total_deductions, net_pay, notes) VALUES (:employeeId, :status, :totalEarnings, :totalDeductions, :netPay, :notes)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":employeeId" => $employeeId, ":status" => $status, ":totalEarnings" => $totalEarnings, ":totalDeductions" => $totalDeductions, ":netPay" => $netPay, ":notes" => $notes]);
        }
    }
?>