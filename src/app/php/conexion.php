<?php 

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json; charset=UTF-8");

// Dates de la conexión a la base de datos
function ReturnConnection(){

  $host= "10.10.0.62";
  
  $db_name="GestionMemo";
  
  $username = "desarrollo";
  
  $password = "fisca1234";

  $conn = new mysqli($host, $db_name, $username, $password);


    // Verificar si hay algún error en la conexión
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  // consulta SQL
  
  $query = "SELECT * FROM Usuarios";
  
  $stmt= $conn->prepare($query);
  
  $stmt->execute();
  
  // crean un array para almacenar los resultados
  
  $datos = array();
  
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $datos [] = $row;
  }
  
  echo json_encode($datos);

  return $conn;

};
?>