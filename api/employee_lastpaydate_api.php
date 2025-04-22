<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Employee.php";

    $database = new Database();
    $conn = $database->getConnection();

    $employee = new Employee($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $updateEmployeeByLastPayDate = $employee->updateEmployeeByLastPayDate($data["lastPayDate"], $data["employeeId"]);
            echo json_encode(["status" => "success", "updateEmployeeByLastPayDate" => $updateEmployeeByLastPayDate]);
            break;
    }
?>