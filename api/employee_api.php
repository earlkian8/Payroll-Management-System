<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Contents: Content-Type");
    header("Content-Type: application/json");
    
    include "../config/database.php";
    include "../class/Employees.php";

    $db = new Database();
    $conn = $db->getConnection();

    $employee = new Employees($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            if(isset($_GET["userId"])){
                $employees = $employee->getAllEmployees($_GET["userId"]);
                echo json_encode(["status" => "success", "employees" => $employees]);
                break;
            }
        case 'POST':
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);

            $employee->addEmployee($data["userId"], $data["firstName"], $data["middleName"], $data["lastName"], $data["employmentType"], $data["designation"], $data["hireDate"], $data["payFrequency"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'PUT':
            $putData = file_get_contents("php://input");
            $data = json_decode($putData, true);

            $employee->updateEmployee($data["employeeId"], $data["userId"], $data["firstName"], $data["middleName"], $data["lastName"], $data["employmentType"], $data["designation"], $data["hireDate"], $data["payFrequency"]);
            echo json_encode(["status" => "success"]);
            break;
        case 'DELETE':
            $delData = file_get_contents("php://input");
            $data = json_decode($delData, true);

            $employee->deleteEmployee($data["employeeId"]);
            echo json_encode(["status" => "success"]);
            break;
    }

?>