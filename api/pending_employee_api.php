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
        case 'GET':
            $pendingEmployees = $employee->getPendingEmployee();
            echo json_encode(["status" => "success", "pendingEmployees" => $pendingEmployees]);
            break;
        default:
            echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    }
?>