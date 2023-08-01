
<?php

include_once('db.php');

Contador();

function Contador(){
    $con = new LocalConector();
    $conex=$con->conectar();
    $datos = mysqli_query($conex, "SELECT 
                                      COUNT(CASE WHEN `ConfirmacionEhs` = 0 
                                                    AND `ConfirmacionEncargado` = 1 
                                                    AND `ConfirmacionPlant` != 2 
                                                    AND `ConfirmacionControlling` != 2 
                                                    AND `ConfirmacionVigilancia` != 2 
                                                THEN 1 ELSE NULL END) AS `CountConfirmacionEhs`,
                                      
                                      COUNT(CASE WHEN `ConfirmacionPlant` = 0 
                                                    AND `ConfirmacionEncargado` = 1 
                                                    AND `ConfirmacionEhs` != 2 
                                                    AND `ConfirmacionControlling` != 2 
                                                    AND `ConfirmacionVigilancia` != 2 
                                                THEN 1 ELSE NULL END) AS `CountConfirmacionPlant`,
                                      
                                      COUNT(CASE WHEN `ConfirmacionControlling` = 0 
                                                    AND `ConfirmacionEncargado` = 1 
                                                    AND `ConfirmacionEhs` != 2 
                                                    AND `ConfirmacionPlant` != 2 
                                                    AND `ConfirmacionVigilancia` != 2 
                                                THEN 1 ELSE NULL END) AS `CountConfirmacionControlling`
                                      
                                    FROM `BitacoraBonosSalida`
                                    WHERE 1;
                                    ");

    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    foreach($resultado as $fila){
        
        if($fila['CountConfirmacionEhs']!='0'){
             $datos_post = array(
            'cantidad' => $fila['CountConfirmacionEhs'],
            'bandera' => '1',
            );
    
            // URL del archivo PHP a ejecutar
            $url = 'https://arketipo.mx/MailerBonosSalidaAviso.php';
    
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
        
        if($fila['CountConfirmacionPlant']!='0'){
             $datos_post = array(
            'cantidad' => $fila['CountConfirmacionPlant'],
            'bandera' => '2',
            );
    
            // URL del archivo PHP a ejecutar
            $url = 'https://arketipo.mx/MailerBonosSalidaAviso.php';
    
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
        
        if($fila['CountConfirmacionControlling']!='0'){
             $datos_post = array(
            'cantidad' => $fila['CountConfirmacionControlling'],
            'bandera' => '3',
            );
    
            // URL del archivo PHP a ejecutar
            $url = 'https://arketipo.mx/MailerBonosSalidaAviso.php';
    
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