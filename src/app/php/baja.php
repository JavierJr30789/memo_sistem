<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  require("conexion.php");
  $conn=ReturnConnection();
  
  mysqli_query($conn,"delete FROM Usuarios WHERE IdUsuarios=$_GET[IdUsuarios]");
    
  
  class Result {}

  $response = new Result();
  $response->$resultado = 'OK';
  $response->$mensaje = 'articulo borrado';

  header('Content-Type: application/json');
  echo json_encode($response);  
?>