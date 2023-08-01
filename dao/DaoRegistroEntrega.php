<?php
include_once('db.php');

$IdImagenEntrada=$_POST['idImagenEntrada'];
$ImagenEntrada=$_POST['imagenEntrada'];
$NombreVigilante=$_POST['nombreVigilante'];
$IdBitacora=$_POST['idBitacora'];
$Bandera=$_POST['bandera'];
$FechaRetorno=$_POST['fechaRetorno'];
$Causa=$_POST['causa'];
$EstatusImagen = $_POST['estatusImagen'];

cliente($IdImagenEntrada,$ImagenEntrada,$NombreVigilante,$IdBitacora,$Bandera,$FechaRetorno,$Causa,$EstatusImagen);

function cliente($IdImagenEntrada,$ImagenEntrada,$NombreVigilante,$IdBitacora,$Bandera,$FechaRetorno,$Causa,$EstatusImagen){
    $con = new LocalConector();
    $conexion=$con->conectar();

    $Object = new DateTime();
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");

    $IdImagenEntrada = str_replace(array('"', "'","/",'\\'), '', $IdImagenEntrada);

    if ($Bandera==1){
        $consP="UPDATE `BitacoraBonosSalida` SET `NombreVigilanteE`='$NombreVigilante' ,`FechaEntrega` = '$DateAndTime',`ImagenEntrega`='$IdImagenEntrada' WHERE `IdBitacora` = '$IdBitacora'";
    }else{
        $consP="UPDATE `BitacoraBonosSalida` SET `NombreVigilanteS`='$NombreVigilante',`Notificacion`='0' ,`FechaRetorno` = '$FechaRetorno',`ImagenRegistro`='$IdImagenEntrada',`Comentarios`='$Causa' WHERE `IdBitacora` = '$IdBitacora'";
    }

    $rsconsPro=mysqli_query($conexion,$consP);
    mysqli_close($conexion);
    $userData = array();

    if($rsconsPro){
        if ($Bandera==1){
            $imagenCodificadaSalida = $ImagenEntrada;
            $imagenDecodificadaSalida = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenCodificadaSalida));
            $rutaArchivoSalida =  __DIR__ . "/fotos/entregas/".$IdImagenEntrada.".png";
            file_put_contents($rutaArchivoSalida, $imagenDecodificadaSalida);
        }else{
            if($EstatusImagen == '2'){
                
            }else{
                $imagenCodificadaSalida = $ImagenEntrada;
                $imagenDecodificadaSalida = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenCodificadaSalida));
                $rutaArchivoSalida =  __DIR__ . "/fotos/salidas/".$IdImagenEntrada.".png";
                file_put_contents($rutaArchivoSalida, $imagenDecodificadaSalida);
            }
        }
    } else {
        // Ocurrió un error al ejecutar la consulta
        echo "Error al ejecutar la consulta de actualización: " . mysqli_error($conexion);
    }

}


?>