<?php

include_once('db.php');

$Id=$_GET['id'];
$Folio=$_GET['folio'];

Contador($Id,$Folio);

function Contador($Id,$Folio){
    $con = new LocalConector();
    $conex=$con->conectar();

    if ($Id=="n"){
        $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `IdBitacora` = '$Folio' and `ConfirmacionPlant` = '1' and `ConfirmacionControlling` = '1' and `ConfirmacionEhs`= '1' and `ConfirmacionEncargado` = '1' and `ConfirmacionVigilancia` = '0';");
    }else{
        $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ImagenRegistro` = '$Id' and `ConfirmacionPlant` = '1' and `ConfirmacionControlling` = '1' and `ConfirmacionEhs`= '1' and `ConfirmacionEncargado` = '1' and `ConfirmacionVigilancia` = '0';");
    }
    
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>