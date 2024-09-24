<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');

  include("conexion.php");

  if (isset($_GET['idGrupoFunciones'])) {
      $idGrupoFunciones = $_GET['idGrupoFunciones'];

      try {
          $stmt = $conn->prepare("DELETE FROM grupofunciones WHERE idGrupoFunciones = :idGrupoFunciones");
          $stmt->bindParam(':idGrupoFunciones', $idGrupoFunciones);

          if ($stmt->execute()) {
              $response = ['resultado' => 'OK', 'mensaje' => 'Grupo de funciones borrado'];
          } else {
              $response = ['resultado' => 'ERROR', 'mensaje' => 'Error al borrar grupo de funciones'];
          }
      } catch (PDOException $e) {
          $response = ['resultado' => 'ERROR', 'mensaje' => 'Error en la base de datos: ' . $e->getMessage()];
      }

  } else {
      $response = ['resultado' => 'ERROR', 'mensaje' => 'Falta el parámetro idGrupoFunciones'];
  }

  header('Content-Type: application/json');
  echo json_encode($response);
?>
