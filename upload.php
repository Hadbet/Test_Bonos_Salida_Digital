<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$pdfData = $_FILES["PDF"];
	$idImagen=$_POST['idImagen'];

	if (!empty($pdfData["name"])) {
		$uploadDir = __DIR__ . '/dao/PDF/';
		$pdfFileName = $idImagen;
		$pdfFilePath = $uploadDir . $pdfFileName.'.pdf';

		if (move_uploaded_file($pdfData['tmp_name'], $pdfFilePath)) {
			echo 'Archivo PDF subido exitosamente.';
		} else {
			echo 'Error: No se pudo subir el archivo PDF.';
		}
	} else {
		echo 'Error: No se seleccionó ningún archivo PDF.';
	}
} else {
	echo 'Acceso no válido.';
}
?>
