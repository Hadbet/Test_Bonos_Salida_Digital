<?php

include_once('db.php');

// Recibir datos JSON de la solicitud POST
$data = json_decode(file_get_contents('php://input'), true);

// Obtener los datos del objeto
$descripcionData = $data['DescripcionData'];
$cantidadData = $data['CantidadData'];
$unidadMedidaData = $data['UnidadMedidaData'];
$tipoBonoData = $data['TipoBonoData'];
$otrosDatos = $data['otrosDatos'];

// Recorrer los arrays y hacer lo que necesites con los datos
for ($i = 0; $i < count($descripcionData); $i++) {
    $descripcion = $descripcionData[$i];
    $cantidad = $cantidadData[$i];
    $unidadMedida = $unidadMedidaData[$i];
    $tipoBono = $tipoBonoData[$i];
}

// Puedes acceder a otros datos como SupervisorAux, ShiftLeaderAux, etc. desde $otrosDatos
$supervisorAux = $otrosDatos['SupervisorAux'];
$shiftLeaderAux = $otrosDatos['ShiftLeaderAux'];
$turnoAux = $otrosDatos['TurnoAux'];
$operacionAux = $otrosDatos['OperacionAux'];
$contador = $otrosDatos['Contador'];

// Realizar operaciones adicionales con los otros datos
// ...

// Enviar una respuesta al cliente
$response = ['message' => 'Datos recibidos y procesados correctamente '.$operacionAux];
echo json_encode($response);


?>