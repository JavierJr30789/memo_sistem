<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

$json = file_get_contents('php://input');
$params = json_decode($json);

include("conexion.php");

if (isset($params->idGrupo) && isset($params->descripcion)) {
    try {
        $stmt = $conn->prepare("UPDATE grupousuario SET descripcion = :descripcion WHERE idGrupo = :idGrupo");
        $stmt->execute([
            ':descripcion' => $params->descripcion,
            ':idGrupo' => $params->idGrupo
        ]);

        $response = array("resultado" => "OK", "mensaje" => "Datos modificados");
    } catch (PDOException $e) {
        error_log("Error en la actualización: " . $e->getMessage());
        $response = array("resultado" => "ERROR", "mensaje" => "Error en la actualización: " . $e->getMessage());
    }
} else {
    $response = array("resultado" => "ERROR", "mensaje" => "Datos incompletos");
}

header('Content-Type: application/json');
echo json_encode($response);
?>