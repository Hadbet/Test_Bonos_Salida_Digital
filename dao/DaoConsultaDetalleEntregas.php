<?php

include_once('db.php');

$TipoEncargado=$_GET['tipoEncargado'];

Contador($TipoEncargado);

function Contador($TipoEncargado){
	$con = new LocalConector();
	$conex=$con->conectar();
	$datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ConfirmacionPlant`='1' and `ConfirmacionControlling` = '1' and `ConfirmacionEhs`='1' and `ConfirmacionEncargado`= '1' and `ConfirmacionVigilancia` = '1' and `TipoRetorno` = 'Si' and `ImagenEntrega` =''");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>