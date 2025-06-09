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
$idNome        = trim($jsonParam['idNome'] ?? '');
$idPrestador   = trim($jsonParam['idPrestador'] ?? '');
$idDescricao   = trim($jsonParam['idDescricao'] ?? '');
$idQntHrs      = trim($jsonParam['idQntHrs'] ?? '');
$idQntPessoas  = trim($jsonParam['idQntPessoas'] ?? '');
$idMaterial    = trim($jsonParam['idMaterial'] ?? '');
$idData        = trim($jsonParam['idData'] ?? '');

// Basic validation (you can improve this)
if (!$idNome || !$idPrestador || !$idDescricao || !$idQntHrs || !$idQntPessoas || !$idMaterial || !$idData) {
    echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
    exit;
}

// Prepare statement
$stmt = $con->prepare("
    INSERT INTO Cliente (idNome, idPrestador, idDescrição, idQntHrs, idQntPessoas, idMaterial, idData)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Erro ao preparar a consulta: ' . $con->error]);
    exit;
}

// Bind parameters (all are VARCHARs = "s")
$stmt->bind_param("sisssss", $idNome, $idPrestador, $idDescricao, $idQntHrs, $idQntPessoas, $idMaterial, $idData);

// Execute and return result
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Cliente inserido com sucesso!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro no registro do cliente: ' . $stmt->error]);
}

$stmt->close();
$con->close();

?>
