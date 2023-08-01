
<?php

include_once('db.php');

Contador();

function Contador(){
	$con = new LocalConector();
	$conex=$con->conectar();
	$datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE 1");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>