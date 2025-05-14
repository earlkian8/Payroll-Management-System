<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");
    
    include "../config/database.php";
    include "../class/EmployeePayHeads.php";

    $db = new Database();
    $conn = $db->getConnection();

    $e = new EmployeePayHeads($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            break;
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            if (isset($data['payHeads']) && is_array($data['payHeads'])) {
                $response = [];
                foreach ($data['payHeads'] as $payHead) {
                    $result = $e->addEmployeePayHeads(
                        $data["userId"],
                        $data["employeeId"],
                        $payHead["payHeadId"],
                        $payHead["amount"]
                    );
                    $response[] = $result;
                }
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Pay heads added successfully',
                    'results' => $response
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid pay heads data'
                ]);
            }
            break;
    }
?>