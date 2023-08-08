<?php

include_once('db.php');

$data = json_decode(file_get_contents('php://input'), true);

$arrayDatos = $data['requestData'];
$otrosDatos = $data['otrosDatos'];

$NombreAux = $otrosDatos['NombreCompleto'];
$emailAux = $otrosDatos['Email'];
$nominaAux = $otrosDatos['Nomina'];
$solicitanteAux = $otrosDatos['Solicitante'];
$empresaAux = $otrosDatos['Empresa'];
$direccionAux = $otrosDatos['Direccion'];
$areaAux = $otrosDatos['Area'];
$retornoAux = $otrosDatos['Retorno'];
$fechaRetornoAux = $otrosDatos['FechaRetorno'];
$comentariosAux = $otrosDatos['Comentarios'];
$causaAux = $otrosDatos['Causa'];
$IdPDF = $otrosDatos['PDF'];
$Contador = $otrosDatos['Contador'];
$TipoBonoMulti = $otrosDatos['TipoBonoMulti'];

$descripcionData = $arrayDatos['DescripcionData'];
$cantidadData = $arrayDatos['CantidadData'];
$unidadMedidaData = $arrayDatos['UnidadMedidaData'];
$tipoBonoData = $arrayDatos['TipoBonoData'];

for ($i = 0; $i < $Contador; $i++) {
    echo $descripcionData[$i];
    echo $cantidadData[$i];
    echo $unidadMedidaData[$i];
    echo $tipoBonoData[$i];
    registrarBonos($descripcionData[$i],$cantidadData[$i],$unidadMedidaData[$i],$tipoBonoData[$i],$NombreAux,$emailAux,$nominaAux,$solicitanteAux,$empresaAux,$direccionAux,
        $areaAux,$retornoAux,$fechaRetornoAux,$comentariosAux,$causaAux,$IdPDF,$TipoBonoMulti);
}

function registrarBonos($descripcion, $cantidad, $um, $tipoBono, $nombre, $email, $nomina, $solicitante, $empresa, $direccion, $area, $retorno, $fechaRetorno, $comentarios, $causa, $IdPDF,$TipoBonoMulti)
{
    $con = new LocalConector();
    $conex = $con->conectar();

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");

    if ($TipoBonoMulti == '1') {
        $insertRegistro = "INSERT INTO `BitacoraBonosSalidaMultiples`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `PDF`, `Estatus`,`TipoRetorno`, `CorreoSolicitante`,`TipoBono`, `Area`,`CorreoEncargado`,`Token`) VALUES 
                          ('$nomina','$solicitante','$descripcion','$cantidad','$um','$empresa','$direccion','$DateAndTime','$tipoBono','$fechaRetorno','$causa','$comentarios','$IdPDF',1,'$retorno','$email','$TipoBonoMulti','$area','$nombre','$IdPDF')";
        echo $insertRegistro;
    }

    if ($TipoBonoMulti == '2') {
        $insertRegistro = "INSERT INTO `BitacoraBonosSalidaMultiples`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `PDF`, `Estatus`, `ConfirmacionPlant`, `ConfirmacionControlling`, `ConfirmacionEhs`,`TipoRetorno`, `CorreoSolicitante`,`TipoBono`, `Area`, `CorreoEncargado`, `Token`) VALUES 
                          ('$nomina','$solicitante','$descripcion','$cantidad','$um','$empresa','$direccion','$DateAndTime','$tipoBono','$fechaRetorno','$causa','$comentarios','$IdPDF','$email',1,1,1,'$retorno','$email','$TipoBonoMulti','$area','$nombre','$IdPDF')";
        echo $insertRegistro;
    }

    $rsinsertUsu = mysqli_query($conex, $insertRegistro);
    mysqli_close($conex);

    if (!$rsinsertUsu) {
        $response = ['message' => 'Error recibidos y procesados correctamente ' ];
        echo json_encode($response);
    } else {
        $response = ['message' => 'Datos recibidos y procesados correctamente ' ];
        echo json_encode($response);
    }
}


?>