<?php
function returnConnection() {
    $host = '10.10.0.62';
    $dbname = 'GestionMemo';
    $user = 'desarrollo';
    $pass = 'fisca1234';

    try {
        // Crear una instancia de PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Manejar errores de conexión
        echo json_encode(['error' => 'Error al conectar a la base de datos: ' . $e->getMessage()]);
        exit;
    }
}
?>