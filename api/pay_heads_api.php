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


        case 'PUT':
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);


        case 'DELETE':
            $delData = file_get_contents("php://input");
            $data = json_decode($delData, true);
    }

?>