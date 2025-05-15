<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");
    
    include "../config/database.php";
    include "../class/Employees.php";
    include "../class/PayHeads.php";
    include "../class/PayrollDetails.php";

    $db = new Database();
    $conn = $db->getConnection();

    $p = new PayrollDetails($conn);
    $e = new Employees($conn);
    $pH = new PayHeads($conn);

    $method = $_SERVER["REQUEST_METHOD"];

    switch($method){
        case 'GET':
            $payrollDetails = $p->getTotalPayrollDetails($_GET["userId"]);
            $employees = $e->getTotalEmployee($_GET["userId"]);
            $payHeads = $pH->getTotalPayHeads($_GET["userId"]);
            $recentPayroll = $p->getRecentPayroll($_GET["userId"]);
            echo json_encode(["status" => "success", "payrollDetails" => $payrollDetails, "employees" => $employees, "payHeads" => $payHeads, "recentPayroll" => $recentPayroll]);
            break;
    }
?>