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
$contadorAux = $otrosDatos['Contador'];

// Obtener los datos del objeto
$descripcionData = $arrayDatos['DescripcionData'];
$cantidadData = $arrayDatos['CantidadData'];
$unidadMedidaData = $arrayDatos['UnidadMedidaData'];
$tipoBonoData = $arrayDatos['TipoBonoData'];

// Recorrer los arrays y hacer lo que necesites con los datos
for ($i = 0; $i < count($descripcionData); $i++) {
    $descripcion = $descripcionData[$i];
    $cantidad = $cantidadData[$i];
    $unidadMedida = $unidadMedidaData[$i];
    $tipoBono = $tipoBonoData[$i];
}

// Enviar una respuesta al cliente
$response = ['message' => 'Datos recibidos y procesados correctamente '.$NombreAux];
echo json_encode($response);

function registrarBonos(){

    $con = new LocalConector();
    $conex=$con->conectar();

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");

    $Descripcion = str_replace(array('"', "'","/",'\\'), '', $Descripcion);
    $Empresa = str_replace(array('"', "'","/",'\\'), '', $Empresa);
    $Direccion = str_replace(array('"', "'","/",'\\'), '', $Direccion);
    $Causa = str_replace(array('"', "'","/",'\\'), '', $Causa);
    $Comentarios = str_replace(array('"', "'","/",'\\'), '', $Comentarios);
    $ImagenRegistro = str_replace(array('"', "'","/",'\\'), '', $ImagenRegistro);

    if($TipoBono=='1'){
        $insertRegistro= "INSERT INTO `BitacoraBonosSalida`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `NombreExterno`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `ImagenRegistro`, `Estatus`, `TipoRetorno`,`CorreoSolicitante`,`ConfirmacionControlling`,`ConfirmacionEhs`,`ConfirmacionPlant`,`TipoBono`,`Area`,`CorreoEncargado`) VALUES ('$Nomina','$Solicitante','$Descripcion','$Cantidad','$Um','$Empresa','$Portador','$Direccion','$DateAndTime','$Tipo','$FechaRetorno','$Causa','$Comentarios','$ImagenRegistro',1,'$Retorno','$Email',1,1,1,'$TipoBono','$Area','$CorreoEncargado')";
    }

    if($TipoBono=='2'){
        $insertRegistro= "INSERT INTO `BitacoraBonosSalida`(`NominaSolicitante`, `NombreSolicitante`, `Descripcion`, `Cantidad`, `UnidadMedida`, `Empresa`, `NombreExterno`, `Direccion`, `FechaRegistro`, `TipoSalida`, `FechaRetorno`, `Causa`, `Comentarios`, `ImagenRegistro`, `Estatus`, `TipoRetorno`,`CorreoSolicitante`,`TipoBono`,`Area`,`CorreoEncargado`) VALUES ('$Nomina','$Solicitante','$Descripcion','$Cantidad','$Um','$Empresa','$Portador','$Direccion','$DateAndTime','$Tipo','$FechaRetorno','$Causa','$Comentarios','$ImagenRegistro',1,'$Retorno','$Email','$TipoBono','$Area','$CorreoEncargado')";
        echo $insertRegistro;
    }

    $rsinsertUsu=mysqli_query($conex,$insertRegistro);
    mysqli_close($conex);

    if(!$rsinsertUsu){
        echo "0";
    }else{
        echo "Si funciona";
        $imagenCodificada = $Imagen; //ejemplo de imagen en base64
        $imagenDecodificada = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenCodificada));
        $nombreArchivo = "imagen.png";
        $rutaArchivo =  __DIR__ . "/fotos/registro/".$ImagenRegistro.".png";
        file_put_contents($rutaArchivo, $imagenDecodificada);


        $filename = 'fotos/barcode/'.$ImagenRegistro.'.png';
        $errorCorrectionLevel = 'M';
        $matrixPointSize = 10;
        $data = $ImagenRegistro;
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

        return 1;
    }
}


?>