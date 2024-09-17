<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requestes-Whit, Content-Type, Accept');
header('Content-Type: application/json');
$json = file_get_contents('php://input');
$params = json_decode($json);

require("./conexicon.php");
$con = returnConection();
 $registro=mysqli_query($con ,"insert into usuario(NombreUsuario, Mail, Clave)
 values ('$params->NombreUsuario', '$params->Mail', '$params->Clave')");

class Result{}

$response = new Result();
$response->resultado = 'OK';
$response->mensaje ='Usuario Agregado';



echo json_encode($response);