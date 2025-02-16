<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$conn = getDBConnection();

if (!isset($_GET["precio"])) {
    echo json_encode(["error" => "No se recibio el codigo"]);
    exit;
}

$precio = trim($_GET["precio"]);

// Validación de formato
if (strlen($precio) === 0) {
    echo json_encode(["error" => "Este campo no debe quedar en blanco"]);
    exit;
}

if (!preg_match("/^\d+(\.\d{1,2})?$/", $precio)) {
    echo json_encode(["error" => "Solo se permiten nros positivo con hasta dos decimales"]);
    exit;
}

echo json_encode(["estado" => true, "valor" => $precio]);
?>