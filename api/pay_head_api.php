<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/PayHead.php";

    $database = new Database();
    $conn = $database->getConnection();

    $payHead = new PayHead($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET["payHeadId"])){
                $payHeadId = $payHead->getPayHeadById($_GET["payHeadId"]);
                echo json_encode(["status" => "success", "payHeadId" => $payHeadId]);
            }else{
                $payHeads = $payHead->getAllPayHead();
                echo json_encode(["status" => "success", "payHeads" => $payHeads]);
            }
            break;
        case 'POST':
            $postdata = file_get_contents("php://input");
            $data = json_decode($postdata, true);

            $addPayHead->addPayHead($data["name"], $data["description"], $data["type"]);
            echo json_encode(["status" => "success", "addPayHead" => $addPayHead]);
            break;
        case "PUT":
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);

            $updatePayHead->updatePayHead($data["savePayHeadId"], $data["saveName"], $data["saveDescription"], $data["saveType"]);
            echo json_encode(["status" => "success", "updatePayHead" => $updatePayHead]);
            break;
        case "DELETE":
            $delData = file_get_contents("php://input");
            $data = json_decode($delData, true);

            $deletePayHead->deletePayHead($data["deletePayHeadId"]);
            echo json_encode(["status" => "success", "deletePayHead" => $deletePayHead]);
            break;
    }
?>