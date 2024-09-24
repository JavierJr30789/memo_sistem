<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

$json = file_get_contents('php://input');
$params = json_decode($json);

if ($params === null) {
    echo json_encode(['error' => 'No se recibieron datos o el formato es incorrecto']);
    exit;
}

include("conexion.php");

try {
    // Verificar si el grupo existe en la tabla grupousuario
    $stmt = $conn->prepare("SELECT idgrupo FROM grupousuario WHERE idgrupo = :IdGrupo");
    $stmt->bindParam(':IdGrupo', $params->IdGrupo);
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        echo json_encode(['resultado' => 'ERROR', 'mensaje' => 'El grupo especificado no existe']);
        exit;
    }

    // Verificar si la función existe en la tabla funciones
    $stmt = $conn->prepare("SELECT idfunciones FROM funciones WHERE idfunciones = :IdFunciones");
    $stmt->bindParam(':IdFunciones', $params->IdFunciones);
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        echo json_encode(['resultado' => 'ERROR', 'mensaje' => 'La función especificada no existe']);
        exit;
    }

    // Insertar el registro en la tabla grupofunciones
    $stmt = $conn->prepare("INSERT INTO grupofunciones (IdGrupo, IdFunciones, ver, insertar, modificar, borrar) VALUES (:IdGrupo, :IdFunciones, :ver, :insertar, :modificar, :borrar)");
    $stmt->bindParam(':IdGrupo', $params->IdGrupo);
    $stmt->bindParam(':IdFunciones', $params->IdFunciones);
    $stmt->bindParam(':ver', $params->ver);
    $stmt->bindParam(':insertar', $params->insertar);
    $stmt->bindParam(':modificar', $params->modificar);
    $stmt->bindParam(':borrar', $params->borrar);

    if ($stmt->execute()) {
        echo json_encode(['resultado' => 'OK', 'mensaje' => 'Datos grabados']);
    } else {
        echo json_encode(['resultado' => 'ERROR', 'mensaje' => 'No se pudo insertar los datos']);
    }
} catch (PDOException $e) {
    echo json_encode(['resultado' => 'ERROR', 'mensaje' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>
