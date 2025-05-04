<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once __DIR__ . '/config.php'; // Chemin absolu
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['id']) || !isset($input['text'])) {
    http_response_code(400);
    echo json_encode(value: ["error" => "Données manquantes"]);
    exit;
}

$id = (int)$input['id'];
$text = mysqli_real_escape_string($con, $input['text']);

mysqli_query($con, "UPDATE taches SET text = '$text' WHERE id = $id");

echo json_encode(["success" => true]);
