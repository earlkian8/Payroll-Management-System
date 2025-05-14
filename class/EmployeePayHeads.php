<?php

    class EmployeePayHeads{
        private $conn;
        private $table = "employee_pay_heads";

        public function __construct($db){
            $this->conn = $db;
        }

        public function addEmployeePayHeads($userId, $employeeId, $payHeadId, $amount){
            $query = "INSERT INTO " . $this->table . " (user_id, employee_id, pay_head_id, amount) VALUES (:userId, :employeeId, :payHeadId, :amount)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId, ":employeeId" => $employeeId, ":payHeadId" => $payHeadId, ":amount" => $amount]);
        }
    }
?>