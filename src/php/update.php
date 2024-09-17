<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requestes-Whit, Content-Type, Accept');

$json = file_get_contents('php://input');
$params = json_decode($json);
require("conexion.php");
$con = returnConection();

mysqli_query($con ,"update usuario set NombreUsuario='$params->NombreUsuario',
Mail='$params->Mail',
Clave='$params->Clave'
where IdUsuarios=$params->IdUsuarios");

class Result{}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje = 'usuario modificado';


header('Content-Type: application/json');
echo json_encode($response);