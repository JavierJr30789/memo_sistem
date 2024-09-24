<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

$json = file_get_contents('php://input');
$params = json_decode($json);

include("conexion.php");

if (isset($params->idGrupoFunciones) && isset($params->idGrupo) && isset($params->idFunciones) && isset($params->insertar) && isset($params->ver) && isset($params->modificar) && isset($params->borrar)) {
    try {
        $stmt = $conn->prepare("UPDATE grupofunciones SET idGrupo = :idGrupo, idFunciones = :idFunciones, insertar = :insertar, ver = :ver, modificar = :modificar, borrar = :borrar WHERE idGrupoFunciones = :idGrupoFunciones");
        $stmt->execute([
            ':idGrupo' => $params->idGrupo,
            ':idFunciones' => $params->idFunciones,
            ':insertar' => $params->insertar,
            ':ver' => $params->ver,
            ':modificar' => $params->modificar,
            ':borrar' => $params->borrar,
            ':idGrupoFunciones' => $params->idGrupoFunciones
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
