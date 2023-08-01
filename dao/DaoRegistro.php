<?php
include_once('db.php');
include "phpqrcode/qrlib.php";  

$Email=$_POST['email'];
$Nomina=$_POST['nomina'];
$Solicitante=$_POST['solicitante'];
$Descripcion=$_POST['descripcion'];
$Cantidad=$_POST['cantidad'];
$Um=$_POST['um'];
$ImagenRegistro=$_POST['imagenRegistro'];
$Empresa=$_POST['empresa'];
$Portador=$_POST['portador'];
$Direccion=$_POST['direccion'];
$Tipo=$_POST['tipo'];
$Retorno=$_POST['retorno'];
$FechaRetorno=$_POST['fechaRetorno'];
$Causa=$_POST['causa'];
$Comentarios=$_POST['comentarios'];
$TipoBono=$_POST['tipoBono'];
$Area=$_POST['area'];
$Imagen=$_POST['imagen'];
$CorreoEncargado=$_POST['correoEncargado'];

registroUsu($Email,$Nomina,$Solicitante,$Descripcion,$Cantidad,$Um,$ImagenRegistro,$Empresa,$Portador,$Direccion,$Tipo,$Retorno,$FechaRetorno,$Causa,$Comentarios,$Imagen,$TipoBono,$Area,$CorreoEncargado);


function registroUsu($Email,$Nomina,$Solicitante,$Descripcion,$Cantidad,$Um,$ImagenRegistro,$Empresa,$Portador,$Direccion,$Tipo,$Retorno,$FechaRetorno,$Causa,$Comentarios,$Imagen,$TipoBono,$Area,$CorreoEncargado){
    
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