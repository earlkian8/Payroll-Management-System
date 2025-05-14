<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Contents: Content-Type");
    header("Content-Type: application/json");
    
    include "../config/database.php";
    include "../class/Payroll.php";

    $db = new Database();
    $conn = $db->getConnection();

    $payroll = new Payroll($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            if(isset($_GET["userId"])){
                $draftPayroll = $payroll->getAllDraftPayroll($_GET["userId"]);
                echo json_encode(["status" => "success", "draftPayroll" => $draftPayroll]);
                break;
            }
    }

?>