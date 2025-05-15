<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include "../config/database.php";
include "../class/Users.php";

$db = new Database();
$conn = $db->getConnection();

$user = new Users($conn);

$method = $_SERVER["REQUEST_METHOD"];

switch($method){
    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $user->updateUserPassword($data["email"], $data["password"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>