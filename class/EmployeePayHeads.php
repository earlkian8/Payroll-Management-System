<?php
    class EmployeePayHeads{
        private $conn;
        private $table = "employee_pay_heads";

        public function __construct($db){
            $this->conn = $db;
        }

        public function addEmployeePayHeads($employeeId, $payHeadId, $amount){
            $query = "INSERT INTO " . $this->table . " (employee_id, pay_head_id, amount) VALUES (:employeeId, :payHeadId, :amount)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":employeeId" => $employeeId, ":payHeadId" => $payHeadId, ":amount" => $amount]);
        }
    }
?>