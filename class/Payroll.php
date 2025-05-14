<?php
    class Payroll {
        private $conn;
        private $table = "payroll";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllDraftPayroll($userId){
            $query = "SELECT * FROM " . $this->table . " JOIN employees ON payroll.employee_id = employees.employee_id WHERE payroll.user_id = :userId AND payroll.status = 'Draft'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllPendingPayroll($userId){
            $query = "SELECT * FROM " . $this->table . " JOIN employees ON payroll.employee_id = employees.employee_id WHERE payroll.user_id = :userId AND payroll.status = 'Pending'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllIssuedPayroll($userId){
            $query = "SELECT * FROM payroll_details JOIN payroll ON payroll_details.payroll_id = payroll.payroll_id JOIN employees ON payroll.employee_id = employees.employee_id WHERE payroll.user_id = :userId AND payroll.status = 'Issued'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>