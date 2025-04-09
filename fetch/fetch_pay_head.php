<?php

    require_once "../db_connection.php";
    $database = new Database();
    $conn = $database->getConnection();

    $sql = "SELECT * FROM pay_head";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($employees);
?>