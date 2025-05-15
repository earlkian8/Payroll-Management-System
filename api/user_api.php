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
    case 'GET':
        // if(isset($_GET["userId"])){
        //     $userData = $user->getUserById($_GET["userId"]);
        //     echo json_encode(["status" => "success", "userData" => $userData]);
        //     break;
        // }
        if(isset($_GET["email"])){
            $userData = $user->getUserByEmail($_GET["email"]);
            if ($userData) {
                echo json_encode(["status" => "success", "userData" => $userData]);
            } else {
                echo json_encode(["status" => "error", "message" => "User not found"]);
            }
            break;
        }
        echo json_encode(["status" => "error", "message" => "Missing parameters"]);
        break;
    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $user->addUser($data["email"], $data["password"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>