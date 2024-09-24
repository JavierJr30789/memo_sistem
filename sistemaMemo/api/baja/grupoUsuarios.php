<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS');

  include("conexion.php");

  if (isset($_GET['idGrupo'])) {
      $idGrupo = $_GET['idGrupo'];

      try {
          $stmt = $conn->prepare("DELETE FROM grupousuario WHERE idGrupo = :idGrupo");
          $stmt->bindParam(':idGrupo', $idGrupo);

          if ($stmt->execute()) {
              $response = ['resultado' => 'OK', 'mensaje' => 'Grupo borrado'];
          } else {
              $response = ['resultado' => 'ERROR', 'mensaje' => 'Error al borrar grupo'];
          }
      } catch (PDOException $e) {
          $response = ['resultado' => 'ERROR', 'mensaje' => 'Error en la base de datos: ' . $e->getMessage()];
      }

  } else {
      $response = ['resultado' => 'ERROR', 'mensaje' => 'Falta el parámetro idGrupo'];
  }

  header('Content-Type: application/json');
  echo json_encode($response);
?>
