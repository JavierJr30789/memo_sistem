<?php 
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require("conexion.php");

$registros = mysqli_query($con, "SELECT idGrupoFunciones, idGrupo, idFunciones, insertar, ver, modificar, borrar FROM grupofunciones WHERE idGrupoFunciones=$_GET[codigo]");

if ($reg = mysqli_fetch_array($registros)) {
    $vec[] = $reg;
}

$cad = json_encode($vec);
echo $cad;
header('Content-Type: application/json');
?>
