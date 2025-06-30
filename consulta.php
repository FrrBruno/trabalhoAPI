<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexao.php';
$con->set_charset("utf8");

$input = json_decode(file_get_contents('php://input'), true);
$idDescricao = isset($input['idDescricao']) ? trim($input['idDescricao']) : '';

$sql = "SELECT idCliente, idPrestador, idDescricao, idQntHrs, idQntPessoas, idMaterial
        FROM Cliente
        WHERE LOWER(idDescricao) LIKE LOWER(?)";

$stmt = $con->prepare($sql);
$likeParam = '%' . $idDescricao . '%';
$stmt->bind_param('s', $likeParam);

$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = array_map(fn($val) => mb_convert_encoding($val, 'UTF-8', 'ISO-8859-1'), $row);
    }
} else {
    $response[] = [
        "idCliente"     => 0,
        "idPrestador"   => "",
        "idDescricao"   => "",
        "idQntHrs"      => "",
        "idQntPessoas"  => "",
        "idMaterial"    => ""
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);

$stmt->close();
$con->close();

?>
