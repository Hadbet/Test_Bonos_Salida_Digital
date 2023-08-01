<?php

include_once('db.php');

$Id=$_GET['id'];

Contador($Id);

function Contador($Id){
	$con = new LocalConector();
	$conex=$con->conectar();

	$datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `ImagenRegistro` = '$Id';");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>