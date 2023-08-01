<?php

include_once('db.php');

/*$Nomina=$_GET['nomina'];
$contra=$_GET['contra'];

cliente($Nomina, $contra);*/


function cliente($Nomina, $contra){
	$con = new LocalConector();
	$conexion=$con->conectar();
	$consP="SELECT nomina, contraseña FROM Usuarios WHERE nomina = '$Nomina' and Contraseña = '$contra'";
	$rsconsPro=mysqli_query($conexion,$consP);
	mysqli_close($conexion); 
	$userData = array();
	
	if(mysqli_num_rows($rsconsPro) == 1){
		return 1;
	}
	else{
		return 0;
	}
}


?>