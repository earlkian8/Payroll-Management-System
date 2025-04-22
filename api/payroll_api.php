<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Payroll.php";

    $database = new Database();
    $conn = $database->getConnection();

    $payroll = new Payroll($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $addPayroll = $payroll->addPayroll($data["employeeId"], $data["payDate"], $data["status"], $data["totalEarnings"], $data["totalDeductions"], $data["netPay"], $data["notes"]);
            echo json_encode(["status" => "success", "addPayroll" => $addPayroll]);
            break;
    }
?>