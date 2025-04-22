<?php
    class Payroll{
        private $conn;
        private $table = "payroll";

        public function __construct($db){
            $this->conn = $db;
        }

        public function addPayroll($employeeId, $payDate, $status, $totalEarnings, $totalDeductions, $netPay, $notes){
            $query = "INSERT INTO " . $this->table . " (employee_id, pay_date, status, total_earnings, total_deductions, net_pay, notes) VALUES (:employeeId, :payDate, :status, :totalEarnings, :totalDeductions, :netPay, :notes)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":employeeId" => $employeeId, ":payDate" => $payDate, ":status" => $status, ":totalEarnings" => $totalEarnings, ":totalDeductions" => $totalDeductions, ":netPay" => $netPay, ":notes" => $notes]);
        }
    }
?>