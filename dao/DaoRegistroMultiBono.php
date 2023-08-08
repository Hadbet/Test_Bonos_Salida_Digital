<?php

include_once('db.php');

$data = json_decode(file_get_contents('php://input'), true);

try {
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

    $descripcionData = $data['DescripcionData'];
    $cantidadData = $data['CantidadData'];
    $unidadMedidaData = $data['UnidadMedidaData'];
    $tipoBonoData = $data['TipoBonoData'];

    for ($i = 0; $i < count($descripcionData); $i++) {
        registrarBonos($descripcionData[$i], $cantidadData[$i], $unidadMedidaData[$i], $tipoBonoData[$i], $NombreAux, $emailAux, $nominaAux, $solicitanteAux, $empresaAux, $direccionAux,
            $areaAux, $retornoAux, $fechaRetornoAux, $comentariosAux, $causaAux, $IdPDF, $TipoBonoMulti);
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

function registrarBonos($descripcion, $cantidad, $um, $tipoBono, $nombre, $email, $nomina, $solicitante, $empresa, $direccion, $area, $retorno, $fechaRetorno, $comentarios, $causa, $IdPDF, $TipoBonoMulti)
{
    $con = new LocalConector();
    $conex = $con->conectar();

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");

    if ($TipoBonoMulti == '1') {
        $insertRegistro = "INSERT INTO `BitacoraBonosSalidaMultiples`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `PDF`, `Estatus`,`TipoRetorno`, `CorreoSolicitante`,`TipoBono`, `Area`,`CorreoEncargado`,`Token`) VALUES 
                          ('$nomina','$solicitante','$descripcion','$cantidad','$um','$empresa','$direccion','$DateAndTime','$tipoBono','$fechaRetorno','$causa','$comentarios','$IdPDF',1,'$retorno','$email','$TipoBonoMulti','$area','$nombre','$IdPDF')";
    }

    if ($TipoBonoMulti == '2') {
        $insertRegistro = "INSERT INTO `BitacoraBonosSalidaMultiples`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `PDF`, `Estatus`, `ConfirmacionPlant`, `ConfirmacionControlling`, `ConfirmacionEhs`,`TipoRetorno`, `CorreoSolicitante`,`TipoBono`, `Area`, `CorreoEncargado`, `Token`) VALUES 
                          ('$nomina','$solicitante','$descripcion','$cantidad','$um','$empresa','$direccion','$DateAndTime','$tipoBono','$fechaRetorno','$causa','$comentarios','$IdPDF','$email',1,1,1,'$retorno','$email','$TipoBonoMulti','$area','$nombre','$IdPDF')";
    }

    $rsinsertUsu = mysqli_query($conex, $insertRegistro);
    mysqli_close($conex);

    if (!$rsinsertUsu) {
        $response = ['message' => 'Error recibidos y procesados correctamente '];
        echo json_encode($response);
    } else {
        $response = ['message' => 'Datos recibidos y procesados correctamente '];
        echo json_encode($response);
    }
}


?>