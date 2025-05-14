<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Contents: Content-Type");
    header("Content-Type: application/json");
    
    include "../config/database.php";
    include "../class/PayHeads.php";

    $db = new Database();
    $conn = $db->getConnection();

    $payHead = new PayHeads($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            if(isset($_GET["userId"])){
                $payHeads = $payHead->getAllPayHeads($_GET["userId"]);
                echo json_encode(["status" => "success", "payHeads" => $payHeads]);
                break;
            }
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $payHead->addPayHead($data["userId"], $data["name"], $data["description"], $data["type"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'PUT':
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);

            $payHead->updatePayHead($data["payHeadId"], $data["userId"], $data["name"], $data["description"], $data["type"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'DELETE':
            $delData = file_get_contents("php://input");
            $data = json_decode($delData, true);

            $payHead->deletePayHead($data["payHeadId"]);
            echo json_encode(["status" => "success"]);
            break;
    }

?>