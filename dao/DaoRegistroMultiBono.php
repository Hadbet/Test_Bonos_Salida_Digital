<?php

include_once('db.php');

$data = json_decode(file_get_contents('php://input'), true);

try {

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

    echo "Descripción Data:";
    foreach ($descripcionData as $descripcion) {
        echo $descripcion . "<br>";
    }

    echo "Cantidad Data:";
    foreach ($cantidadData as $cantidad) {
        echo $cantidad . "<br>";
    }

    echo "Unidad Medida Data:";
    foreach ($unidadMedidaData as $unidadMedida) {
        echo $unidadMedida . "<br>";
    }

    echo "Tipo Bono Data:";
    foreach ($tipoBonoData as $tipoBono) {
        echo $tipoBono . "<br>";
    }

    foreach ($descripcionData as $i => $descripcion) {
        $cantidad = $cantidadData[$i];
        $unidadMedida = $unidadMedidaData[$i];
        $tipoBono = $tipoBonoData[$i];

        echo $descripcion;
        echo $cantidad;
        echo $unidadMedida;
        echo $tipoBono;

        registrarBonos($descripcion, $cantidad, $unidadMedida, $tipoBono, $NombreAux, $emailAux, $nominaAux, $solicitanteAux, $empresaAux, $direccionAux,
            $areaAux, $retornoAux, $fechaRetornoAux, $comentariosAux, $causaAux, $IdPDF, $TipoBonoMulti);
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    // Puedes agregar más manejo de errores aquí si es necesario
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