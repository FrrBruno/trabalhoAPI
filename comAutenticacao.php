<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set content type
header('Content-Type: application/json');

// Include the shared DB connection
require_once 'conexao.php';
$con->set_charset("utf8");

// Get JSON input
$jsonParam = json_decode(file_get_contents('php://input'), true);

if (!$jsonParam) {
    echo json_encode(['success' => false, 'message' => 'Dados JSON inválidos ou ausentes.']);
    exit;
}

// Extract and validate data
$idPrestadpr   = trim($jsonParam['idPrestadpr'] ?? '');
$idDescricao   = trim($jsonParam['idDescricao'] ?? '');
$idQntHrs      = trim($jsonParam['idQntHrs'] ?? '');
$idQntPessoas  = trim($jsonParam['idQntPessoas'] ?? '');
$idMaterial    = trim($jsonParam['idMaterial'] ?? '');

// Validate required fields
if (empty($idPrestadpr) || empty($idDescricao) || empty($idQntHrs) || empty($idQntPessoas) || empty($idMaterial)) {
    echo json_encode(['success' => false, 'message' => 'Campos obrigatórios ausentes.']);
    exit;
}

// Prepare and bind
$stmt = $con->prepare("
    INSERT INTO Cliente (idPrestadpr, idDescrição, idQntHrs, idQntPessoas, idMaterial)
    VALUES (?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $con->error]);
    exit;
}

$stmt->bind_param("sssss", $idPrestadpr, $idDescricao, $idQntHrs, $idQntPessoas, $idMaterial);

// Execute and return result
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cliente inserido com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro no registro do cliente: ' . $stmt->error]);
}

$stmt->close();
$con->close();

?>
