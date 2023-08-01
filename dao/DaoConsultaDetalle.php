<?php

include_once('db.php');

$TipoEncargado=$_GET['tipoEncargado'];

Contador($TipoEncargado);

function Contador($TipoEncargado){
	$con = new LocalConector();
	$conex=$con->conectar();
	
	if($TipoEncargado==1){
	    $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ConfirmacionEncargado` = '1' and ConfirmacionControlling = 0  and ConfirmacionEhs not like '2' and ConfirmacionEncargado not like '2' and ConfirmacionPlant not like '2';");
	}
	if($TipoEncargado==2){
	    $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ConfirmacionEncargado` = '1' and ConfirmacionEhs = 0 and ConfirmacionControlling not like '2' and ConfirmacionEncargado not like '2' and ConfirmacionPlant not like '2';");
	}
	if($TipoEncargado==3){
	    $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ConfirmacionEncargado` = '1' and ConfirmacionPlant = 0  and ConfirmacionEhs not like '2' and ConfirmacionEncargado not like '2' and ConfirmacionControlling not like '2';");
	}
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>