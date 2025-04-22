<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Employee.php";

    $database = new Database();
    $conn = $database->getConnection();

    $employee = new Employee($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET["employee_id"])){
                $employeeById = $employee->getEmployeeById($_GET["employee_id"]);
                echo json_encode(["status" => "success", "employeeById" => $employeeById]);
            }else{
                $employees = $employee->getAllEmployees();
                echo json_encode(["status" => "success", "employees" => $employees]);
            }
            break;
        case 'POST':
            $postdata = file_get_contents("php://input");
            $data = json_decode($postdata, true);
            
            $addEmployee = $employee->addEmployee(
            $data["firstName"],
            $data["middleName"],
            $data["lastName"],
            $data["gender"],
            $data["birthday"],
            $data["employmentType"],
            $data["designation"],
            $data["dateHired"],
            $data["payFrequency"]
            );
            echo json_encode(["status" => "success", "addEmployee" => $addEmployee]);
            break;
        case 'PUT':
            $putdata = file_get_contents("php://input");
            $data = json_decode($putdata, true);
            
            $updateEmployee = $employee->updateEmployee(
            $data["saveEmployeeId"],
            $data["saveFirstName"],
            $data["saveMiddleName"],
            $data["saveLastName"],
            $data["saveGender"],
            $data["saveBirthday"],
            $data["saveEmploymentType"],
            $data["saveDesignation"],
            $data["saveDateHired"],
            $data["savePayFrequency"]
            );
            echo json_encode(["status" => "success", "updateEmployee" => $updateEmployee]);
            break;
        case 'DELETE':
            $deleteData = file_get_contents("php://input");
            $data = json_decode($deleteData, true);

            $deleteEmployee = $employee->deleteEmployee($data["deleteEmployeeId"]);
            echo json_encode(["status" => "success", "deleteEmployee" => $deleteEmployee]);
        default:
            echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    }
?>