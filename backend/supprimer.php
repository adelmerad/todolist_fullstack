<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once 'config.php';
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input['id'])) {
        http_response_code(400);
        echo json_encode(["error" => "ID manquant"]);
        exit;
    }

    $id = (int)$input['id'];
    $query = "DELETE FROM taches WHERE id = $id";

    if (mysqli_query($con, $query)) {
        echo json_encode(["success" => true]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Échec de suppression"]);
    }
}
