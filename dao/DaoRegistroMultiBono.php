<?php

include_once('db.php');

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
$IdImagenAux = $otrosDatos['IdImagen'];

// Obtener los datos del objeto
$descripcionData = $arrayDatos['DescripcionData'];
$cantidadData = $arrayDatos['CantidadData'];
$unidadMedidaData = $arrayDatos['UnidadMedidaData'];
$tipoBonoData = $arrayDatos['TipoBonoData'];


$pdfData = $_FILES['PDF'];
echo $pdfData;
$uploadDir =  __DIR__ .'/PDF/';
$pdfFileName = uniqid() . '_' . basename($pdfData['name']);
$pdfFilePath = $uploadDir . $pdfFileName;
if (move_uploaded_file($pdfData['tmp_name'], $pdfFilePath)) {
    echo 'Archivo PDF subido exitosamente.';
} else {
    echo 'Error al subir el archivo PDF.';
}

// Recorrer los arrays y hacer lo que necesites con los datos
for ($i = 0; $i < count($descripcionData); $i++) {
    //registrarBonos($descripcionData[$i],$cantidadData[$i],$unidadMedidaData[$i],$tipoBonoData[$i],$NombreAux,$emailAux,$nominaAux,$solicitanteAux,$empresaAux,$direccionAux,
    //    $areaAux,$retornoAux,$fechaRetornoAux,$comentariosAux,$causaAux,$IdImagenAux);
}

// Enviar una respuesta al cliente
$response = ['message' => 'Datos recibidos y procesados correctamente '.$NombreAux];
echo json_encode($response);

function registrarBonos($descripcion,$cantidad,$um,$tipoBono,$nombre,$email,$nomina,$solicitante,$empresa,$direccion,$area,$retorno,$fechaRetorno,$comentarios,$causa,$IdImagenAux){

    $con = new LocalConector();
    $conex=$con->conectar();

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");

    $Descripcion = str_replace(array('"', "'","/",'\\'), '', $descripcion);
    $Empresa = str_replace(array('"', "'","/",'\\'), '', $empresa);
    $Direccion = str_replace(array('"', "'","/",'\\'), '', $direccion);
    $Causa = str_replace(array('"', "'","/",'\\'), '', $causa);
    $Comentarios = str_replace(array('"', "'","/",'\\'), '', $comentarios);
    $ImagenRegistro = str_replace(array('"', "'","/",'\\'), '', $IdImagenAux);

    if($tipoBono=='1'){
        $insertRegistro= "INSERT INTO `BitacoraBonosSalida`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `NombreExterno`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `ImagenRegistro`, `Estatus`, `TipoRetorno`,`CorreoSolicitante`,`ConfirmacionControlling`,`ConfirmacionEhs`,`ConfirmacionPlant`,`TipoBono`,`Area`,`CorreoEncargado`) VALUES ('$Nomina','$Solicitante','$Descripcion','$Cantidad','$Um','$Empresa','$Portador','$Direccion','$DateAndTime','$Tipo','$FechaRetorno','$Causa','$Comentarios','$ImagenRegistro',1,'$Retorno','$Email',1,1,1,'$TipoBono','$Area','$CorreoEncargado')";
    }

    if($tipoBono=='2'){
        $insertRegistro= "INSERT INTO `BitacoraBonosSalida`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `NombreExterno`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `ImagenRegistro`, `Estatus`, `TipoRetorno`,`CorreoSolicitante`,`TipoBono`,`Area`,`CorreoEncargado`) VALUES ('$Nomina','$Solicitante','$Descripcion','$Cantidad','$Um','$Empresa','$Portador','$Direccion','$DateAndTime','$Tipo','$FechaRetorno','$Causa','$Comentarios','$ImagenRegistro',1,'$Retorno','$Email','$TipoBono','$Area','$CorreoEncargado')";
        echo $insertRegistro;
    }

    $rsinsertUsu=mysqli_query($conex,$insertRegistro);
    mysqli_close($conex);

    if(!$rsinsertUsu){
        echo "0";
    }else{
        echo "Si funciona";
        return 1;
    }
}


?>