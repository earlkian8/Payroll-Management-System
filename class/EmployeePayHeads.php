<?php
    class EmployeePayHeads{
        private $conn;
        private $table = "employee_pay_heads";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getEmployeePayHeadsByIdEarnings($id){
            $query = "SELECT * FROM " . $this->table . " JOIN pay_head ON employee_pay_heads.pay_head_id = pay_head.pay_head_id WHERE employee_id = :id AND pay_head.type = 'Earnings'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getEmployeePayHeadsByIdDeductions($id){
            $query = "SELECT * FROM " . $this->table . " JOIN pay_head ON employee_pay_heads.pay_head_id = pay_head.pay_head_id WHERE employee_id = :id AND pay_head.type = 'Deductions'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function addEmployeePayHeads($employeeId, $payHeadId, $amount){
            $query = "INSERT INTO " . $this->table . " (employee_id, pay_head_id, amount) VALUES (:employeeId, :payHeadId, :amount)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":employeeId" => $employeeId, ":payHeadId" => $payHeadId, ":amount" => $amount]);
        }
    }
?>