<?php

include_once('db.php');

echo 'entro';
// Recibir datos JSON de la solicitud POST
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

// Obtener los datos del objeto
$descripcionData = $arrayDatos['DescripcionData'];
$cantidadData = $arrayDatos['CantidadData'];
$unidadMedidaData = $arrayDatos['UnidadMedidaData'];
$tipoBonoData = $arrayDatos['TipoBonoData'];

// Recorrer los arrays y hacer lo que necesites con los datos
for ($i = 0; $i < count($descripcionData); $i++) {
    registrarBonos($descripcionData[$i],$cantidadData[$i],$unidadMedidaData[$i],$tipoBonoData[$i],$NombreAux,$emailAux,$nominaAux,$solicitanteAux,$empresaAux,$direccionAux,
        $areaAux,$retornoAux,$fechaRetornoAux,$comentariosAux,$causaAux,$IdPDF);
}



function registrarBonos($descripcion, $cantidad, $um, $tipoBono, $nombre, $email, $nomina, $solicitante, $empresa, $direccion, $area, $retorno, $fechaRetorno, $comentarios, $causa, $IdPDF)
{

    $con = new LocalConector();
    $conex = $con->conectar();

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");

    $Descripcion = str_replace(array('"', "'", "/", '\\'), '', $descripcion);
    $Empresa = str_replace(array('"', "'", "/", '\\'), '', $empresa);
    $Direccion = str_replace(array('"', "'", "/", '\\'), '', $direccion);
    $Causa = str_replace(array('"', "'", "/", '\\'), '', $causa);
    $Comentarios = str_replace(array('"', "'", "/", '\\'), '', $comentarios);
    $IdPDFAux = str_replace(array('"', "'", "/", '\\'), '', $IdPDF);

    echo 'entro a la funcion';

    if ($tipoBono == '1') {
        $insertRegistro = "INSERT INTO `BitacoraBonosSalidaMultiples`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `PDF`, `Estatus`,`TipoRetorno`, `CorreoSolicitante`,`TipoBono`, `Area`,`CorreoEncargado`,`Token`) VALUES 
                          ('$nomina','$solicitante','$Descripcion','$cantidad','$um','$Empresa','$Direccion','$DateAndTime','$tipoBono','$fechaRetorno','$Causa','$Comentarios','$IdPDF',1,'$retorno','$email','$tipoBono','$area','$nombre','$IdPDFAux')";
        echo $insertRegistro;
    }

    if ($tipoBono == '2') {
        $insertRegistro = "INSERT INTO `BitacoraBonosSalidaMultiples`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `PDF`, `Estatus`, `ConfirmacionPlant`, `ConfirmacionControlling`, `ConfirmacionEhs`,`TipoRetorno`, `CorreoSolicitante`,`TipoBono`, `Area`, `CorreoEncargado`, `Token`) VALUES 
                          ('$nomina','$solicitante','$Descripcion','$cantidad','$um','$Empresa','$Direccion','$DateAndTime','$tipoBono','$fechaRetorno','$Causa','$Comentarios','$IdPDF','$email',1,1,1,'$retorno','$email','$tipoBono','$area','$nombre','$IdPDFAux')";
        echo $insertRegistro;
    }

    $rsinsertUsu = mysqli_query($conex, $insertRegistro);
    mysqli_close($conex);

    if (!$rsinsertUsu) {
        $response = ['message' => 'Error recibidos y procesados correctamente ' .$insertRegistro];
        echo json_encode($response);
    } else {
        $response = ['message' => 'Datos recibidos y procesados correctamente ' .$insertRegistro];
        echo json_encode($response);
    }
}


?>