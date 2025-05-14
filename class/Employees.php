<?php
    class Employees {
        private $conn;
        private $table = "employees";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getAllEmployees($userId){
            $query = "SELECT * FROM " . $this->table . " WHERE user_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getEmployeeById($employeeId, $userId){
            $query = "SELECT * FROM " . $this->table . " WHERE employee_id = :employeeId AND user_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':employeeId' => $employeeId, ":userId" => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function addEmployee($userId, $firstName, $middleName, $lastName, $employmentType, $designation, $hireDate, $payFrequency){
            $query = "INSERT INTO employees (user_id, first_name, middle_name, last_name, employment_type, designation, hire_date, pay_frequency) VALUES (:userId, :firstName, :middleName, :lastName, :employmentType, :designation, :hireDate, :payFrequency)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":userId" => $userId, ":firstName" => $firstName, ":middleName" => $middleName, ":lastName" => $lastName, ":employmentType" => $employmentType, ":designation" => $designation, ":hireDate" => $hireDate, ":payFrequency" => $payFrequency]);
        }

        public function updateEmployee($employeeId, $userId, $firstName, $middleName, $lastName, $employmentType, $designation, $hireDate, $payFrequency){
            $query = "UPDATE " . $this->table . " SET first_name = :firstName, middle_name = :middleName, last_name = :lastName, employment_type = :employmentType, designation = :designation, hire_date = :hireDate, pay_frequency = :payFrequency WHERE employee_id = :employeeId AND user_id = :userId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":employeeId" => $employeeId, ":userId" => $userId, ":firstName" => $firstName, ":middleName" => $middleName, ":lastName" => $lastName, ":employmentType" => $employmentType, ":designation" => $designation, ":hireDate" => $hireDate, ":payFrequency" => $payFrequency]);
        }

        public function deleteEmployee($employeeId){
            $query = "DELETE FROM " . $this->table . " WHERE employee_id = :employeeId";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":employeeId" => $employeeId]);
        }
    }
?>