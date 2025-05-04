<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

use Dom\Text;
header('Content-Type: application/json');
require_once __DIR__ . '/config.php'; // Chemin absolu
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()){
    die("echec de connexion a My SQL : " . mysqli_connect_errno());
}
$query = "SELECT id, text, completed FROM taches ORDER BY id DESC";
$results = mysqli_query($con,$query);

$taches = [];
while ($row = mysqli_fetch_assoc($results)){
    $taches[] = [
        'id' => (int)$row['id'],
        'text' => $row['text'],
        'completed' => (bool)$row['completed']
    ];
}

echo json_encode($taches);

