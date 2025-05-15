<?php

    class EmployeePayHeads{
        private $conn;
        private $table = "employee_pay_heads";

        public function __construct($db){
            $this->conn = $db;
        }

        public function addEmployeePayHeads($userId, $employeeId, $payrollDetailsId, $payHeadId, $amount){
            $query = "INSERT INTO " . $this->table . " (user_id, employee_id, payroll_details_id, pay_head_id, amount) VALUES (:userId, :employeeId, :payrollDetailsId, :payHeadId, :amount)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId, ":employeeId" => $employeeId, ":payrollDetailsId" => $payrollDetailsId, ":payHeadId" => $payHeadId, ":amount" => $amount]);
        }

        public function getSalaryByEarnings($userId, $employeeId, $payrollDetailsId){
            $query = "SELECT * FROM " . $this->table . " JOIN employees ON employee_pay_heads.employee_id = employees.employee_id JOIN pay_heads ON employee_pay_heads.pay_head_id = pay_heads.pay_head_id WHERE employee_pay_heads.user_id = :userId AND employee_pay_heads.employee_id = :employeeId AND employee_pay_heads.payroll_details_id = :payrollDetailsId AND pay_heads.type = 'Earnings'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId, ":employeeId" => $employeeId, ":payrollDetailsId" => $payrollDetailsId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getSalaryByDeductions($userId, $employeeId, $payrollDetailsId){
            $query = "SELECT * FROM " . $this->table . " JOIN employees ON employee_pay_heads.employee_id = employees.employee_id JOIN pay_heads ON employee_pay_heads.pay_head_id = pay_heads.pay_head_id WHERE employee_pay_heads.user_id = :userId AND employee_pay_heads.employee_id = :employeeId AND employee_pay_heads.payroll_details_id = :payrollDetailsId AND pay_heads.type = 'Deductions'";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId, ":employeeId" => $employeeId, ":payrollDetailsId" => $payrollDetailsId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>