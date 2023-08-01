<?php
include_once('db.php');

$Firma=$_POST['firma'];
$ImagenSalida=$_POST['imagenSalida'];
$IdImagenSalida=$_POST['idImagenSalida'];
$Placas=$_POST['placas'];
$Transportista=$_POST['transportista'];
$Portador=$_POST['portador'];
$NombreVigilante=$_POST['nombreVigilante'];
$Retroalimentacion=$_POST['retroalimentacion'];
$Estatus=$_POST['estatus'];
$Bitacora=$_POST['bitacora'];

cliente($Firma,$ImagenSalida,$Placas,$Transportista,$Portador,$Retroalimentacion,$Estatus,$IdImagenSalida,$Bitacora,$NombreVigilante);


function cliente($Firma,$ImagenSalida,$Placas,$Transportista,$Portador,$Retroalimentacion,$Estatus,$IdImagenSalida,$Bitacora,$NombreVigilante){
	$con = new LocalConector();
	$conexion=$con->conectar();
	
	$Object = new DateTime();  
    $Object->setTimezone(new DateTimeZone('America/Denver'));
    $DateAndTime = $Object->format("Y/m/d h:i:s");  
    
    
    $Retroalimentacion = str_replace(array('"', "'","/",'\\'), '', $Retroalimentacion);
    $Portador = str_replace(array('"', "'","/",'\\'), '', $Portador);
    $Transportista = str_replace(array('"', "'","/",'\\'), '', $Transportista);
    $Placas = str_replace(array('"', "'","/",'\\'), '', $Placas);
    $IdImagenSalida = str_replace(array('"', "'","/",'\\'), '', $IdImagenSalida);
    
	
	if($Estatus==1){
	    $consP="UPDATE `BitacoraBonosSalida` SET `NombreVigilanteS`='$NombreVigilante' ,`FechaSalida` = '$DateAndTime',`ConfirmacionVigilancia`='$Estatus',`ImagenSalida`='$IdImagenSalida',`PlacasTransportista`='$Placas',`LineaTransportista`='$Transportista',`NombreOperador`='$Portador' ,`Firma`='$IdImagenSalida' WHERE `IdBitacora` = '$Bitacora'";
	}
	
	if($Estatus==2){
	    $consP="UPDATE `BitacoraBonosSalida` SET `NombreVigilanteS`='$NombreVigilante', `FechaSalida` = '$DateAndTime',`ConfirmacionVigilancia`='$Estatus',`Retroalimentacion`='$Retroalimentacion' WHERE `IdBitacora` = '$Bitacora'";
	    echo $consP;
	}
	
	$rsconsPro=mysqli_query($conexion,$consP);
	mysqli_close($conexion); 
	$userData = array();
	
	if(!$rsinsertUsu){
	    
	    $imagenCodificadaSalida = $ImagenSalida;
        $imagenDecodificadaSalida = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenCodificadaSalida));
        $rutaArchivoSalida =  __DIR__ . "/fotos/salidas/".$IdImagenSalida.".png";
        file_put_contents($rutaArchivoSalida, $imagenDecodificadaSalida);
        
        $imagenCodificadaF = $Firma;
        $imagenDecodificadaF = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenCodificadaF));
        $rutaArchivoF =  __DIR__ . "/fotos/firmas/".$IdImagenSalida.".png";
        file_put_contents($rutaArchivoF, $imagenDecodificadaF);
        
	}else{
	    
		return 1;
	}
}


?>