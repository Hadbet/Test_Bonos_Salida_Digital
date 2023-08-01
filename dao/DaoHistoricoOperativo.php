
<?php

include_once('db.php');

$Nomina=$_GET['nomina'];
$Folio=$_GET['folio'];
$FechaInicio=$_GET['fechaInicio'];
$FechaFin=$_GET['fechaFin'];
$Estatus=$_GET['estatus'];

Contador($Nomina,$Folio,$FechaInicio,$FechaFin,$Estatus);

function Contador($Nomina,$Folio,$FechaInicio,$FechaFin,$Estatus){
    $con = new LocalConector();
    $conex=$con->conectar();

    $querySql = "SELECT * FROM `BitacoraBonosSalida` where 1=1";

    if ($Nomina!="n"){
        $querySql= $querySql." and NominaSolicitante='$Nomina' ";
    }

    if ($Folio!="n"){
        $querySql = $querySql." and IdBitacora='$Folio'";
    }

    if ($FechaInicio!="n" and $FechaFin!="n"){
        $querySql = $querySql." and FechaRegistro BETWEEN '$FechaInicio' and '$FechaFin'";
    }
    

    $datos = mysqli_query($conex, $querySql);
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    echo json_encode(array("data"=>$resultado));
}


?>