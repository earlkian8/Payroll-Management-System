<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");

    include 'database.php';

    $database = new Database();
    $db = $database->getConnection();

    if($db){
        echo json_encode(["status" => "success"]);
    }else{
        echo json_encode(["status" => "failed"]);
    }

?>