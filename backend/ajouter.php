<?php

use Dom\Text;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'config.php';
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $input = json_decode(file_get_contents('php://input'),true); 


if (!isset($input['text']) || trim($input['text']) ===''){
    http_response_code(400);
    echo json_encode(["error" =>"champ vide"]);
    exit;
}

    $text = mysqli_real_escape_string($con, $input['text']);
    mysqli_query($con, "INSERT INTO taches (text, completed) VALUES ('$text', 0)");
    echo json_encode([
        "success" => true,
        "id" => mysqli_insert_id($con)
    ]);
}
