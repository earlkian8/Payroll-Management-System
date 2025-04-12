<?php
    
    include "database.php";
    include "../class/Employee.php";

    $database = new Database();
    $conn = $database->getConnection();

    $employee = new Employee($conn);

    $employees = $employee->getAllEmployees();
    echo json_encode(["status" => "success", "employees" => $employees]);
?>