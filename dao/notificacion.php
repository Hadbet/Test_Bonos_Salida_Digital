
<?php

include_once('db.php');

Contador();

function Contador(){
    $con = new LocalConector();
    $conex=$con->conectar();
    $datos = mysqli_query($conex, "SELECT * FROM `BitacoraBonosSalida` WHERE `FechaRetorno` <= NOW() AND `FechaRetorno` NOT LIKE '0000-00-00 00:00:00' and `Notificacion` = 0 and `ConfirmacionPlant`=1 and `ConfirmacionControlling`=1 and `ConfirmacionEhs`=1 and `ConfirmacionEncargado`=1;");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    foreach($resultado as $fila){
        
        if($fila['CorreoSolicitante']==null && $fila['CorreoSolicitante']==''){
            echo 'No hay nada';
        }else{
            $datos_post = array(
            'email' => $fila['CorreoSolicitante'],
            'solicitante' => $fila['NombreSolicitante'],
            'descripcion' => $fila['Descripcion'],
            'cantidad' => $fila['Cantidad'],
            'um' => $fila['UnidadMedida'],
            'empresa' => $fila['Empresa'],
            'portador' => $fila['NombreExterno'],
            'direccion' => $fila['Direccion'],
            'tipo' => $fila['TipoSalida'],
            'retorno' => $fila['TipoRetorno'],
            'fechaRetorno' => $fila['FechaRetorno'],
            'causa' => $fila['Causa'],
            'comentario' => $fila['Comentarios'],
            'idImagen' => $fila['ImagenRegistro'],
            'correoEncargado' => $fila['CorreoEncargado'],
            'bandera' => '9',
            'retroalimentacion' => $fila['Retroalimentacion'],
            'NombreConfirmado' => $fila['NombreVigilanteS'],
            'Estatus' => '2',
            'tipoBono' => $fila['TipoBono'],
            'idBitacora' => $fila['IdBitacora'],
            'bandera' => '9',
            'NombreVigilante' => $fila['NombreVigilanteS']
            );
    
            // URL del archivo PHP a ejecutar
            $url = 'https://arketipo.mx/MailerBonosSalida.php';
    
            // Inicializar cURL
            $curl = curl_init($url);
    
            // Configurar opciones de cURL
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($datos_post));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
            // Ejecutar la solicitud y obtener la respuesta
            $respuesta = curl_exec($curl);
    
            // Cerrar la sesión de cURL
            curl_close($curl);
    
            // Imprimir la respuesta
            echo $respuesta;
    
            cliente($fila['IdBitacora']);
        }
        
        
    }
}

function cliente($Bitacora){
    $con = new LocalConector();
    $conexion=$con->conectar();

    $consP="update `BitacoraBonosSalida` set `Notificacion` = '1' WHERE `IdBitacora` = '$Bitacora'";

    $rsconsPro=mysqli_query($conexion,$consP);
    mysqli_close($conexion);
    $userData = array();

    echo mysqli_num_rows($rsconsPro);

    if(mysqli_num_rows($rsconsPro) == 1){
        echo "{\"data\":[{\"estatus\":\"mal\"}]}";
    }
    else{
        echo "{\"data\":[{\"estatus\":\"bien\"}]}";
    }
}

?>