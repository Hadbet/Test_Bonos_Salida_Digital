<?php    
    include "qrlib.php";   
   $filename = 'fotos/test.png';


// Nivel de corrección de errores
$errorCorrectionLevel = 'M';

// Tamaño del código QR
$matrixPointSize = 10;

// Datos para generar el código QR
$data = 'hadbetsito';

// Generar el código QR y guardarlo en el archivo especificado
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

// Mensaje de éxito
echo 'El código QR ha sido generado y guardado en ' . $filename;

?>

    