<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Contents: Content-Type");
    header("Content-Type: application/json");
    
    include "../config/database.php";
    include "../class/PayrollDetails.php";
    include "../class/EmployeePayHeads.php";

    $db = new Database();
    $conn = $db->getConnection();

    $p = new PayrollDetails($conn);
    $e = new EmployeePayHeads($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            if(isset($_GET["userId"])){
                $earnings = $e->getSalaryByEarnings($_GET["userId"], $_GET["employeeId"], $_GET["payrollDetailsId"]);
                $deductions = $e->getSalaryByDeductions($_GET["userId"], $_GET["employeeId"], $_GET["payrollDetailsId"]);
                echo json_encode(["status" => "success", "earnings" => $earnings, "deductions" => $deductions]);
                break;
            }
    }

?>