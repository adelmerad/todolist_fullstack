<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once __DIR__ . '/config.php'; // Chemin absolu
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['id']) || !isset($input['completed'])) {
    http_response_code(400);
    echo json_encode(["error" => "Données manquantes"]);
    exit;
}

$id = (int)$input['id'];
$completed = $input['completed'] ? 1 : 0;

mysqli_query($con, "UPDATE taches SET completed = $completed WHERE id = $id");

echo json_encode(["success" => true]);
