
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
    $stmt = $conn->prepare("SELECT idgrupo FROM grupousuario WHERE idgrupo = :grupo");
    $stmt->bindParam(':grupo', $params->grupo);
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        echo json_encode(['resultado' => 'ERROR', 'mensaje' => 'El grupo especificado no existe']);
        exit;
    }

    // Insertar el usuario en la tabla usuarios
    $stmt = $conn->prepare("INSERT INTO usuarios (NombreUsuario, Mail, Clave, grupo) VALUES (:NombreUsuario, :Mail, :Clave, :grupo)");
    $stmt->bindParam(':NombreUsuario', $params->NombreUsuario);
    $stmt->bindParam(':Mail', $params->Mail);
    $stmt->bindParam(':Clave', $params->Clave);
    $stmt->bindParam(':grupo', $params->grupo);

    if ($stmt->execute()) {
        echo json_encode(['resultado' => 'OK', 'mensaje' => 'Datos grabados']);
    } else {
        echo json_encode(['resultado' => 'ERROR', 'mensaje' => 'No se pudo insertar los datos']);
    }
} catch (PDOException $e) {
    echo json_encode(['resultado' => 'ERROR', 'mensaje' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>
