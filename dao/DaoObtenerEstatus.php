<?php

include_once('db.php');

$Id=$_GET['id'];

Contador($Id);

function Contador($Id){
    
    global $ConfirmacionP;
    global $ConfirmacionC;
    global $ConfirmacionE;
    global $ConfirmacionEN;
    
	$con = new LocalConector();
	$conex=$con->conectar();
	$datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ImagenRegistro` = '$Id';");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    
    if(empty($resultado)) {
        echo "No se encontraron resultados";
    } else {
        $ConfirmacionP =  $resultado[0]['ConfirmacionPlant'];
        $ConfirmacionC =  $resultado[0]['ConfirmacionControlling'];
        $ConfirmacionE =  $resultado[0]['ConfirmacionEhs'];
        $ConfirmacionEN =  $resultado[0]['ConfirmacionEncargado'];
        
    }
}


echo $ConfirmacionP+$ConfirmacionC+$ConfirmacionE+$ConfirmacionEN;

?>