<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/EmployeePayHeads.php";

    $database = new Database();
    $conn = $database->getConnection();

    $employeePayHead = new EmployeePayHeads($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $addEmployeePayHeads = $employeePayHead->addEmployeePayHeads($data["employeeId"], $data["payHeadId"], $data["amount"]);
            echo json_encode(["status" => "success", "addEmployeePayHeads" => $addEmployeePayHeads]);
            break;
    }
?>