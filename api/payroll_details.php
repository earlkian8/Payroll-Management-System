<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");
    
    include "../config/database.php";
    include "../class/PayrollDetails.php";

    $db = new Database();
    $conn = $db->getConnection();

    $p = new PayrollDetails($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            break;
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $id = $p->addPayrollDetails($data["payrollId"], $data["userId"], $data["totalEarnings"], $data["totalDeductions"], $data["netPay"], $data["notes"]);
            echo json_encode(["status" => "success", "id" => $id]);
            break;
    }
?>