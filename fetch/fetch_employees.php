<?php

    require_once "../db_connection.php";
    $database = new Database();
    $conn = $database->getConnection();

    $sql = "SELECT employee_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name, first_name, middle_name, last_name, gender, birthday, employment_type, designation, salary, overtime_pay, time_in, time_out, date_hired FROM employees";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($employees);
?>