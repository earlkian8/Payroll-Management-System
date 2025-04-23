<?php

    include "database.php";
    include "../class/Employee.php";

    $database = new Database();
    $conn = $database->getConnection();

    $employee = new Employee($conn);
    $employeeId = $_GET["employeeId"] ?? NULL;
    
    $getIssuedEmployeeById = $employee->getIssuedEmployeeById($employeeId);
    echo json_encode(["status" => "success", "getIssuedEmployeeById" => $getIssuedEmployeeById]);

?>