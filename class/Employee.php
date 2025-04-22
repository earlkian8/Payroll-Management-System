<?php
    class Employee{
        private $conn;
        private $table = "employees";

        public function __construct($db){
            $this->conn = $db;
        }

        public function getEmployeeById($id){
            $query = "SELECT * FROM " . $this->table . " WHERE employee_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getAllEmployees(){
            $query = "SELECT * FROM " . $this->table . " ORDER BY employee_id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addEmployee($firstName, $middleName, $lastName, $gender, $birthday, $employmentType, $designation, $dateHired, $payFrequency){
            $query = "INSERT INTO " . $this->table . " (first_name, middle_name, last_name, gender, birthday, employment_type, designation, date_hired, pay_frequency) VALUES (:firstName, :middleName, :lastName, :gender, :birthday, :employmentType, :designation, :dateHired, :payFrequency)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":firstName" => $firstName, ":middleName" => $middleName, ":lastName" => $lastName, ":gender" => $gender, ":birthday" => $birthday, ":employmentType" => $employmentType, ":designation" => $designation, ":dateHired" => $dateHired, ":payFrequency" => $payFrequency]);
        }

        public function updateEmployee($id, $firstName, $middleName, $lastName, $gender, $birthday, $employmentType, $designation, $dateHired, $payFrequency){
            $query = "UPDATE " . $this->table . " SET first_name = :firstName, middle_name = :middleName, last_name = :lastName, gender = :gender, birthday = :birthday, employment_type = :employmentType, designation = :designation, date_hired = :dateHired, pay_frequency = :payFrequency WHERE employee_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id, ":firstName" => $firstName, ":middleName" => $middleName, ":lastName" => $lastName, ":gender" => $gender, ":birthday" => $birthday, ":employmentType" => $employmentType, ":designation" => $designation, ":dateHired" => $dateHired, ":payFrequency" => $payFrequency]);
        }
        
        public function deleteEmployee($id){
            $query = "DELETE FROM " . $this->table . " WHERE employee_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":id" => $id]);
        }

        public function getPendingEmployee(){
            $query = "SELECT * FROM " . $this->table . " WHERE (
                        (pay_frequency = 'Monthly' AND DATEDIFF(CURDATE(), last_pay_date) >= 30)
                        OR (pay_frequency = 'Bi-Weekly' AND DATEDIFF(CURDATE(), last_pay_date) >= 14)
                        OR (pay_frequency = 'Weekly' AND DATEDIFF(CURDATE(), last_pay_date) >= 7)
                        )";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function updateEmployeeByLastPayDate($lastPayDate, $id){
            $query = "UPDATE " . $this->table . " SET last_pay_date = :lastPayDate WHERE employee_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([":lastPayDate" => $lastPayDate, ":id" => $id]);
        }

        public function getIssuedEmployee(){
            $query = "SELECT * FROM payroll JOIN " . $this->table . " ON payroll.employee_id = employees.employee_id WHERE payroll.status = 'Issued' ORDER BY employees.employee_id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>