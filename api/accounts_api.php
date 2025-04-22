<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "database.php";
include "../class/Accounts.php";

$database = new Database();
$conn = $database->getConnection();

$accounts = new Accounts($conn);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'POST':
        $postdata = file_get_contents("php://input");
        $data = json_decode($postdata, true);

        $addAccount = $accounts->addAccount($data["email"], $data["password"]);
        echo json_encode(["status" => "success", "addAccount" => $addAccount]);
        break;
}
?>