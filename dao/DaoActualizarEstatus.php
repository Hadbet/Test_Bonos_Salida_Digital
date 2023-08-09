<?php
include_once('db.php');

$Bandera=$_GET['bandera'];
$Bitacora=$_GET['bitacora'];
$Estatus=$_GET['estatus'];
$Retroalimentacion=$_GET['retroalimentacion'];

cliente($Bandera,$Bitacora,$Estatus,$Retroalimentacion);


function cliente($Bandera,$Bitacora,$Estatus,$Retroalimentacion){
	$con = new LocalConector();
	$conexion=$con->conectar();
	
	
    $Retroalimentacion = str_replace(array('"', "'","/",'\\'), '', $Retroalimentacion);
	
	if($Estatus==3){
	    $consP="update `BitacoraBonosSalida` set `Retroalimentacion` = '$Retroalimentacion',`ConfirmacionEncargado` = '2' WHERE `IdBitacora` = '$Bitacora'";
	}
	
	if($Bandera==1){
	    $consP="update `BitacoraBonosSalida` set `ConfirmacionEncargado` = '$Estatus' WHERE `IdBitacora` = '$Bitacora'";
	}
	
	if($Bandera==2){
	    $consP="update `BitacoraBonosSalida` set `ConfirmacionControlling` = '$Estatus' WHERE `IdBitacora` = '$Bitacora'";
	}
	
	if($Bandera==3){
	    $consP="update `BitacoraBonosSalida` set `ConfirmacionEhs` = '$Estatus' WHERE `IdBitacora` = '$Bitacora'";
	}
	
	if($Bandera==4){
	    $consP="update `BitacoraBonosSalida` set `ConfirmacionPlant` = '$Estatus' WHERE `IdBitacora` = '$Bitacora'";
	}
	
	if($Bandera==5){
	    $consP="update `BitacoraBonosSalida` set `ConfirmacionVigilancia` = '$Estatus' WHERE `IdBitacora` = '$Bitacora'";
	}

    if($Bandera==6){
        $consP="update `BitacoraBonosSalidaMultiples` set `ConfirmacionEncargado` = '$Estatus' WHERE `Token` = '$Bitacora'";
    }

    echo $consP;
	
	$rsconsPro=mysqli_query($conexion,$consP);
	mysqli_close($conexion); 
	$userData = array();
	
	echo mysqli_num_rows($rsconsPro);
	
	if(mysqli_num_rows($rsconsPro) == 1){
		echo "{\"data\":[{\"estatus\":\"mal\"}]}";
	}
	else{
		echo "{\"data\":[{\"estatus\":\"bien\"}]}";
	}
}


?>