<?php

include_once('db.php');

incidencias();


function incidencias(){
	$con = new LocalConector();
	$conex=$con->conectar();
	
	$datos = mysqli_query($conex, "SELECT `IdBitacora`,`NombreSolicitante`,`Area`,`FechaRegistro`,CONCAT('<a href=\"https://arketipo.mx/Controlling/BonoSalida/ConsultaBono.html?0eb20346=',`ImagenRegistro`,'\" class=\"btn btn-primary\">Entrar</a>') as boton,CASE 
    WHEN `ConfirmacionPlant` = 2 
         OR `ConfirmacionControlling` = 2 
         OR `ConfirmacionEhs` = 2 
         OR `ConfirmacionEncargado` = 2 
         OR `ConfirmacionVigilancia` = 2 
    THEN '<span class=\"label label-danger\">Rechazado</span>'
    WHEN `ConfirmacionPlant` = 1 
         AND `ConfirmacionControlling` = 1 
         AND `ConfirmacionEhs` = 1 
         AND `ConfirmacionEncargado` = 1 
         AND `ConfirmacionVigilancia` = 1 
    THEN '<span class=\"label label-success\">Confirmado</span>'
    ELSE '<span class=\"label label-warning\">En proceso</span>'
  END AS `Estado`,CASE 
    WHEN LENGTH(`Retroalimentacion`) = 0 THEN '<span class=\"label label-default\">No aplica</span>'
    ELSE `Retroalimentacion`
  END AS `Retroalimentacion`,CASE 
    WHEN `TipoRetorno` = 'Si' THEN '<span class=\"label label-info\">Retorna</span>'
    ELSE '<span class=\"label label-primary\">No Retorna</span>'
  END AS `Retorno` FROM `BitacoraBonosSalida`;");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
	
}


?>