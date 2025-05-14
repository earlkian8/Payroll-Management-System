<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Contents: Content-Type");
    header("Content-Type: application/json");
    
    session_start();
    include "../config/database.php";

    $db = new Database();
    $conn = $db->getConnection();
    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            echo json_encode(["status" => "success", "userId" => $_SESSION["userId"]]);
            break;
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $_SESSION["userId"] = $data["userId"];
            echo json_encode(["status" => "success"]);
            break;
    }

?>