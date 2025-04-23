<?php

    include "database.php";
    include "../class/EmployeePayHeads.php";

    $database = new Database();
    $conn = $database->getConnection();

    $employeePayHead = new EmployeePayHeads($conn);
    $employeeId = $_GET["employeeId"] ?? NULL;
    
    $employeePayHeadsById = $employeePayHead->getEmployeePayHeadsByIdEarnings($employeeId);
    echo json_encode(["status" => "success", "employeePayHeadsById" => $employeePayHeadsById]);

?>