<?php 
  header('Access-Control-Allow-Origin: *'); 
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  
  $json = file_get_contents('php://input');
 
  $params = json_decode($json);
  
  require("conexion.php");
  $conn=ReturnConnection();
  

  mysqli_query($conn,"insert into Usuarios (NombreUsuario, Mail, Clave) values 
  ('$params->NombreUsuario','$params->Mail','$params->Clave')");
    
  
  class Result {}

  $response = new Result();
  $response->$resultado = 'OK';
  $response->$mensaje = 'Usuario Agregado';

  header('Content-Type: application/json');
  echo json_encode($response);  
?> 