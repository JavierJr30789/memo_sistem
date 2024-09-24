<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');

  include("conexion.php");

  if (isset($_GET['idFunciones'])) {
      $idFunciones = $_GET['idFunciones'];

      try {
          $stmt = $conn->prepare("DELETE FROM funciones WHERE idFunciones = :idFunciones");
          $stmt->bindParam(':idFunciones', $idFunciones);

          if ($stmt->execute()) {
              $response = ['resultado' => 'OK', 'mensaje' => 'Función borrada'];
          } else {
              $response = ['resultado' => 'ERROR', 'mensaje' => 'Error al borrar función'];
          }
      } catch (PDOException $e) {
          $response = ['resultado' => 'ERROR', 'mensaje' => 'Error en la base de datos: ' . $e->getMessage()];
      }

  } else {
      $response = ['resultado' => 'ERROR', 'mensaje' => 'Falta el parámetro idFunciones'];
  }

  header('Content-Type: application/json');
  echo json_encode($response);
?>
