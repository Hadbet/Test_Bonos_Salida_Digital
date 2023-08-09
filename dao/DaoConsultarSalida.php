<?php

include_once('db.php');

$Id=$_GET['id'];

Contador($Id);

function Contador($Id){
	$con = new LocalConector();
	$conex=$con->conectar();

    if (substr($Id, 0, 1) === "M") {
        $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalidaMultiples` WHERE `Token` = '$Id';");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode(array("data"=>$resultado));
    } else {
        $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ImagenRegistro` = '$Id';");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode(array("data"=>$resultado));
    }


}


?>